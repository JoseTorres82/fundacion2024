<?php
  session_start();
  if(!isset($_SESSION['autorizado'])){
    $_SESSION['autorizado']='no';
  }

?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/icono_prueba1.png">
    <link href="inc/GlobalStyles.css" rel="stylesheet" >
    <?php
        // Archivos a incluir.
        require("inc/menu.php");
        require("inc/hero.php");

        // Sección mensaje.
        $mensaje = '';
        if(isset($_GET['mensaje'])){
            if($_GET['mensaje']=='uno'){$mensaje = 'El usuario ya existe en la base';}
            if($_GET['mensaje']=='dos'){$mensaje = 'La dirección de correo no es válida';}
            if($_GET['mensaje']=='tres'){$mensaje = 'Los datos son incorrectos';}
        }        
    ?>
  </head>
  <body class="container">
  <?php menu(); ?>
  <!-- Título de la página -->
  <div class="alert_home alert alert-primary text-center fst-italic" role="alert">
      <h5>Inicio.</h5>
    </div> 
    <?php hero(); ?>
 
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
