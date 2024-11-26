<?php
session_start();
if (!isset($_SESSION['autorizado']) or $_SESSION['autorizado'] == 'no' or $_SESSION['rol'] != 'admin') {
    echo "<script> '<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>'
 window.location.href = 'index.php';</script>;" 
    exit();
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Área Admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="inc/GlobalStyles.css" rel="stylesheet">
    <link rel="icon" href="img/movistar.png">

    <?php
    require("inc/menu.php");
    require("inc/conexion.php");
    ?>

    <?php
    // Consulta para obtener los datos de la tabla users
    $consulta_usuarios = "SELECT Nombre, Apellido, fc_alta, Estado, rol FROM users";
    $resultado_usuarios = mysqli_query($conexion, $consulta_usuarios);

    if (!$resultado_usuarios) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    // Contadores por rol y usuarios totales
    $consulta1 = "SELECT COUNT(*) as q_usuarios FROM users";
    $resultado1 = mysqli_query($conexion, $consulta1);
    $cantidad_usuarios = mysqli_fetch_assoc($resultado1)['q_usuarios'];

    $a = 'administrador';
    $consulta2 = "SELECT COUNT(*) as q_usuarios FROM users WHERE rol = '$a'";
    $resultado2 = mysqli_query($conexion, $consulta2);
    $cantidad_administrador = mysqli_fetch_assoc($resultado2)['q_usuarios'];

    $a = 'analista';
    $consulta3 = "SELECT COUNT(*) as q_usuarios FROM users WHERE rol = '$a'";
    $resultado3 = mysqli_query($conexion, $consulta3);
    $cantidad_analista = mysqli_fetch_assoc($resultado3)['q_usuarios'];
    ?>

    <style>
        body {
            background-image: url('img/hero1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
    </style>
</head>

<body class="container">

    <!-- Barra de navegación -->
    <?php menu(); ?>

    <!-- Título de la página -->
    <div class="alert_home alert alert-primary text-center fst-italic" role="alert">
        <h5>Sección Administrador.</h5>
    </div>

    <!-- Fila 1 -->
    <div class="container">
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn btn-primary container-fluid text-start">
                    Usuarios: <span class="badge text-bg-primary"><?php echo $cantidad_usuarios; ?></span>
                </button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary container-fluid text-start">
                    Administradores: <span class="badge text-bg-primary"><?php echo $cantidad_administrador; ?></span>
                </button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary container-fluid text-start">
                    Analistas: <span class="badge text-bg-primary"><?php echo $cantidad_analista; ?></span>
                </button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-danger container-fluid">
                    <a href="alta_usuario.php" style="color:white;text-decoration:none">Nuevo usuario</a>
                </button>
            </div>
        </div>
    </div>

    <br>

    <!-- Fila 2 -->
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">

                <!-- Tabla -->
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de Alta</th>
                                <th>Estado</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-success">
                            <?php while ($fila = mysqli_fetch_assoc($resultado_usuarios)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fila['Nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['Apellido']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['fc_alta']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['Estado']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['rol']); ?></td>
                                    <td class="text-center">
                                        <a href="modifica_usuario.php?Nombre=<?php echo urlencode($fila['Nombre']); ?>&Apellido=<?php echo urlencode($fila['Apellido']); ?>&fc_alta=<?php echo urlencode($fila['fc_alta']); ?>&Estado=<?php echo urlencode($fila['Estado']); ?>&rol=<?php echo urlencode($fila['rol']); ?>"
                                           class="btn btn-warning btn-sm">Editar</a>
                                        <a href="baja_usuario.php?Nombre=<?php echo urlencode($fila['Nombre']); ?>"
                                           onclick="return confirm('¿Deseas eliminar este usuario?');"
                                           class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
