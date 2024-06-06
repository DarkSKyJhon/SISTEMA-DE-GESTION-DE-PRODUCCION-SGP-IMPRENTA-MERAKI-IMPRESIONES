<?php
session_start();

include_once '../configuraciones/bd.php';
$conexionBD = BaseDatos::crearInstancia();

function obtenerListaTrabajos($conexionBD) {
    $numero = isset($_SESSION['numero_transaccion']) ? $_SESSION['numero_transaccion'] : ''; 
    echo $numero;
    try {
        $consulta = $conexionBD->prepare("
        SELECT NombreTrabajo, NumeroTrabajo, Cantidad, SubTotal 
        FROM Transaccion c, Trabajo t 
        WHERE t.IdTransaccion = c.IdTransaccion AND t.IdTransaccion = :p_numero
        ORDER BY NumeroTrabajo DESC");
        $consulta->bindParam(':p_numero', $numero);
        $consulta->execute();

        $listaTrabajos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $listaTrabajos;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false; // En caso de error, retornamos falso
    }
}

function ejecutarAccion($evento, $conexionBD) {
    $id_trabajo = isset($_POST['id_trabajo']) ? $_POST['id_trabajo'] : '';
    $id_cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : '';
    $numero_transaccion = isset($_POST['numero_transaccion']) ? $_POST['numero_transaccion'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $sub_total = isset($_POST['precio_trabajo']) ? $_POST['precio_trabajo'] : '';
    $tipo_documento = isset($_POST['tipo_transaccion']) ? $_POST['tipo_transaccion'] : '';

    switch($evento) {
        case 'agregar':
            try {
                $sql = "CALL InsertarTransaccion(:IdTrabajo, :numero_transaccion, :IdCliente, :fecha, :sub_total, :tipo_documento)";           
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':numero_transaccion', $numero_transaccion);
                $consulta->bindParam(':IdTrabajo', $id_trabajo);
                $consulta->bindParam(':IdCliente', $id_cliente);
                $consulta->bindParam(':fecha', $fecha);
                $consulta->bindParam(':sub_total', $sub_total);
                $consulta->bindParam(':tipo_documento', $tipo_documento);
                
                $consulta->execute();
            } catch (PDOException $e) {
                echo "La consulta ha fallado". $e->getMessage();
            }
            break;
    }
}

$idCliente = 0;
$idTrabajo = 0;

$evento = isset($_POST['evento']) ? $_POST['evento'] : '';
$origen = isset($_POST['origen']) ? $_POST['origen'] : '';

$_SESSION['nombre_completo_cliente'] = "";
if ($evento != '') {
    ejecutarAccion($evento, $conexionBD);
}


if($origen == "cliente"){
    $idCliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : '';
    $nombreCompleto = isset($_POST['n_cliente']) ? $_POST['n_cliente'] : '';
    $apellidoCliente = isset($_POST['a_cliente']) ? $_POST['a_cliente'] : '';
   
    $nombreCompleto .= '' . $apellidoCliente;

    // Almacenar en la sesión para cliente
    $_SESSION['id_cliente'] = $idCliente;
    $_SESSION['nombre_completo_cliente'] = $nombreCompleto;
}else{
    
    $idTrabajo = isset($_POST['id_trabajo']) ? $_POST['id_trabajo'] : '';
    $nombreTrabajo= isset($_POST['nombre_trabajo']) ? $_POST['nombre_trabajo'] : '';
    $numeroTrabajo = isset($_POST['codigo_trabajo']) ? $_POST['codigo_trabajo'] : '';
    $cantidadTrabajo = isset($_POST['cantidad_trabajo']) ? $_POST['cantidad_trabajo'] : '';
    $precioTrabajo = isset($_POST['precio_trabajo']) ? $_POST['precio_trabajo'] : '';

    // Almacenar en la sesión para trabajo
    $_SESSION['id_trabajo'] = $idTrabajo;
    $_SESSION['nombre_trabajo'] = $nombreTrabajo;
    $_SESSION['numero_trabajo'] = $numeroTrabajo;
    $_SESSION['cantidad_trabajo'] = $cantidadTrabajo;
    $_SESSION['precio_trabajo'] = $precioTrabajo;
}

function obtenerTrabajo(){
    $codigo_trabajo = isset($_POST['codigo_trabajo']) ? $_POST['codigo_trabajo'] : '';
    return $codigo_trabajo;
}

?>
