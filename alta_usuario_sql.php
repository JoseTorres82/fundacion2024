<?php
    session_start();
    if(!isset($_SESSION['autorizado']) or $_SESSION['autorizado']=='no'){
        header("Location:index.php");
    }

    // Agrego conexión a BDD
    require("inc/conexion.php");

    // Tomo los datos del formulario
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $fc_alta = $_POST['Alta'];
    $estado = $_POST['Estado'];
    $rol = $_POST['rol'];

    // Verificamos si existe el usuario.
    $consulta1 = "SELECT COUNT(*) as nuevo FROM usuario WHERE usuario = '$users'";

    $resultado1 = mysqli_query($conexion, $consulta1);

    $existe = mysqli_fetch_assoc($resultado1)['nuevo'];

    // Estructura de decisión
    if($existe == 1){
        // Modifico el mensaje y volvemos al formulario
        header("Location: alta_usuario.php?mensaje=uno");
    } else {
        // El usuario no existe, permitimos la carga.
        $alta = "INSERT INTO usuario (usuario, clave, rol) VALUES ('$users', '$clave', '$rol')";
        $resultado_alta = mysqli_query($conexion, $alta);

        // Redirigimos al usuario
        header("Location: abm.php");
    }
?>
