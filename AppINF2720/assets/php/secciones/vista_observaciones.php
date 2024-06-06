<?php include('../temporal/cabecera.php'); ?>
<?php include('../datos/observaciones.php'); ?>

<?php
$lista = obtenerListaObservaciones($conexionBD);
?>

<div class="row">
    <div class="col-12">
        <br>
        <div class="row"> 
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="card">
                        <h3 class="text-center text-secondary alert alert-success">Observacion</h3>
                        <input type="hidden" name="id-obs" id="id-obs" value="">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label" style="font-weight: bold;">Codigo del Trabajo</label>
                                <label for="" class="form-label" style="font-weight: bold;"><?php echo $NumeroTrabajo;?></label>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Numero de Observacion</label>
                                <input type="number" class="form-control" name="num-obs" id="num-obs" placeholder="Numero de Observacion Realizada" min="0" step="1" required>
                            </div>
                            <div class="mb-3">
                                <label for="material" class="form-label">Descripcion Observacion</label>
                                <textarea type="text" class="form-control" name="descripcion" id="descripcion" rows="5" maxlength="300" placeholder="Detalles solicitados en el trabajo"></textarea>
                                <div class="form-text">Ingrese una descripción del material (máximo 255 caracteres).</div>
                            </div>
                            <div class="btn-group" role="group" aria-label="Button group name">
                                <button type="submit" name="accion" value="agregar" class="btn btn-success btn-block">Agregar</button>
                                <button type="submit" name="accion" value="editar" class="btn btn-primary btn-block"  onclick="return confirm('¿Estás seguro de que deseas editar esta Observacion?')">Editar</button>
                                <button type="submit" name="accion" value="borrar" class="btn btn-danger btn-block" onclick="return confirm('¿Estás seguro de que deseas eliminar esta Observacion?')">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="table">
                    <?php foreach ($lista as $elemento) { ?>
                        <table class="table table-striped table table-">
                            <thead>
                                <tr> 
                                    <th scope="col" class="encabezado" 
                                        data-descripcion="<?php echo $elemento['Descripcion']; ?>"
                                        data-numero-observacion="<?php echo $elemento['NumeroObservacion']; ?>"
                                        data-id-observacion="<?php echo $elemento['IdObservacion']; ?>">
                                        <div>
                                            <div style="float: left; margin-right: 10px;">
                                                Numero de Observacion: <?php echo $elemento['NumeroObservacion'];?>
                                            </div>
                                            <div style="float: left; margin-left: 100px;">
                                                Fecha: <?php echo $elemento['FechaObservacion'];?>
                                            </div>
                                            <div style="clear: both;"></div> 
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <form action="vista_detalleObservacion.php" method="GET" style="display: inline-block;">
                                                <input type="hidden" name="IdObservacion" value="<?php echo $elemento['IdObservacion']; ?>">
                                                <input type="hidden" name="NumeroObservacion" value="<?php echo $elemento['NumeroObservacion']; ?>">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fa-solid fa-plus"></i> Agregar Material
                                                </button>
                                            </form>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>
                                    <?php $materiales = obtenerListaObservacion_M($conexionBD, $elemento['IdObservacion']);?>
                                    <table class="table table-striped table">
                                        <tr>
                                            <th>Nombre Material</th>
                                            <th>Cantidad en Uso</th>
                                            <th>Eliminar</th>
                                        </tr>
                                        <?php foreach ($materiales as $material) { ?>
                                        <tr>
                                            <td><?php echo $material['Nombre']; ?></td>
                                            <td><?php echo $material['CantidadUso']; ?></td>
                                            <td>
                                                <form method="POST">
                                                    <input type="hidden" name="IdDetalleObservacion" value="<?php echo $material['IdDetalleObservacion']; ?>">
                                                    <button type="submit" class="btn btn-danger" name="accion2" value="ocultar" ><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?> 
                                    </table>
                                </td>
                            </tbody>
                        </table>
                    <?php } ?> 
                </div>
            </div>
        </div>         
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const encabezados = document.querySelectorAll(".encabezado");

        encabezados.forEach(function(encabezado) {
            encabezado.addEventListener("click", function() {
                const descripcion = encabezado.getAttribute("data-descripcion");
                const numeroObservacion = encabezado.getAttribute("data-numero-observacion");
                const IdObservacion = encabezado.getAttribute("data-id-observacion");
                
                
                document.getElementById("descripcion").value = descripcion;
                document.getElementById("num-obs").value = numeroObservacion;
                document.getElementById("id-obs").value = IdObservacion;
                
            });
        });
    });
</script>

<?php include('../temporal/pie.php'); ?>

