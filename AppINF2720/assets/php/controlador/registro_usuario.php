<?php
if(!empty($_POST["btnregistrar"])){
    
    if(!empty ($_POST["nombre"]) and !empty ($_POST["apellido"]) and !empty ($_POST["correo"]) and !empty ($_POST["telefono"]) and !empty ($_POST["estado"]) and !empty ($_POST["fecha"]) and !empty ($_POST["usuario"]) and !empty ($_POST["contrasenia"]) ){
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $correo=$_POST['correo'];
        $telefono=$_POST['telefono'];
        $estado=$_POST['estado'];
        $fecha=$_POST['fecha'];
        $usuario=$_POST['usuario'];
        $contrasenia=$_POST['contrasenia'];
        
        $hash_contrasenia = md5($contrasenia); // Aplicar MD5 a la contraseña
        
        $sql=$conexion->query("insert into usuario(Nombre,Apellido,Correo,Telefono,Estado,FechaRegistro,Usuario,Contrasenia) values('$nombre','$apellido','$correo',$telefono,$estado,'$fecha','$usuario','$hash_contrasenia')");
        if ($sql==1){
            echo '<div class="alert alert-success>Cliente registrado correctamente</div>"';
        } else{
            echo '<div class="alert alert-success>Error al registrar Cliente</div>"';
        }
    }else{
        echo '<div class="alert alert-success>Campos vacios</div>"';
    }
}
?>
