
<?php
$mensaje = "";
if (isset($_POST["ClaveNueva"])) {
	$ok = $_POST["ClaveNueva"] == $_POST["ClaveRepetir"];
	if ($ok) {
		$sql = "SELECT clave FROM persona WHERE rut='".$_SESSION["rutUsuarioLogeado"]."'";
		$resultado = $dbh->query($sql);
		$ok = $resultado->rowCount() != 0;
	}
	if ($ok) {
		$claveHash = $resultado->fetchColumn(0);
		
	   $ok = ($_POST["ClaveActual"]==$claveHash) ? true : false ;	
	}
	if ($ok) {
		$sql = "UPDATE persona SET clave='".$_POST["ClaveNueva"]."' WHERE rut=".$_SESSION["rutUsuarioLogeado"];
		$dbh->query($sql);
		$_SESSION["mensaje"] = "Cambio de clave correcto";
	} else
		$_SESSION["mensaje"] = "Error al cambiar la clave";
?>
	<script type="text/javascript">
		window.location.href = "index.php?pagina=login";
	</script>
<?php
}
?>
<h2 style="color:red"><?= $mensaje ?></h2>
<br/>


  <div class="col-lg-4"></div> <div class="col-lg-4">
  <h1>Cambio de Clave</h1>
<form  method="POST" action="index.php?pagina=cambiarclave" class="form-signin">	

      
        <label for="inputPassword" class="sr-only">Clave Actual</label>
        <input type="password" name="ClaveActual" id="ClaveActual" class="form-control" placeholder="Clave Actual" required>
       <br/><br/>
       <label for="inputPassword" class="sr-only">Clave Nueva</label>
        <input type="password" name="ClaveNueva" id="ClaveNueva" class="form-control" placeholder="Clave Nueva" required>
       <br/><br/>
       <label for="inputPassword" class="sr-only">Clave Repetir</label>
        <input type="password" name="ClaveRepetir" id="ClaveRepetir" class="form-control" placeholder="Clave Repetir" required>
       <br/><br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Cambiar Clave</button>
</form>
</div>
 <div class="col-lg-4"></div> 