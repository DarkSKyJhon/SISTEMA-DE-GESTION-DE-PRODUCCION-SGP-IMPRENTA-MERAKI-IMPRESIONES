<?php

include_once '../configuraciones/bd.php';
$conexionBD = BaseDatos::crearInstancia();

function obtenerListaClientes($conexionBD) {
    try {
        $consulta = $conexionBD->prepare("
        SELECT IdCliente, Nombre, Apellido, Telefono
        FROM Cliente");
        $consulta->execute();

        $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        return $lista;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false; // En caso de error, retornamos falso
    }
}

?>


