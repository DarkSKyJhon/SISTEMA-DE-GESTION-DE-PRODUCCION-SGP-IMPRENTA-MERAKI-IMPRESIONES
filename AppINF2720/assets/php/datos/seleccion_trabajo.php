<?php

include_once '../configuraciones/bd.php';
$conexionBD = BaseDatos::crearInstancia();

function obtenerListaTrabajos($conexionBD) {
    try {
        $consulta = $conexionBD->prepare("
        SELECT IdTrabajo, NombreTrabajo, NumeroTrabajo, Cantidad, SubTotal 
        FROM Trabajo  
        ORDER BY NumeroTrabajo DESC");
        $consulta->execute();

        $listaTrabajos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $listaTrabajos;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false; // En caso de error, retornamos falso
    }
}

?>
