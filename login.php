<?php
// Aviso que trabajo con sesiones
session_start();

// Conexion a la BDD
require("inc/conexion.php");

// Buscamos los valores del ingreso.
$usuario = filter_var($_POST['user'], FILTER_SANITIZE_SPECIAL_CHARS);
$clave = filter_var($_POST['pass'], FILTER_SANITIZE_SPECIAL_CHARS);

// Verificamos si el usuario existe en la BDD
$consulta1 = "SELECT COUNT(usuario) AS nuevo FROM users WHERE usuario = '$usuario'";
$resultado1 = mysqli_query($conexion, $consulta1);

$existe = 0;
while ($a = mysqli_fetch_assoc($resultado1)) {
    $existe = $a['nuevo'];
}

// Estructura de decisión
if ($existe == 0) {
    // No existe el usuario en la base
    header("Location: index.php?mensaje=tres");
    exit;
} else {
    // Existe el usuario, leemos la clave y el último ingreso
    $consulta_clave_bdd = "SELECT clave, ultimo_ingreso FROM users WHERE usuario = '$usuario'";
    $resultado_clave_bdd = mysqli_query($conexion, $consulta_clave_bdd);

    $clave_bdd = null;
    $ultimo_ingreso = null;
    while ($a = mysqli_fetch_assoc($resultado_clave_bdd)) {
        $clave_bdd = $a['clave'];
        $ultimo_ingreso = $a['ultimo_ingreso']; // Guardamos el último ingreso
    }
}

// Verificamos la clave
if (password_verify($clave, $clave_bdd)) {
    // Clave correcta
    $consulta_datos = "SELECT usuario, nombre, apellido, rol FROM users WHERE usuario = '$usuario'";
    $resultado_consulta_datos = mysqli_query($conexion, $consulta_datos);

    while ($b = mysqli_fetch_assoc($resultado_consulta_datos)) {
        $_SESSION['usuario'] = $b['usuario'];
        $_SESSION['nombre'] = $b['nombre'];
        $_SESSION['apellido'] = $b['apellido'];
        $_SESSION['rol'] = $b['rol'];
        $_SESSION['ultimo_ingreso'] = $ultimo_ingreso; // Guardamos el último ingreso en la sesión
        $_SESSION['autorizado'] = 'si';
    }

    // Actualizamos el último ingreso en la base de datos con la hora actual
    $actualizar_ingreso = "UPDATE users SET ultimo_ingreso = NOW() WHERE usuario = '$usuario'";
    mysqli_query($conexion, $actualizar_ingreso);

    // Redirigimos al usuario a la página principal
    header("Location: index.php");
    exit;
} else {
    // Clave incorrecta
    header("Location: index.php?mensaje=tres");
    exit;
}
?>
