<?php
if(!empty($_GET["id"])){
    $id=$_GET["id"];
    $sql=$conexion->query("delete from clientes where IdCliente=$id");
    if($sql==1){
        echo "<div class='alert alert-success'> Cliente eliminado correctamente</div>";
    }else{
        echo "<div class='alert alert-danger'> Error al eliminar cliente</div>";
    }
}

?>