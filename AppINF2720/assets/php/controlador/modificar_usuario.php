<?php 
include "../datos/usuarios.php";
include('../temporal/cabecera.php');


if(isset($_GET["id"])) {
    $id = $_GET["id"];

    
    $sql = $conexion->query("SELECT * FROM usuario WHERE IdUsuario = $id");

?>
    <form class="col-4 p-3 m-auto border rounded" method="POST">
        <h3 class="text-center text-secondary alert alert-success">Modificar Usuario</h3>
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <?php
       
        if(isset($_POST["btnregistrar"])) {
            if(!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["correo"]) and !empty($_POST["telefono"]) and !empty($_POST["estado"]) and !empty($_POST["fecha"]) and !empty($_POST["usuario"]) and !empty($_POST["contrasenia"])){
               $id=$_POST["id"];
               $nombre=$_POST['nombre'];
               $apellido=$_POST['apellido'];
               $correo=$_POST['correo'];
               $telefono=$_POST['telefono'];
               $estado=$_POST['estado'];
               $fecha=$_POST['fecha'];
               $usuario=$_POST['usuario'];
               $contrasenia=$_POST['contrasenia'];
               $sql=$conexion->query(" update usuario set Nombre='$nombre',Apellido='$apellido',Correo='$correo',Telefono=$telefono,Estado=$estado,FechaRegistro='$fecha',Usuario='$usuario',Contrasenia='$contrasenia' where IdUsuario=$id");
               if ($sql==1){
                header("location:../secciones/vista_usuarios.php");

               }else{
                echo "<div class='alert alert-danger'>Error al modificar Usuario</div>";

               }

            }else{
             echo "<div class='alert alert-warning'>campos vacios</div>";
            }

            
        }

        
        while($datos = $sql->fetch_object()) {
        ?>
        <div class="mb-3">
            <label class="form-label">Nombre del Usuario</label>
            <input type="text" class="form-control" name="nombre" value="<?= $datos->Nombre ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido del Usuario</label>
            <input type="text" class="form-control" name="apellido" value="<?= $datos->Apellido ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Correo del Usuario</label>
            <input type="email" class="form-control" name="correo" value="<?= $datos->Correo ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono del  Usuario</label>
            <input type="text" class="form-control" name="telefono" value="<?= $datos->Telefono ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Estado del Usuario</label>
            <input type="text" class="form-control" name="estado" value="<?= $datos->Estado ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">FechaRegistro del Usuario</label>
            <input type="text" class="form-control" name="fecha" value="<?= $datos->FechaRegistro ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" value="<?= $datos->Usuario ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="text" class="form-control" name="contrasenia" value="<?= $datos->Contrasenia ?>">
        </div>
        <?php } ?>
        <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary" style="width: 100%;" name="btnregistrar" value="ok">Modificar</button>
        </div>
    </form>

<?php 
    // Incluir el pie del HTML
    include('../temporal/pie.php');
}
?>
