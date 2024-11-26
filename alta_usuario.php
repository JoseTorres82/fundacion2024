<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Usuario</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="inc/GlobalStyles.css" rel="stylesheet" >
    <link rel="icon" href="img/icono_prueba1.png">

    <?php
        require("inc/conexion.php");
      

        // Sección mensaje.
        $mensaje = 'Ingrese los nuevos datos';
        if(isset($_GET['mensaje'])){
            if($_GET['mensaje']=='uno'){$mensaje = 'El usuario ya existe en la base';}
        }
    ?>
<style> body { background-image: url('img/hero1.jpg'; opacity:50%;); background-size: cover;  background-repeat: no-repeat;  background-attachment: fixed; background-position: center;} </style>
  </head>
  <body class="container" background="img/hero1.jpg">
  <?php
      require("inc/menu.php");
    ?>
    <?php menu(); ?>
    <!-- Título de la página -->
    <div class="alert_home alert alert-primary text-center fst-italic" role="alert">
        <h5>Dar de alta un nuevo usuario.</h5>
    </div> 
    <br>

    <!-- Formulario -->
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">

            <form action="alta_usuario_sql.php" method="post">
                    <!-- Input Usuario -->
                    <div class="form-group">
                        <label for="usuario" style="color:#f5f5f5" class="fw-bold">Ingrese el usuario</label>
                        <input required type="text" id="usuario" name="usuario" placeholder="Escriba el nuevo usuario" class="form-control">
                    </div>
                    <br>
                    <!-- Input Clave -->
                    <div class="form-group">
                        <label for="clave" style="color:#f5f5f5" class="fw-bold">Ingrese la clave</label>
                        <input required type="text" id="clave" name="clave" placeholder="Escriba la clave" class="form-control">
                    </div> 
                    <br>   
                    <!-- Input Rol -->
                    <div class="form-group">
                        <label for="rol" style="color:#f5f5f5" class="fw-bold">Ingrese el perfil</label>
                        <input required type="text" id="rol" name="rol" placeholder="Escriba el perfil" class="form-control">
                    </div> 
                    <br>  
                       
                    <!-- Botón -->
                    <button type="submit" class="btn btn-primary container-fluid">Cargar registro</button>  
                    <br>
                    <?php echo $mensaje; ?>                                   
                </form>

            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>


