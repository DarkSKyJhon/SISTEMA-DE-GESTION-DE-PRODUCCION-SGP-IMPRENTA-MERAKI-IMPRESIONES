<?php
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    
    $conexion = new mysqli("localhost", "root", "", "aplicacion_web");
    if($conexion->connect_error){
        echo "<script>alert('Error al conectar con la base de datos');</script>";
    } else {
        $consulta = $conexion->prepare("SELECT * FROM usuario WHERE usuario = ?");
        $consulta->bind_param("s", $usuario);
        $consulta->execute();

        $consulta_resultado = $consulta->get_result();
        if($consulta_resultado->num_rows > 0){
            $data = $consulta_resultado->fetch_assoc();
            if($data['Contrasenia'] == $password){
                echo "<script>alert('Acceso Concedido'); window.location.href = 'secciones/index.php';</script>";
            } else {
                echo "<script>alert('Contraseña Incorrecta');</script>";
            }
        } else {
            echo "<script>alert('Nombre de Usuario Invalido');</script>";
        }
    }
?>
