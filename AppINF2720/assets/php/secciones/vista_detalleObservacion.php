<?php include('../temporal/cabecera.php'); ?>
<?php include('../datos/detalle_obs.php'); ?>

<?php
$lista = obtenerListaMateriales($conexionBD);
?>

<div class="row">
    <div class="col-12">
        <br>
        <div class="row"> 
            <div class="col-md-5">
                <form action="" method="post">
                    <div class="card">
                        <h3 class="text-center text-secondary alert alert-success">Selección de Materiales</h3>

                        <input type="hidden" name="id_material" id="id_material" value="">

                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label" style="font-weight: bold;">Numero de Observacion</label>
                                <label for="" class="form-label" style="font-weight: bold;"><?php echo $NumeroObservacion;?></label>
                            </div>


                            <div class="mb-3">
                                <label for="" class="form-label">Material</label>
                                <input type="text" class="form-control" name="material" value="" placeholder="Nombre Material" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Precio Compra</label>
                                <input type="text" class="form-control" name="precio_compra" value="" placeholder="Precio Unitario del Material" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Cantidad de Material a Usar</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="cantidad_material"
                                    id="cantidad_material"
                                    placeholder="Establezca una cantidad menor al Almacenado en Inventario"
                                    min="0" 
                                    step="1"
                                    required
                                >
                            </div>
                            
                            <button
                                id="botonAgregar"
                                type="submit"
                                name="accion"
                                value="agregar"
                                class="btn btn-success btn-block"
                            >
                            <i class="fa-solid fa-download"></i>
                                Agregar al Trabajo
                            </button>

                            
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-7">
                <div class="table">
                    <table class="table table-striped table table-">
                        <thead>
                            <tr> 
                                <th scope="col" >#</th> 
                                <th scope="col" >Nombre</th> 
                                <th scope="col" >Precio Compra</th> 
                                <th scope="col" >Cantidad Almacen</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1 ?>
                            <?php foreach ($lista as $elemento) { ?>
                                <tr data-idMaterial="<?php echo $elemento['IdMaterial']; ?>">
                                    <td> <?php echo $contador ?>  </td>
                                    <td> <?php echo $elemento['Nombre']; ?>  </td>
                                    <td> <?php echo $elemento['PrecioCompra']; ?>  </td>
                                    <td> <?php echo $elemento['Stock']; ?>  </td>
                                </tr>
                                <?php $contador += 1 ?> 
                            <?php } ?> 
                        </tbody>
                    </table>   
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const filas = document.querySelectorAll("tbody tr");

                            filas.forEach(function(fila, indice) {
                                fila.addEventListener("click", function() {
                                    // Obtener datos de las celdas
                                    const idMaterial = fila.getAttribute("data-idMaterial")
                                    const nombreMaterial = fila.querySelectorAll("td")[1].textContent;
                                    const precioCompra = fila.querySelectorAll("td")[2].textContent;

                                    // Colocar datos en los inputs
                                    document.querySelector("input[name='material']").value = nombreMaterial;
                                    document.querySelector("input[name='precio_compra']").value = precioCompra;
                                    document.getElementById("id_material").value = idMaterial;
                                    
                                });
                            });
                        });
                    </script>

                </div>
            </div>
        </div>         
    </div>
</div>





<?php include('../temporal/pie.php'); ?>
