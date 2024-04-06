<?php

include_once '../configuraciones/bd.php';
$conexionBD = BaseDatos::crearInstancia();

try {
    $consulta = $conexionBD->prepare("SELECT Nombre, PrecioCompra, Stock FROM Material");
    $consulta->execute();

    $listaMateriales = $consulta->fetchAll();

    print_r($listaMateriales);
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}

?>