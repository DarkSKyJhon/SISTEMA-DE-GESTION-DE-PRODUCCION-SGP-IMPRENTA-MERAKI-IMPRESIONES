<?php

include_once '../configuraciones/bd.php';
$conexionBD = BaseDatos::crearInstancia();

function obtenerListaCategorias($conexionBD) {
    try {
        $consulta = $conexionBD->prepare("SELECT NombreCategoria FROM Categoria");
        $consulta->execute();

        $listaCategorias = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $listaCategorias;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false; // En caso de error, retornamos falso
    }
}

function obtenerListaTrabajos($conexionBD) {
    try {
        $consulta = $conexionBD->prepare("
        SELECT NombreTrabajo, NumeroTrabajo, Cantidad, c.NombreCategoria, SubTotal 
        FROM Categoria c, Trabajo t 
        WHERE t.IdCategoria = c.IdCategoria");
        $consulta->execute();

        $listaTrabajos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $listaTrabajos;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false; // En caso de error, retornamos falso
    }
}


function ejecutarAccion($accion, $conexionBD) {
    $nombre_trabajo = isset($_POST['nombre_trabajo']) ? $_POST['nombre_trabajo'] : '';
    $categoria = isset($_POST['tipo_trabajo']) ? $_POST['tipo_trabajo'] : '';
    $consulta = $conexionBD->prepare("SELECT IdCategoria FROM Categoria WHERE NombreCategoria = :categoria");
    $consulta->bindParam(':categoria', $categoria);
    $consulta->execute();
    $transaccion = $consulta->fetchAll(PDO::FETCH_ASSOC);
    $idcategoria = $transaccion[0]['IdCategoria']; 
    
    $codigo_trabajo = isset($_POST['codigo_trabajo']) ? $_POST['codigo_trabajo'] : '';
    $cantidad = isset($_POST['cantidad_trabajo']) ? $_POST['cantidad_trabajo'] : '';
    $precio = isset($_POST['precio_trabajo']) ? $_POST['precio_trabajo'] : '';

    $fecha_actual = date('Y-m-d');

    switch($accion) {
        case 'agregar':
            try {
                $sql = "CALL InsertarTrabajo(:nombre_trabajo, :numero_trabajo, :id_categoria, :cantidad, :subtotal, :fecha)";           
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':nombre_trabajo', $nombre_trabajo);
                $consulta->bindParam(':numero_trabajo', $codigo_trabajo);
                $consulta->bindParam(':id_categoria', $idcategoria);
                $consulta->bindParam(':cantidad', $cantidad);
                $consulta->bindParam(':subtotal', $precio);
                $consulta->bindParam(':fecha', $fecha_actual);
                
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            
            } catch (PDOException $e) {

            }
            break;
            

        case 'editar':
            // Agrega aquí la lógica para editar
            break;

        case 'borrar':
            // Agrega aquí la lógica para borrar
            break;

        case 'Seleccionar':
            // Agrega aquí la lógica para seleccionar
            break;
    }
}

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';
if ($accion != '') {
    ejecutarAccion($accion, $conexionBD);
}



?>

