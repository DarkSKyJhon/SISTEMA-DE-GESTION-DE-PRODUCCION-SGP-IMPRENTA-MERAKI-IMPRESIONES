<?php
if(isset($_POST['btnregistrar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

  
    if(!empty($nombre) && !empty($apellido) && !empty($correo) && !empty($telefono) && isset($estado) && !empty($fecha) && !empty($usuario) && !empty($contrasenia)) {
        
        $sql = $conexion->prepare("INSERT INTO usuario (Nombre, Apellido, Correo, Telefono, Estado, FechaRegistro, Usuario, Contrasenia) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssisss", $nombre, $apellido, $correo, $telefono, $estado, $fecha, $usuario, $contrasenia);

       
        if($sql->execute()) {
            echo "<div class='alert alert-success'>Usuario registrado exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al registrar usuario.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Todos los campos son obligatorios.</div>";
    }
}
?>
