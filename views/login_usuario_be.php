<?php
    /* Definir que trabajaremos con variables de sesion */
    session_start();
    include '../php/conexion_be.php';

    /* Variables de acceso */
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $contrasena = hash('sha512', $contrasena);

    /* Consulta y verificacion del usuario */
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'
    and contrasena='$contrasena'");

    if (mysqli_num_rows($validar_login) > 0) {
        /* Variables de sesion */
        $_SESSION['usuario'] = $correo;
        header("location: ../../bienvenida.php");
        exit;

    }
    else {
        echo '
            <script>
                alert("Usuario no existe, por favor verifique los datos introducidos");
                window.location = "../../index.php";
            </script>
        ';

        exit;
    }


?>

