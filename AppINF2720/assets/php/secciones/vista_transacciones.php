<?php include('../temporal/cabecera.php'); ?>
<?php include('../datos/transacciones.php'); ?>

<?php
$trabajos = obtenerListaTrabajos($conexionBD);

?>

<form action="" method = "POST">
<div class = "row">
           
    <div class = "col-12">
        <br>
        <div class = "row"> 
        <div class = "col-md-5">
            <div class="card">
                <h3 class="text-center text-secondary alert alert-success">Datos de la Transaccion</h3>
                <div class="card-body" style="display: flex; flex-wrap: wrap;">
                    <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $_SESSION['id_cliente'];?>">
                    <input type="hidden" name="id_trabajo" id="id_trabajo" value="<?php echo $_SESSION['id_trabajo'] ;?>">
                    <div class="mb-3" style="flex: 1;">
                        <label for="" class="form-label">Número</label>
                        <input
                            type="number"
                            class="form-control"
                            name="numero_transaccion"
                            id="numero_transaccion"
                            min="40000"
                            placeholder="40000-100000"
                            value="<?php echo isset($_SESSION['numero_transaccion']) ? $_SESSION['numero_transaccion'] : ''; ?>"
                            required
                        >
                    </div>
                    <div class="mb-3" style="flex: 1;">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input
                            type="date" 
                            class="form-control"
                            name="fecha" 
                            id="fecha"
                            placeholder="Fecha"
                            value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : ''; ?>"
                            required
                        >
                    </div>
                    <div class="mb-3" style="flex: 1;">
                        <label for="tipo_trabajo" class="form-label">Tipo de Transacción</label>
                        <select class="form-select" name="tipo_transaccion" id="tipo_transaccion" style="width: 100%;">
                            <option value="" disabled selected>Seleccionar</option>
                            <option value="">Recibo</option>
                            <option value="">Factura</option>
                        </select>
                    </div>
                </div>
            </div>              
        </div>

        <div class ="col-md-1"></div>
        <div class="col-md-5">
            <div class="card">
                <h3 class="text-center text-secondary alert alert-success">Datos del Cliente</h3>
                <div class="card-body" style="display: flex; flex-wrap: wrap;">
                    <div class="mb-3" style="flex: 1;">
                        <label for="" class="form-label">Nombre del Cliente</label>
                        <div style="display: flex;">
                            <input
                                type="text"
                                class="form-control"
                                name="institucion"
                                id="institucion"
                                placeholder="Persona encargada de realizar el contrato"
                                value="<?php echo $_SESSION['nombre_completo_cliente']; ?>"
                                readonly
                                required
                            >
                            <a href="vista_seleccionCliente.php" class="btn btn-small btn-success"><i class="fa-solid fa-magnifying-glass"></i></a>
                        </div>
                    </div>
                </div>
            </div>   
        </div>

        <script>
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('fecha').value = today;
        </script>
        </div>         
    </div>
</div>

<br>
<div class = "row">

    <div class = "col-md-11">
        <div class="card">
            <h3 class="text-center text-secondary alert alert-success">Incorporación de Trabajos</h3>
            <div class="card-body" style="display: flex; flex-wrap: wrap;">
                <div class="mb-3" style="flex: 1;">
                    <label for="fecha" class="form-label">Codigo Trabajo</label>
                    <div style="display: flex;">
                        <input
                            type="text" 
                            class="form-control"
                            name="numero_trabajo" 
                            id="numero_trabajo"
                            placeholder="Numero del Trabajo"
                            min="1000"
                            value="<?php echo isset($_SESSION['numero_trabajo']) ? $_SESSION['numero_trabajo'] : ''; ?>"
                            required
                        >
                        <a href="vista_seleccionTrabajo.php" class="btn btn-small btn-success"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                </div>
                <div class="mb-3" style="flex: 1;">
                    <label for="" class="form-label">Nombre del Trabajo</label>
                    <input
                        type="text"
                        class="form-control"
                        name="trabajo"
                        id="trabajo"
                        placeholder="Trabajo Realizado"
                        value="<?php echo isset($_SESSION['nombre_trabajo']) ? $_SESSION['nombre_trabajo'] : ''; ?>"
                        readonly
                        required
                    >
                </div>
                <div class="mb-3" style="flex: 1;">
                    <label for="" class="form-label">Precio del Trabajo</label>
                    <input
                        type="text"
                        class="form-control"
                        name="precio_trabajo"
                        id="precio_trabajo"
                        value="<?php echo isset($_SESSION['precio_trabajo']) ? $_SESSION['precio_trabajo'] : ''; ?>"
                        placeholder="Precio Total del Trabajo"
                        readonly
                        required
                    >
                </div>
                <div class="mb-3" style="flex: 1;">
                    <label for="" class="form-label">Cantidad Encargada</label>
                    <input
                        type="text"
                        class="form-control"
                        name="cantidad_trabajo"
                        id="cantidad_trabajo"
                        value="<?php echo isset($_SESSION['cantidad_trabajo']) ? $_SESSION['cantidad_trabajo'] : ''; ?>"
                        placeholder="Cantidad de unidades realizadas"
                        readonly
                        required
                    >
                </div>
                
                <button
                    type="submit" 
                    class="btn btn-primary"
                    name="evento"
                    value="agregar"
                    onclick="return confirm('¿Estás seguro de que deseas agregar este trabajo?')"
                >
                <i class="fa-solid fa-paperclip"></i>
                    Agregar
                </button>
            
            </div>
        </div>              
    </div>

</div>
</form>

<br>
<div class = "row">

    <div class="col-md-11">
        <div class="table">
            <table class="table table-striped table table-">
                <thead>
                    <tr>
                        <th scope="col">#</th> 
                        <th scope="col">Trabajo</th> 
                        <th scope="col">Codigo Trabajo</th>
                        <th scope="col">Precio Trabajo [Bs]</th>
                        <th scope="col">Cantidad a Realizar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($trabajos)) { ?>
                        <tr style="opacity: 0.7;" >
                            <td colspan="7">Sin Trabajos registrados en la Transaccion actual</td>
                        </tr>
                    <?php } else { ?>
                        <?php $contador = 1; ?>
                            <?php foreach ($trabajos as $elemento) { ?>
                            <tr data-idtrabajo="<?php echo $elemento['IdTrabajo']; ?>">
                                <td> <?php echo $contador ?>  </td>
                                <td> <?php echo $elemento['NombreTrabajo']; ?>  </td>
                                <td> <?php echo $elemento['NumeroTrabajo']; ?>  </td>
                                <td> <?php echo $elemento['SubTotal']; ?>  </td>
                                <td> <?php echo $elemento['Cantidad']; ?>  </td>
                                <td>
                                </td>
                            </tr>
                            <?php $contador += 1; ?> 
                        <?php } ?>  
                    <?php } ?>                          
                </tbody>
            </table>
        </div>        
    </div>

</div>

<?php include('../temporal/pie.php'); ?> 
