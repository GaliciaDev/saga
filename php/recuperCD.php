<?php
function cambiarContraseña($matricula, $nuevaContraseña) {
    include 'conexion.php';

    if ($conexion->connect_error) {
        die("La conexión a la base de datos ha fallado: " . $conexion->connect_error);
        echo "<meta http-equiv='refresh' content='2; url=../views/formulario_docente.php'>";
    }

    $sql = "UPDATE docentes SET Clave = '$nuevaContraseña' WHERE id_docente = '$matricula'";

    if ($conexion->query($sql) === TRUE) {
        // Éxito en la actualización
    } else {
        echo "Error en la actualización de la contraseña: " . $conexion->error;
        echo "<meta http-equiv='refresh' content='2; url=../views/formulario_docente.php'>";
    }

    $conexion->close();
}

function verificarDatos($nombreCompleto, $correo, $matricula){
    include 'conexion.php';

    if ($conexion->connect_error) {
        die("La conexión a la base de datos ha fallado: " . $conexion->connect_error);
        echo "<meta http-equiv='refresh' content='2; url=../views/formulario_docente.php'>";
    }

    $sql = "SELECT nombreD, apellidoPd, apellidoMd, correoD FROM docentes WHERE id_docente = '$matricula'";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre = $fila['nombreD']. " " . $fila['apellidoPd']. " " . $fila['apellidoMd'];

        if ($nombre === $nombreCompleto && $fila['correoD'] === $correo) {
            return true;
        } else {
            return false;
        }
    } else {
        echo "No se encontró ningún alumno con la matrícula proporcionada.";
        echo "<meta http-equiv='refresh' content='2; url=../views/formulario_docente.php'>";
    }

    $conexion->close();
}

if (isset($_POST['recuperar'])) {
    $nombreCompleto = $_POST['nombre'];
    $correo = $_POST['correo'];
    $matricula = $_POST['matricula'];
    $nuevaContraseña = password_hash($_POST['clave'], PASSWORD_BCRYPT);
    $confirmarContraseña = $_POST['clave2'];

    if (verificarDatos($nombreCompleto, $correo, $matricula)) {
        if (password_verify($confirmarContraseña, $nuevaContraseña)) {
            // Actualiza la contraseña en la base de datos
            cambiarContraseña($matricula, $nuevaContraseña);

            // Envía un correo electrónico al alumno con la contraseña modificada y otros detalles
            //enviarCorreo($correo, $nombreCompleto, $nuevaContraseña);

            echo "La contraseña se ha modificado con éxito y se ha enviado un correo al alumno.";
            echo "<meta http-equiv='refresh' content='2; url=../views/formulario_docente.php'>";
        } else {
            echo "Las contraseñas no coinciden.";
            echo "<meta http-equiv='refresh' content='2; url=../views/formulario_docente.php'>";
        }
    } else {
        echo "Los datos proporcionados son incorrectos.";
        echo "<meta http-equiv='refresh' content='2; url=../views/formulario_docente.php'>";
    }
}
?>