<?php 
include "../datos/usuarios.php";
include('../temporal/cabecera.php');

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conexion->query("SELECT * FROM usuario WHERE IdUsuario = $id");
    
    if ($sql->num_rows > 0) {
        $datos = $sql->fetch_object();
?>
        <form class="col-4 p-3 m-auto border rounded" method="POST">
            <h3 class="text-center text-secondary alert alert-success">Modificar Usuario</h3>
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
            if (isset($_POST["btnregistrar"])) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $correo = $_POST['correo'];
                $telefono = $_POST['telefono'];
                $estado = $_POST['estado'];
                $usuario = $_POST['usuario'];
                $contrasenia = $_POST['contrasenia'];

                // Preparar la consulta para actualizar el usuario
                $stmt = $conexion->prepare("UPDATE usuario SET Nombre=?, Apellido=?, Correo=?, Telefono=?, Estado=?, Usuario=?, Contrasenia=? WHERE IdUsuario=?");
                $stmt->bind_param("ssssissi", $nombre, $apellido, $correo, $telefono, $estado, $usuario, $contrasenia, $id);

                if ($stmt->execute()) {
                    header("location:../secciones/vista_usuarios.php");
                } else {
                    echo "<div class='alert alert-danger'>Error al modificar Usuario</div>";
                }
                $stmt->close();
            }
            ?>
            <div class="mb-3">
                <label class="form-label">Nombre del Usuario</label>
                <input type="text" class="form-control" name="nombre" value="<?= $datos->Nombre ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellido del Usuario</label>
                <input type="text" class="form-control" name="apellido" value="<?= $datos->Apellido ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo del Usuario</label>
                <input type="email" class="form-control" name="correo" value="<?= $datos->Correo ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Teléfono del Usuario</label>
                <input type="text" class="form-control" name="telefono" value="<?= $datos->Telefono ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado del Usuario</label>
                <select class="form-control" name="estado" required>
                    <option value="1" <?= $datos->Estado == '1' ? 'selected' : '' ?>>Activo</option>
                    <option value="0" <?= $datos->Estado == '0' ? 'selected' : '' ?>>Inactivo</option>
                </select>
            </div>
            <input type="hidden" name="fecha" value="<?= $datos->FechaRegistro ?>">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario" value="<?= $datos->Usuario ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="text" class="form-control" name="contrasenia" value="<?= $datos->Contrasenia ?>" required>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary" style="width: 100%;" name="btnregistrar" value="ok">Modificar</button>
            </div>
        </form>
<?php 
        
        include('../temporal/pie.php');
    } else {
        echo "<div class='alert alert-danger'>Usuario no encontrado.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID de usuario no proporcionado.</div>";
}
?>
