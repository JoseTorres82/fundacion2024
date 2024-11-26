<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifica usuario</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/icono_prueba1.png">
    <?php
        // Archivos a incluir.
        require("inc/conexion.php");

        // Tomo los valores de la URL
        $usuario = $_GET['usuario'];
        $clave = $_GET['clave'];
        $rol = $_GET['rol'];
    ?>
  </head>
  <body class="container"> 

    <!-- Título de la página -->
    <div class="alert alert-primary text-center fst-italic" role="alert">
        <h5>Modificar usuario.</h5>
    </div> 

    <!-- Formulario -->
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">

                <form action="modifica_usuario_sql.php" method="post">
                    <!-- Input Usuario -->
                    <div class="form-group">
                        <label for="usuario" style="color:green" class="fw-bold">Usuario</label>
                        <input readonly value= <?php echo $usuario; ?>  type="text" id="usuario" name="usuario" class="form-control">
                    </div>
                    <br>
                    <!-- Input Clave -->
                    <div class="form-group">
                        <label for="clave" style="color:green" class="fw-bold">Clave</label>
                        <input value= <?php echo $clave; ?> type="text" id="clave" name="clave" class="form-control">
                    </div> 
                    <br>   
                    <!-- Input Rol -->
                    <div class="form-group">
                        <label for="rol" style="color:green" class="fw-bold">Perfil</label>
                        <input value= <?php echo $rol; ?> type="text" id="rol" name="rol" class="form-control">
                    </div> 
                    <br>   
                    <!-- Botón -->
                    <div class="row">
                        <div class="col-6">
                            <button name="boton" value=1 type="submit" class="btn btn-primary container-fluid">Modificar registro</button>
                        </div>
                        <div class="col-6">
                            <button name="boton" value=0 type="submit" class="btn btn-danger container-fluid">Cancelar</button>  
                        </div>
                    </div>

                    <br>                               
                </form>

            </div>
            <div class="col-3"></div>
        </div>
    </div>     

    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>


