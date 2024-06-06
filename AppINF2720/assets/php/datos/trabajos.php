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
        SELECT IdTrabajo, NombreTrabajo, NumeroTrabajo, Cantidad, c.NombreCategoria, SubTotal 
        FROM Categoria c, Trabajo t 
        WHERE t.IdCategoria = c.IdCategoria
        ORDER BY NumeroTrabajo DESC");
        $consulta->execute();

        $listaTrabajos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $listaTrabajos;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false; // En caso de error, retornamos falso
    }
}

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';
if ($accion != '') {
    $idTrabajo = isset($_POST['id_trabajo_seleccionado']) ? $_POST['id_trabajo_seleccionado'] : '';
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

            
            } catch (PDOException $e) {
                echo "Error al insertar el trabajo: " . $e->getMessage();
            }
            break;
            
        case 'editar':
            try {
                $sql = "UPDATE Trabajo
                SET NombreTrabajo = :nombre_trabajo,
                NumeroTrabajo = :numero_trabajo,
                IdCategoria = :id_categoria,
                Cantidad = :cantidad,
                SubTotal = :subtotal
                WHERE IdTrabajo = :id_trabajo;";           
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':nombre_trabajo', $nombre_trabajo);
                $consulta->bindParam(':numero_trabajo', $codigo_trabajo);
                $consulta->bindParam(':id_categoria', $idcategoria);
                $consulta->bindParam(':cantidad', $cantidad);
                $consulta->bindParam(':subtotal', $precio);
                $consulta->bindParam(':id_trabajo', $idTrabajo);   
                $consulta->execute();
            } catch (PDOException $e) {
                echo "Error al modificar el trabajo: " . $e->getMessage();
            }
            break;

        case 'eliminar':
            try {
                $sql = "DELETE FROM Trabajo WHERE IdTrabajo = :id_trabajo";
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':id_trabajo', $idTrabajo); 
                $consulta->execute();               
            } catch (PDOException $e) {
                echo "Error al eliminar el trabajo: " . $e->getMessage();
            }
            break;

        default:
            echo "Error al eliminar el trabajo: " . $e->getMessage();
            break;

    }
}



function obtenerTrabajo(){
    $codigo_trabajo = isset($_POST['codigo_trabajo']) ? $_POST['codigo_trabajo'] : '';
    return $codigo_trabajo;
}

?>

