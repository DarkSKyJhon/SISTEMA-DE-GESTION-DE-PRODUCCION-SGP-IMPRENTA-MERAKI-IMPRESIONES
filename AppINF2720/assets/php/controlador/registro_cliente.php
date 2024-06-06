<?php
if(!empty($_POST["btnregistrar"])){
    
    if(!empty ($_POST["nombre"]) and !empty ($_POST["apellido"]) and !empty ($_POST["correo"]) and !empty ($_POST["telefono"]) and !empty ($_POST["direccion"]) ){
      $nombre=$_POST['nombre'];
      $apellido=$_POST['apellido'];
      $correo=$_POST['correo'];
      $telefono=$_POST['telefono'];
      $direccion=$_POST['direccion'];

      $sql=$conexion->query("insert into cliente(Nombre,Apellido,Correo,Telefono,Direccion) values('$nombre','$apellido','$correo','$telefono','$direccion')");
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