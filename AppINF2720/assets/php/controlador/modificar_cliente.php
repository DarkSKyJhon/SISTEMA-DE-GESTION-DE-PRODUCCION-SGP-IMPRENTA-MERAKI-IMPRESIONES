<?php 
include "../datos/clientes.php";
include('../temporal/cabecera.php');

if(isset($_GET["id"])) {
    $id = $_GET["id"];

    
    $sql = $conexion->query("SELECT * FROM cliente WHERE IdCliente = $id");

    
    
?>
    <form class="col-4 p-3 m-auto border rounded" method="POST">
        <h3 class="text-center text-secondary alert alert-success">Modificar Cliente</h3>
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <?php
       
        if(isset($_POST["btnregistrar"])) {
            if(!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["correo"]) and !empty($_POST["telefono"]) and !empty($_POST["direccion"])){
               $id=$_POST["id"];
               $nombre=$_POST["nombre"];
               $apellido=$_POST["apellido"];
               $correo=$_POST["correo"];
               $telefono=$_POST["telefono"];
               $direccion=$_POST["direccion"];
               $sql=$conexion->query(" update cliente set Nombre='$nombre',Apellido='$apellido',Correo='$correo',Telefono='$telefono',Direccion='$direccion' where IdCliente=$id");
               if ($sql==1){
                header("location:../secciones/vista_clientes.php");

               }else{
                echo "<div class='alert alert-danger'>Error al modificar Cliente</div>";

               }

            }else{
             echo "<div class='alert alert-warning'>campos vacios</div>";
            }

            
        }

        
        while($datos = $sql->fetch_object()) {
        ?>
        <div class="mb-3">
            <label class="form-label">Nombre del Cliente</label>
            <input type="text" class="form-control" name="nombre" value="<?= $datos->Nombre ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido del Cliente</label>
            <input type="text" class="form-control" name="apellido" value="<?= $datos->Apellido ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Correo del Cliente</label>
            <input type="email" class="form-control" name="correo" value="<?= $datos->Correo ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono del Cliente</label>
            <input type="text" class="form-control" name="telefono" value="<?= $datos->Telefono ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección Cliente</label>
            <input type="text" class="form-control" name="direccion" value="<?= $datos->Direccion ?>">
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
