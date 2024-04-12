<?php include('../temporal/cabecera.php'); ?>
<?php include('../datos/trabajos.php'); ?>

<?php
$lista = obtenerListaCategorias($conexionBD);
$trabajos = obtenerListaTrabajos($conexionBD);

?>



<div class = "row">
                    
    <div class = "col-12">
        <br>
        <div class = "row"> 


        <div class = "col-md-5">
            <form action="" method="post">

            <div class="card">
                <div class="text-center text-secondary alert alert-success">Gestion de Trabajos</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Trabajo</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nombre_trabajo"
                            id="nombre_trabajo"
                            placeholder="Nombre del Trabajo"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Codigo del Trabajo</label>
                        <input
                            type="number"
                            class="form-control"
                            name="codigo_trabajo"
                            id="codigo_trabajo"
                            placeholder="Indique el codigo del trabajo actual"
                            min="40000" 
                            step="1"
                            required
                        >
                        <div id="helpId" class="form-text">Ingrese un número válido para el codigo Inicia en 40000.</div>
                    </div>

                    <div class="mb-3">
                        <label for="tipo_trabajo" class="form-label">Tipo de Trabajo</label>
                        <select class="form-select" name="tipo_trabajo" id="tipo_trabajo" >
                            <option value="" disabled selected>Seleccionar</option>
                            <!-- Aquí recuperas las opciones desde la base de datos y las iteras para mostrarlas -->
                            <!-- Por ejemplo, si las opciones están en un array llamado $opciones en PHP: -->
                            <?php foreach ($lista as $elemento) { ?>
                                <option value="<?php echo $elemento['NombreCategoria']; ?>"><?php echo $elemento['NombreCategoria']; ?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="" class="form-label">Cantidad</label>
                        <input
                            type="number"
                            class="form-control"
                            name="cantidad_trabajo"
                            id="cantidad_trabajo"
                            placeholder="Cantidad del Trabajo Encargado"
                            min="0" 
                            step="1"
                            required
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
                            pattern="[0-9]+(\.[0-9]+)?"
                            required
                        >
                        <div id="helpId" class="form-text">Ingrese un número válido (puede incluir decimales)</div>
                    </div>

                    <div class="btn-group" role="group" aria-label="Button group name">
                        <button
                            type="submit"
                            name="accion"
                            value = "agregar"
                            class="btn btn-success btn-block"
                        >
                            Agregar
                        </button>
                        <button
                            type="submit"
                            name="accion"
                            value="editar"
                            class="btn btn-primary btn-block"
                        >
                            Editar
                        </button>
                        <button
                            type="submit"
                            name="accion"
                            value="eliminar"
                            class="btn btn-danger btn-block" 
                        >
                            Eliminar
                        </button>
                    </div>

                </div>
            </div>


            </form>
                
            

        </div>


        <div class = "col-md-7">
            <div class="table">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th> 
                            <th scope="col">Trabajo</th> 
                            <th scope="col">Codigo Trabajo</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Precio Trabajo [Bs]</th>
                            <th scope="col">Cantidad a Realizar</th>
                            <th scope="col">Observacion</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1 ?>
                        <?php foreach ($trabajos as $elemento) { ?>
                            <tr>
                                <td> <?php echo $contador ?>  </td>
                                <td> <?php echo $elemento['NombreTrabajo']; ?>  </td>
                                <td> <?php echo $elemento['NumeroTrabajo']; ?>  </td>
                                <td> <?php echo $elemento['NombreCategoria']; ?>  </td>
                                <td> <?php echo $elemento['SubTotal']; ?>  </td>
                                <td> <?php echo $elemento['Cantidad']; ?>  </td>
                                <td><a href="vista_observaciones.php" class="btn btn-primary"> <i class="fa-solid fa-plus"></i> </a></td>
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
                            // Remover la clase "seleccionada" de todas las filas
                            filas.forEach(function(f) {
                                f.classList.remove("seleccionada");
                            });

                            // Agregar la clase "seleccionada" a la fila actual
                            fila.classList.add("seleccionada");

                            const celdas = fila.querySelectorAll("td");

                            // Obtener datos de las celdas
                            const nombreTrabajo = celdas[1].textContent;
                            const codigoTrabajo = Number(celdas[2].textContent);
                            const tipoTrabajo = String(celdas[3].textContent);
                            const precioTrabajo = Number(celdas[4].textContent);
                            const cantidadTrabajo = Number(celdas[5].textContent);

                            document.getElementById("nombre_trabajo").value = nombreTrabajo;
                            document.getElementById("codigo_trabajo").value = codigoTrabajo;
                            document.getElementById("precio_trabajo").value = precioTrabajo;
                            document.getElementById("cantidad_trabajo").value = cantidadTrabajo;

                            var tipoTrabajoSelect = document.getElementById("tipo_trabajo");

                            for (var i = 0; i < tipoTrabajoSelect.options.length; i++) {
                                var option = tipoTrabajoSelect.options[i];
                                if (option.value.trim() == tipoTrabajo.trim()) {
                                    tipoTrabajoSelect.selectedIndex = i;
                                    break;
                                }
                            }

                            // Mostrar un mensaje de confirmación al usuario
                            alert("Trabajo seleccionado: " + nombreTrabajo);
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