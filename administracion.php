<?php
session_start();
?>
<html>
<head>
<?php 
include("head.txt"); 
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'inventario';    
 ?>
</head>
<body>

   <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                  <a href="index.php">
                      Inicio
                    </a>
                </li>
                <li>
                    <a href="index.php?pagina=productos">Inventario</a>                
                </li>
                <li>
               <a href="index.php?pagina=login">Salir</a>
                </li>
                <li>
                    <a href="index.php?pagina=cambiarclave">Cambiar Clave</a>
                </li>
                 <li>
                    <a href="index.php?pagina=contacto">Contacto</a>
                </li>
               
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">




              
                      <?php
try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
  $sql = "SET NAMES 'utf8'";
  $dbh->query($sql);
  if (!isset($_SESSION["rutUsuarioLogeado"])){
  // si no aun no sea ha logeado ningun usuario, entonces se muestra siempre el codigo del Login 
      unset($_SESSION["mensaje"]);
    $pagina = "login";
  }else if (isset($_GET["pagina"]))
  // si existe un usuario en sesion entonces se van habilitando las paginas que esté haya clicleado en la variable  pagina pasada mediante el metodo Get
    $pagina = $_GET["pagina"];
  else 
  // si  alguien se ha logeado, pero la variable pagina Mediante GET  NO existe aun, entonces muestra la pagina bienvenida
    $pagina = "bienvenida";
    
  include($pagina.".php");
} catch(PDOException $e) {
  include("error.php");
}
?>


                   
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>

</body>
</html>