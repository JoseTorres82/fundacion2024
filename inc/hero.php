<?php
function hero()
{ ?>
    <!-- Contenido Hero -->
    <div class="hero">
        <img class="hero-img" src="img/hero1.jpg" alt="hero-image">
        <div class="hero-text">
            <?php
            if ($_SESSION['autorizado'] == 'no') { ?>
                <h1 class="display-6">Bienvenido a nuestro sistema integrador</h1>
                <p class="lead">Por favor ingrese su usuario y clave o regístrese para continuar</p>
            <?php
            } else { 
                $ultimoIngreso = isset($_SESSION['ultimo_ingreso']) ? $_SESSION['ultimo_ingreso'] : 'No disponible';
                ?>
                <h1 class="display-6">Bienvenido <?php echo htmlspecialchars($_SESSION['nombre'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="lead">Último ingreso: <?php echo htmlspecialchars($ultimoIngreso, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php
            }
            ?>

            <div class="container">
                <?php
                // Sección mensaje.
                $mensaje = '';
                if (isset($_GET['mensaje'])) {
                    if ($_GET['mensaje'] == 'uno') {
                        $mensaje = 'El usuario ya existe en la base';
                    }
                    if ($_GET['mensaje'] == 'dos') {
                        $mensaje = 'La dirección de correo no es válida';
                    }
                    if ($_GET['mensaje'] == 'tres') {
                        $mensaje = 'Los datos son incorrectos';
                    }
                }
                ?>
                <!-- ↓Formulario ↓ -->
                <div class="row justify-content-center">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <!-- Formulario de ingreso -->
                        <?php
                        if ($_SESSION['autorizado'] == 'no') {
                        ?>
                            <!-- Inicio Formulario -->
                            <br>
                            <form action="login.php" method="POST">
                                <div class="form-group">
                                    <label for="user">Ingrese su usuario</label>
                                    <input type="text" id="user" name="user" class="form-control">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="pass">Ingrese su clave</label>
                                    <input type="password" id="pass" name="pass" class="form-control">
                                </div>
                                <br>
                                <button class="btn btn-primary container-fluid">Ingresar</button>
                                <div class="row">
                                    <div class="col text-center"><a href="registro.php">Registrarse</a></div>
                                    <div class="col text-center"><a href="#">Olvidé mi clave</a></div>
                                </div>
                                <br><?php echo $mensaje; ?>
                            </form>
                            <!-- Fin Formulario -->
                        <?php
                        } else {
                            // Usuario conectado: mostrar el carrusel y los datos del usuario
                        ?>
                            <div id="carouselExampleAutoplaying" class="carousel slide container" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="img/slide/1.jpg" class="d-block" style="width: 100%; height: 280px; object-fit: cover;" alt="img1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/slide/2.jpg" class="d-block" style="width: 100%; height: 280px; object-fit: cover;" alt="img2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/slide/3.jpg" class="d-block" style="width: 100%; height: 280px; object-fit: cover;" alt="img3">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <h5>Nombre: <?php echo htmlspecialchars($_SESSION['nombre'], ENT_QUOTES, 'UTF-8'); ?></h5>
                            <h5>Apellido: <?php echo htmlspecialchars($_SESSION['apellido'], ENT_QUOTES, 'UTF-8'); ?></h5>
                            <h5>Perfil: <?php echo htmlspecialchars($_SESSION['rol'], ENT_QUOTES, 'UTF-8'); ?></h5>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
