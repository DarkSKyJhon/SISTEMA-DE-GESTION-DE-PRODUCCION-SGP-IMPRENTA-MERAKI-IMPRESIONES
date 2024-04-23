<?php

include_once '../configuraciones/bd.php';
$conexionBD = BaseDatos::crearInstancia();
$NumeroObservacion = $_GET['NumeroObservacion'];
$IdObservacion = $_GET['IdObservacion'];


function obtenerListaMateriales($conexionBD) {
    try {
        $consulta = $conexionBD->prepare("
        SELECT IdMaterial, Nombre, PrecioCompra, Stock
        FROM Material");
        $consulta->execute();

        $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        return $lista;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false; // En caso de error, retornamos falso
    }
}


function ejecutarAccion($accion, $conexionBD) {
    global $IdObservacion;
    $idMaterial= isset($_POST['id_material']) ? $_POST['id_material'] : '';
    $nombre_material = isset($_POST['material']) ? $_POST['material'] : '';
    $cantidad_uso = isset($_POST['cantidad_material']) ? $_POST['cantidad_material'] : '';

    switch($accion) {
        case 'agregar':
            try {
                $sql = "CALL InsertarDetalleObservacion(:idObservacion, :idMaterial, :cantidad_uso)";           
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':idObservacion', $IdObservacion);
                $consulta->bindParam(':idMaterial', $idMaterial);
                $consulta->bindParam(':cantidad_uso', $cantidad_uso);
                
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            
            } catch (PDOException $e) {

            }
            break;
            
    }
}

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';
if ($accion != '') {
    ejecutarAccion($accion, $conexionBD);
}



?>
