<?php
    // Conexión al servidor de BDD
    include('inc/conexion.php');

    // Busco los datos en el POST
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $rol = $_POST['rol'];
    $boton = $_POST['boton'];

    // Estructura de decisión
    if($boton==0){
        // El usuario quiere cancelar
        header("Location:abm.php");
    }else{
        // Hacemos la baja del registro
        //echo $usuario;
        $modifica = "
            update usuario
            set usuario='$usuario',clave='$clave',rol='$rol'
            where usuario = '$usuario'
        ";
        $resultado_modifica = mysqli_query($conexion,$modifica);
        header("Location:abm.php");
    }





?>