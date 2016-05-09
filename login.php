
<?php
unset($_SESSION["rutUsuarioLogeado"]);
unset($_SESSION["perfil"]);
$mensaje="";
if (isset($_SESSION["mensaje"])){
$mensaje=$_SESSION["mensaje"];
}
	
  if (isset($_POST["rut"])) {
	$ok = false;
	$sql = "SELECT clave,nombre,perfil FROM persona WHERE rut='".$_POST["rut"]."'";
	$resultado = $dbh->query($sql);	
	if ($resultado->rowCount() <> 0) {
	    $registro = $resultado->fetch();	
	    $claveHash = $registro["clave"];
		$ok = ($_POST["clave"]==$claveHash) ? true : false ;	
		if($ok){
		     $_SESSION["rutUsuarioLogeado"] = $_POST["rut"];
		     $_SESSION["nombre"] = $registro["nombre"];
	         $_SESSION["perfil"] = $registro["perfil"];	
?>		 
			<script type="text/javascript">
			window.location.href = "index.php?pagina=bienvenida";
		    </script>	
<?php			
		}else{
		     $mensaje = "Error clave incorrecta";
		}
	}else{
	    $mensaje = "Error, RUT incorrecto";
	}
}
	
?>
	


   <div class="col-lg-4"></div> <div class="col-lg-4">

   
<h1>Iniciar sesion</h1>

<h2 style="color:red"><?= $mensaje ?></h2>
<br/>
<form method="POST" action="index.php?pagina=login" class="form-signin">	

        <label for="rut" class="sr-only">Usuario</label>
        <input type="text" name="rut" id="rut" class="form-control" placeholder="Rut sin puntos ni guion" required autofocus>
       
        <label for="inputPassword" class="sr-only">Clave</label>
        <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Recordarme
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
</form>

 </div>
 <div class="col-lg-4"></div>

     