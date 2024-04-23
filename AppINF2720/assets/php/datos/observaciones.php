<?php

include_once '../configuraciones/bd.php';
$conexionBD = BaseDatos::crearInstancia();
$NumeroTrabajo = $_GET['NumeroTrabajo'];
$IdTrabajo = $_GET['IdTrabajo'];
$NumeroObservacion = 0;

function obtenerListaObservaciones($conexionBD) {
    global $IdTrabajo;
    try {
        $consulta = $conexionBD->prepare("
        SELECT IdObservacion, NumeroObservacion, Descripcion, FechaObservacion
        FROM Observacion 
        WHERE IdTrabajo = :IdTrabajo
        ORDER BY FechaObservacion DESC;");
        
        $consulta->bindParam(':IdTrabajo', $IdTrabajo);
        $consulta->execute();

        $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        return $lista;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false; // En caso de error, retornamos falso
    }
}

function obtenerListaObservacion_M($conexionBD, $idObservacion) {
    try {
        $consulta = $conexionBD->prepare("
        SELECT d.IdDetalleObservacion, m.Nombre, d.CantidadUso 
        FROM Material m, Observacion o, DetalleObservacion d
        WHERE o.IdObservacion = :IdObservacion AND o.IdObservacion = d.IdObservacion AND d.IdMaterial = m.IdMaterial");
        
        $consulta->bindParam(':IdObservacion', $idObservacion);
        $consulta->execute();

        $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        return $lista;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false; // En caso de error, retornamos falso
    }
}


function ejecutarAccion($accion, $conexionBD) {
    global $IdTrabajo;
    
    $id_observacion = isset($_POST['id-obs']) ? $_POST['id-obs'] : '';
    $numero_observacion = isset($_POST['num-obs']) ? $_POST['num-obs'] : '';
    $descripcion_observacion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';    
    $fecha_actual = date('Y-m-d');

    switch($accion) {
        case 'agregar':
            try {
                $sql = "CALL InsertarObservacion(:p_NumeroObservacion, :p_IdTrabajo, :p_Descripcion, :p_FechaObservacion)";           
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':p_NumeroObservacion', $numero_observacion);
                $consulta->bindParam(':p_IdTrabajo', $IdTrabajo);
                $consulta->bindParam(':p_Descripcion', $descripcion_observacion);
                $consulta->bindParam(':p_FechaObservacion', $fecha_actual);
                
                $consulta->execute();
            } catch (PDOException $e) {
                echo "La consulta ha fallado";
            }
            break;
            

        case 'editar':
            try {
                $sql = "UPDATE Observacion SET NumeroObservacion = :p_NumeroObservacion, Descripcion = :p_Descripcion, FechaObservacion = :p_FechaObservacion WHERE IdObservacion = :p_IdObservacion";
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':p_NumeroObservacion', $numero_observacion);
                $consulta->bindParam(':p_Descripcion', $descripcion_observacion);
                $consulta->bindParam(':p_FechaObservacion', $fecha_actual);
                $consulta->bindParam(':p_IdObservacion', $id_observacion);
                $consulta->execute();
            } catch (PDOException $e) {
                echo "Ha fallado la modificacion";
            }
            break;

        case 'borrar':
            try {
                $sql = "DELETE FROM Observacion WHERE IdObservacion = :p_IdObservacion";
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':p_IdObservacion', $id_observacion);
                $consulta->execute();
            } catch (PDOException $e) {
                echo "Ha fallado el procedimiento elimincacion";
            }
            break;
    }
}

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';
if ($accion != '') {
    ejecutarAccion($accion, $conexionBD);
}

$accion2 = isset($_POST['accion2']) ? $_POST['accion2'] : '';

if ($accion2 != '') {
    if($accion2 == 'ocultar'){
        $id_detalle = isset($_POST['IdDetalleObservacion']) ? $_POST['IdDetalleObservacion'] : '';
        try {
            $sql = "DELETE FROM DetalleObservacion WHERE IdDetalleObservacion = :p_IdDetalleObservacion";
            $consulta = $conexionBD->prepare($sql);
            $consulta->bindParam(':p_IdDetalleObservacion', $id_detalle);
            $consulta->execute();
        } catch (PDOException $e) {
            echo "Ha fallado el procedimiento elimincacion";
        }
    }
}


?>
