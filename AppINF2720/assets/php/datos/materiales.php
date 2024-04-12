<?php

include_once '../configuraciones/bd.php';
$conexionBD = BaseDatos::crearInstancia();

try {
    $IdMaterial = isset($_POST['id'])?$_POST['id']:'';
    $Nombre = isset($_POST['material'])?$_POST['material']:'';
    $PrecioCompra = isset($_POST['precio'])?$_POST['precio']:'';
    $Stock = isset($_POST['cantidad'])?$_POST['cantidad']:'';
    $Descripcion = isset($_POST['descripcion'])?$_POST['descripcion']:'';
    $accion = isset($_POST['accion'])?$_POST['accion']:'';

    if($accion != ''){
        switch ($accion) {
            case 'agregar':
                $sql = "INSERT INTO material (Nombre, PrecioCompra, Stock, Descripcion) VALUES (:Nombre, :PrecioCompra, :Stock, :Descripcion)";
                $consulta = $conexionBD->prepare($sql);
                $consulta -> bindParam(':Nombre', $Nombre);
                $consulta -> bindParam(':PrecioCompra', $PrecioCompra);
                $consulta -> bindParam(':Stock', $Stock);
                $consulta -> bindParam(':Descripcion', $Descripcion);
                $consulta -> execute();
                break;
            case 'editar':
                $sql = "UPDATE material SET Nombre = :Nombre, PrecioCompra = :PrecioCompra, Stock = :Stock, descripcion = :Descripcion WHERE IdMaterial = :IdMaterial";
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':IdMaterial', $IdMaterial);
                $consulta->bindParam(':Nombre', $Nombre);
                $consulta->bindParam(':PrecioCompra', $PrecioCompra);
                $consulta->bindParam(':Stock', $Stock);
                $consulta->bindParam(':Descripcion', $Descripcion);
                $consulta->execute();   
                break;
            case 'eliminar':
                $sql = "DELETE FROM material WHERE IdMaterial = :IdMaterial";
                $consulta = $conexionBD->prepare($sql);
                $consulta -> bindParam(':IdMaterial', $IdMaterial);
                $consulta -> execute();
                break;
            case 'Seleccionar':
                $sql = "SELECT * FROM material WHERE IdMaterial = :IdMaterial";
                $consulta = $conexionBD->prepare($sql);
                $consulta -> bindParam(":IdMaterial", $IdMaterial);
                $consulta -> execute();
                $Material = $consulta -> fetch(PDO::FETCH_ASSOC);
                $Nombre = $Material['Nombre'];
                $PrecioCompra = $Material['PrecioCompra'];
                $Stock = $Material['Stock'];
                $Descripcion = $Material['Descripcion'];
                break;
        }
    }

    $consulta = $conexionBD->prepare("SELECT IdMaterial, Nombre, PrecioCompra, Stock, Descripcion FROM Material");
    $consulta->execute();
    $listaMateriales = $consulta->fetchAll();

} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}

?>