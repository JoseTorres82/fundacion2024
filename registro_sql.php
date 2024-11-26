<?php
// Agrego conexión a BDD
require("inc/conexion.php");

// Sanitizamos los datos del formulario
$usuario = filter_var(trim($_POST['usuario']), FILTER_SANITIZE_SPECIAL_CHARS);
$clave = trim($_POST['clave']);
$nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_SPECIAL_CHARS);
$apellido = filter_var(trim($_POST['apellido']), FILTER_SANITIZE_SPECIAL_CHARS);
$correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);

// Validamos el correo electrónico
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
        alert('El correo electrónico no es válido.');
        window.location.href = 'registro.php';
    </script>";
    exit();
}

// Validamos la contraseña
if (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $clave)) {
    echo "<script>
        alert('La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula y un número.');
        window.location.href = 'registro.php';
    </script>";
    exit();
}

// Encriptamos la clave
$clave2 = password_hash($clave, PASSWORD_DEFAULT);

// Verificamos si existe el usuario
$consulta1 = "SELECT COUNT(DISTINCT usuario) as nuevo FROM users WHERE usuario = '$usuario'";
$resultado1 = mysqli_query($conexion, $consulta1);

if ($resultado1) {
    $a = mysqli_fetch_assoc($resultado1);
    $existe = $a['nuevo'];
} else {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Estructura de decisión
if ($existe == 1) {
    // Modifico el mensaje y volvemos al formulario
    header("Location: registro.php?mensaje=uno");
} else {
    // El usuario no existe, permitimos la carga
    $alta = "
    INSERT INTO users (usuario, clave, nombre, apellido, correo, fc_alta, estado, rol) 
    VALUES ('$usuario', '$clave2', '$nombre', '$apellido', '$correo', NOW(), 'Nuevo', 'analista')";
    
    $resultado_alta = mysqli_query($conexion, $alta);

    if ($resultado_alta) {
        // Redirigimos al usuario
        header("Location: index.php");
    } else {
        die("Error al insertar el usuario: " . mysqli_error($conexion));
    }
}
?>
