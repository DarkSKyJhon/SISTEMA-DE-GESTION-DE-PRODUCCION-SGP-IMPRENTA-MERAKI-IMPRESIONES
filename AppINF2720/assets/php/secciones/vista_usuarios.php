<?php 
include('../temporal/cabecera.php');
?>
<script>
  function eliminar() {
    var respuesta = confirm("¿Estás seguro que deseas eliminar?");
    return respuesta;
  }
</script>
<?php 
include "../datos/usuarios.php";
include "../controlador/eliminar_usuario.php";
$fechaActual = date("Y-m-d");
?>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <form class="p-3 border rounded" method="POST">
        <h3 class="text-center text-secondary alert alert-success">Registro de Usuarios</h3>
        <?php
        include "../controlador/registro_usuario.php";
        ?>
        <div class="mb-3">
          <label class="form-label">Nombre:</label>
          <input type="text" class="form-control" name="nombre" placeholder="Nombre del cliente" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Apellido:</label>
          <input type="text" class="form-control" name="apellido" placeholder="Apellido del cliente" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Correo:</label>
          <input type="email" class="form-control" name="correo" placeholder="example@gmail.com" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Teléfono:</label>
          <input type="text" class="form-control" name="telefono" placeholder="12345678" required>
        </div>
        <div class="mb-3">
          <label class="form-label d-flex align-items-center">Estado:</label>
          <select class="form-control" name="estado" required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Fecha de Registro:</label>
          <input type="text" class="form-control" name="fecha" value="<?php echo $fechaActual; ?>" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Usuario:</label>
          <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Contraseña:</label>
          <input type="text" class="form-control" name="contrasenia" placeholder="Contraseña" required>
        </div>
        <div class="mb-3 text-center">
          <button type="submit" class="btn btn-primary" style="width: 100%;" name="btnregistrar" value="ok">Registrar</button>
        </div>
      </form>
    </div>

    <div class="col-md-8">
      <div class="p-4">
        <table class="table table-striped table-sm">
          <thead class="bg-info">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Correo</th>
              <th scope="col">Teléfono</th>
              <th scope="col">Estado</th>
              <th scope="col">FechaRegistro</th>
              <th scope="col">Usuario</th>
              <th scope="col">Contraseña</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = $conexion->query("SELECT * FROM usuario");
            while($datos = $sql->fetch_object()) { ?>
              <tr>
                <td><?= $datos->IdUsuario ?></td>
                <td><?= $datos->Nombre ?></td>
                <td><?= $datos->Apellido ?></td>
                <td><?= $datos->Correo ?></td>
                <td><?= $datos->Telefono ?></td>
                <td><?= $datos->Estado == 1 ? 'Activo' : 'Inactivo' ?></td>
                <td><?= $datos->FechaRegistro ?></td>
                <td><?= $datos->Usuario ?></td>
                <td><?= $datos->Contrasenia ?></td>
                <td class="d-flex">
                  <a href="../controlador/modificar_usuario.php?id=<?= $datos->IdUsuario ?>" class="btn btn-small btn-warning me-2">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  <a onclick="return eliminar()" href="vista_usuarios.php?id=<?= $datos->IdUsuario ?>" class="btn btn-small btn-danger">
                    <i class="fa-solid fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include('../temporal/pie.php'); ?>