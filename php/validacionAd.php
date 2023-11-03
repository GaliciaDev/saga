<?php
    /* Definir que trabajaremos con variables de sesion */
    session_start();
    include '../php/conexion.php';

    /* Variables de acceso */
    $matricula = $_POST['matricula'];
    $clave = $_POST['clave'];
    
    /* Consulta y verificacion del usuario */
    $validar_login = mysqli_query($conexion, "SELECT Clave_adm FROM administrativo WHERE id_admin ='$matricula'
    LIMIT 1;");
    $password_hash = mysqli_fetch_array($validar_login);

    if (password_verify($clave, $password_hash['Clave_adm'])) {
        /* Variables de sesion */
        $_SESSION['admin'] = $matricula;
        header("location: ../index_administrativo.php");
        exit;

    }
    else {
        echo '
            <script>
                alert("Usuario no existe, por favor verifique los datos introducidos");
                window.location = "../views/formulario_administradores.php";
            </script>
        ';

        exit;
    }


?>

