<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/estilo_materias.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <title>Asignar Materias</title>
</head>
<body>
<?php include '../php/nav_Admin.php'; ?>
<body>
<br>
<form method="post" action="asignar_materia.php">
    <label for="materia">Materia:</label>
    <input type="text" name="materia" id="materia">
    <label for="horas_clases">Horas de Clases Semanales:</label>
    <select name="horas_clases" id="horas_clases">
        <option value="5 Hrs">5 Hrs.</option>
        <option value="4 Hrs">4 Hrs.</option>
        <option value="3 Hrs">3 Hrs.</option>
        <!-- Agrega más opciones si es necesario -->
    </select>
    <label for="docente" class="docente">Docente:</label>
    <select class="nombre" name="docente" id="docente">
        <?php
        // Conexión a la base de datos
        include '../php/conexion.php';        

        // Consulta para obtener los nombres completos de los docentes
        $consulta_docentes = "SELECT CONCAT(nombreD, ' ', apellidoPd, ' ', apellidoMd) AS nombre_completo FROM docentes";
        $resultado_docentes = mysqli_query($conexion, $consulta_docentes);

        // Mostrar un valor por defecto
        echo '<option class="nombre" value"">Seleccione un Docente</option>';

        // Generar las opciones
        while ($fila_docente = mysqli_fetch_assoc($resultado_docentes)) {
            $nombre_completo = $fila_docente['nombre_completo'];            
            echo '<option class="nombre" value="' . $nombre_completo . '">' . $nombre_completo . '</option>';
        }

        // Cerrar la conexión a la BD
        mysqli_close($conexion);
        ?>
    </select><br>
    
    <label for="ano">Año:</label>
    <select class="ano" name="ano" id="ano">
        <option value="1">1°</option>
        <option value="2">2°</option>
        <option value="3">3°</option>
    </select><br><br>

    <input type="submit" value="Guardar"><br><br>
</form>

<!-- Agregamos el div para mostrar el mensaje -->
<div id="mensaje" style="display: none;">Datos guardados</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $materia = $_POST["materia"];
    $horas_clases = $_POST["horas_clases"];
    $docente = $_POST["docente"];
    $anio = $_POST["ano"];

    // Conexión a la base de datos
    include '../php/conexion.php';
    if (!$conexion) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Seleccionar la base de datos    

    // Verificar si la materia ya existe en la base de datos
    $consulta_existe_materia = "SELECT COUNT(*) AS existe FROM tira_materias WHERE Materias = ?";
    $stmt_existe_materia = mysqli_prepare($conexion, $consulta_existe_materia);
    mysqli_stmt_bind_param($stmt_existe_materia, "s", $materia);
    mysqli_stmt_execute($stmt_existe_materia);
    $resultado_existe_materia = mysqli_stmt_get_result($stmt_existe_materia);
    $fila_existe_materia = mysqli_fetch_assoc($resultado_existe_materia);

    if ($fila_existe_materia["existe"] > 0) {
        $mensaje = "Elemento duplicado.";
    } else {
        // Preparar la consulta SQL para la inserción
        $consulta = "INSERT INTO `tira_materias`(`Materias`, `Horas_Clases`, `docente`, `id`, `año`) VALUES ('$materia','$horas_clases','$docente',null,'$anio')";
        $stmt = mysqli_prepare($conexion, $consulta);
        

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Aquí asignamos el mensaje a una variable JavaScript
            echo '<script>
                    var mensajeDiv = document.getElementById("mensaje");
                    mensajeDiv.style.display = "block";
                    mensajeDiv.innerHTML = "Datos guardados correctamente.";
                    setTimeout(function () {
                        mensajeDiv.style.display = "none";
                    }, 2000); // 2 segundos
                  </script>';
        } else {
            $mensaje = "Error al guardar los datos: " . mysqli_error($conexion);
        }

        // Cerrar la conexión y liberar recursos
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conexion);
}
?>

</body>
<br>
<footer>
<?php include '../php/footerG.php';?>
</footer>
</html>