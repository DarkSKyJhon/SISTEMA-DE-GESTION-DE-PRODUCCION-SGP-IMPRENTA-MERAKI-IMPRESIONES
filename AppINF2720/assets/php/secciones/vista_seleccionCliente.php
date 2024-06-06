<?php include('../temporal/cabecera.php'); ?>
<?php include('../datos/seleccion_cliente.php'); ?>

<?php
$lista = obtenerListaClientes($conexionBD);
?>

<div class="row">
    <div class="col-12">
        <br>
        <div class="row"> 
            <div class="col-md-4">
                <form action="vista_transacciones.php" method="post">
                    <div class="card">
                        <h3 class="text-center text-secondary alert alert-success">Selección de Clientes</h3>

                        <input type="hidden" name="id_cliente" id="id_cliente" value="">
                        <input type="hidden" name="origen" value="cliente">

                        <div class="card-body">
                            
                            <div class="mb-3">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="n_cliente" value="" placeholder="Nombre del Cliente" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="a_cliente" value="" placeholder="Apellido del Cliente" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Numero de Telefono</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="telefono_cliente"
                                    id="telefono_cliente"
                                    placeholder="Celular - Telefono de Contacto"
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
                                Seleccionar el Cliente
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
                                <th scope="col" >Nombre</th> 
                                <th scope="col" >Apellido</th> 
                                <th scope="col" >Telefono</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1 ?>
                            <?php foreach ($lista as $elemento) { ?>
                                <tr data-idCliente="<?php echo $elemento['IdCliente']; ?>">
                                    <td> <?php echo $contador ?>  </td>
                                    <td> <?php echo $elemento['Nombre']; ?>  </td>
                                    <td> <?php echo $elemento['Apellido']; ?>  </td>
                                    <td> <?php echo $elemento['Telefono']; ?>  </td>
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
                                    const idCliente = fila.getAttribute("data-idCliente")
                                    const nombreCliente = fila.querySelectorAll("td")[1].textContent;
                                    const apellidoCliente = fila.querySelectorAll("td")[2].textContent;
                                    const telefonoCliente = fila.querySelectorAll("td")[3].textContent;
                                    // Colocar datos en los inputs
                                    document.querySelector("input[name='n_cliente']").value = nombreCliente;
                                    document.querySelector("input[name='a_cliente']").value = apellidoCliente;
                                    document.querySelector("input[name='telefono_cliente']").value = telefonoCliente;
                                    document.getElementById("id_cliente").value = idCliente;
                                                                        
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