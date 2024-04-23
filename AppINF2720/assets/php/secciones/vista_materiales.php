<?php include('../temporal/cabecera.php'); ?>
<?php include('../datos/materiales.php'); ?>


<div class = "row">
                    
    <div class = "col-12">
        <br>
        <div class = "row"> 


        <div class = "col-md-5">
            <form action="" method="post">


            <div class="card">
                <h3 class="text-center text-secondary alert alert-success">Gestion de Materiales</h3>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">ID</label>
                        <input
                            type="text"
                            class="form-control"
                            name="id"
                            id="id"
                            value = "<?php echo $IdMaterial;?>"
                            aria-describedby="helpId"
                            placeholder="Codigo del material"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Material</label>
                        <input
                            type="text"
                            class="form-control"
                            name="material"
                            id="material"
                            value = "<?php echo $Nombre;?>"
                            placeholder="Nombre del Material"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio Unitario</label>
                        <input
                            type="text"
                            class="form-control"
                            name="precio"
                            id="precio"
                            value = "<?php echo $PrecioCompra;?>"
                            aria-describedby="helpId"
                            placeholder="Precio en Bs"
                            pattern="[0-9]+(\.[0-9]+)?"
                            title="Ingrese un número válido"
                            required
                        >
                        <div id="helpId" class="form-text">Ingrese un número válido (puede incluir decimales).</div>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input
                            type="number"
                            class="form-control"
                            name="cantidad"
                            id="cantidad"
                            value = "<?php echo $Stock;?>"
                            aria-describedby="helpId"
                            placeholder="Cantidad del Material en Inventario"
                            min="0" 
                            step="1"
                            required
                        >
                        <div id="helpId" class="form-text">Ingrese un número válido para la cantidad.</div>
                    </div>

                    <div class="mb-3">
                        <label for="material" class="form-label">Descripcion</label>
                        <textarea
                            type = "text"
                            class="form-control"
                            name="descripcion"
                            id="descripcion"
                            rows="5" 
                            maxlength= 300 
                            placeholder="Descripción del Material"
                        ><?php echo $Descripcion;?></textarea>
                        <div class="form-text">Ingrese una descripción del material (máximo 255 caracteres).</div>
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
            <div class="table-responsive">
                <table class="table table-striped table table-">
                    <thead>
                        <tr>
                            <th scope="col">ID</th> 
                            <th scope="col">Material</th>
                            <th scope="col">Precio Unitario[Bs]</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">#####</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($listaMateriales as $Material){ ?>  
                        <tr>
                            <td> <?php echo $Material['IdMaterial']; ?></td>
                            <td> <?php echo $Material['Nombre']; ?></td>
                            <td> <?php echo $Material['PrecioCompra']; ?> </td>
                            <td> <?php echo $Material['Stock']; ?> </td>
                            <td> <?php echo $Material['Descripcion']; ?> </td>
                            <td>
                                <form action = "" method = "post">
                                    <input type = "hidden" name = "id" id = "id" value = "<?php echo $Material['IdMaterial'];?>"/>
                                    <input type = "submit" value = "Seleccionar" name = "accion" class = "btn btn-info">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        </div>         
    </div>
</div>

<?php include('../temporal/pie.php'); ?>
