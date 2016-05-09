
<?php 
	
   if (isset($_SESSION["rutUsuarioLogeado"])){
             if ($_SESSION["perfil"]=="administrador"){
			 
    try {
	if (isset($_POST["Accion"])) {
		if ($_POST["Accion"]=="Eliminar") {
			$sql = "DELETE FROM producto WHERE idproducto=".$_POST["idproductoEliminar"];
			$dbh->query($sql);
		} else  {
			$sql = "INSERT INTO producto VALUES (null,'".$_POST["nombre"]."','".$_POST["codigo"]."','". $_POST["precio"]."','".$_POST["descripcion"]."')";
			$dbh->query($sql);
		}
	}
} catch(PDOException $e) {
    echo $e->getMessage();
}
				 
?>		 
			<h2>Listado de productos</h2>
<table class="table table-hover table-bordered table-striped">
	     	<tr>
			<td>id producto</td>
			<td>nombre</td>
			<td>codigo</td>
			<td>precio</td>
			<td>descripcion</td>
			<td>Accion</td>
	        </tr>	 
<?php		
               try {	
	                 $sql = "SELECT * FROM producto ORDER BY nombre ASC";
	                 foreach ($dbh->query($sql) as $row) {
?>		       
			         <tr>
			             <td><?= $row['idproducto'] ?></td>
			             <td><?= $row['nombre'] ?></td>
        	             <td><?= $row['codigo'] ?></td>
        	              <td><?= $row['precio'] ?></td>
        	             <td><?= $row['descripcion'] ?></td>
						 <td><a href="#" onclick="Terminar(<?= $row['idproducto'] ?>);">Eliminar</a></td>

	                 </tr>
<?php					}
                   } catch(PDOException $e) {
                     echo $e->getMessage();
                  }	 
?>
</table>



   <div class="col-lg-6">

<form method="POST" action="index.php?pagina=productos" class="form-horizontal">
<input type="text" name="Accion" id="Accion" value="Ingresar" style="visibility:hidden;" />
<input type="text" name="idproductoEliminar" id="idproductoEliminar" style="visibility:hidden;" />

 <div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
    </div>
  </div>

 <div class="form-group">
    <label for="codigo" class="col-sm-2 control-label">Codigo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="codigo" id="codigo"  placeholder="codigo">
    </div>
  </div>

  <div class="form-group">
    <label for="precio" class="col-sm-2 control-label">precio</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="precio" id="precio"  placeholder="precio">
    </div>
  </div>

  <div class="form-group">
    <label for="descripcion" class="col-sm-2 control-label">descripcion</label>
    <div class="col-sm-20">
    <textarea name="descripcion" class="form-control" rows="3"></textarea>  </div>
  </div>

<br/>

<input type="submit" value="Grabar Datos" class="btn btn-primary"/>
</form>

</div> <div class="col-lg-6"></div>  
<?php                     
			 }else{
			 echo "no tiene los permisos suficientes para acceder";
             }
    } else{
	echo " debe estar logueado para acceder";
	}

?>

  <script type="text/javascript">
function Terminar ( idproductoEliminar )
{
 var x;
var r=confirm("Estas seguro de Eliminar!");
if (r==true)
  {
 
    document.getElementById("idproductoEliminar").value = idproductoEliminar ;
	document.getElementById("Accion").value = "Eliminar";
   	document.forms[0].submit();	
	// document.forms[0].elements[1]
	//hace referencia al segundo elemento del primer fomulario , en una forma de arreglo	
  }
else
  {
  //x="¡Has pulsado Cancelar!";
  
  }
//document.getElementById("demo").innerHTML=x;
}
  
</script>