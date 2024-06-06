<?php include('../temporal/cabecera.php'); ?>
<?php include('../datos/seleccion_trabajo.php'); ?>

<?php
$lista = obtenerListaTrabajos($conexionBD);
?>

<div class="row">
    <div class="col-12">
        <br>
        <div class="row"> 
            <div class="col-md-4">
                <form action="vista_transacciones.php" method="post">
                    <div class="card">
                        <h3 class="text-center text-secondary alert alert-success">Selección de Trabajos</h3>

                        <div class="card-body">
                            
                        <input type="hidden" name="id_trabajo" id="id_trabajo" value="">
                        <input type="hidden" name="origen" value="trabajo">

                        <div class="mb-3">
                            <label for="" class="form-label">Trabajo</label>

                            <input
                                type="text"
                                class="form-control"
                                name="nombre_trabajo"
                                id="nombre_trabajo"
                                placeholder="Nombre del Trabajo"
                                required
                                readonly
                            >
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Codigo del Trabajo</label>
                            <input
                                type="text"
                                class="form-control"
                                name="codigo_trabajo"
                                id="codigo_trabajo"
                                placeholder="Indique el codigo del trabajo actual"
                                required
                                readonly
                            >
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Cantidad</label>
                            <input
                                type="text"
                                class="form-control"
                                name="cantidad_trabajo"
                                id="cantidad_trabajo"
                                placeholder="Cantidad del Trabajo Encargado"
                                readonly
                            >
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Precio Total del Trabajo</label>
                            <input
                                type="text"
                                class="form-control"
                                name="precio_trabajo"
                                id="precio_trabajo"
                                aria-describedby="helpId"
                                placeholder="Precio en Bs"
                                readonly
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
                                Seleccionar el Trabajo
                            </button>

                            
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <div class="table">
                    <table class="table table-striped table table-">
                        <thead>
                            <tr> 
                                <th scope="col" >#</th> 
                                <th scope="col" >Nombre Trabajo</th> 
                                <th scope="col" >Numero Trabajo</th> 
                                <th scope="col" >Cantidad</th> 
                                <th scope="col" >Precio Trabajo</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1 ?>
                            <?php foreach ($lista as $elemento) { ?>
                                <tr data-idTrabajo="<?php echo $elemento['IdTrabajo']; ?>">
                                    <td> <?php echo $contador ?>  </td>
                                    <td> <?php echo $elemento['NombreTrabajo']; ?>  </td>
                                    <td> <?php echo $elemento['NumeroTrabajo']; ?>  </td>
                                    <td> <?php echo $elemento['Cantidad']; ?>  </td>
                                    <td> <?php echo $elemento['SubTotal']; ?>  </td>
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
                                    const idTrabajo = fila.getAttribute("data-idTrabajo")
                                    const nombreTrabajo = fila.querySelectorAll("td")[1].textContent;
                                    const numeroTrabajo = fila.querySelectorAll("td")[2].textContent;
                                    const cantidad = fila.querySelectorAll("td")[3].textContent;
                                    const subTotal = fila.querySelectorAll("td")[4].textContent;
                                    // Colocar datos en los inputs
                                    document.querySelector("input[name='nombre_trabajo']").value = nombreTrabajo;
                                    document.querySelector("input[name='codigo_trabajo']").value = numeroTrabajo;
                                    document.querySelector("input[name='cantidad_trabajo']").value = cantidad;
                                    document.querySelector("input[name='precio_trabajo']").value = subTotal;
                                    document.getElementById("id_trabajo").value = idTrabajo;
                                                                        
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