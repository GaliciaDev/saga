<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="..css/actualizacion_horario.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">  
    <title>Actualizacion de Horarios</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;                                    
        }

        .container {
            background-color: #fff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            text-aling: center;
        }

        select,
        .input {
            width: 18%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: transparent;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%232f363d' class='bi bi-chevron-down' viewBox='0 0 16 16'%3E%3Cpath d='M7.297 10.293a1 1 0 011.414 0l3 3a1 1 0 11-1.414 1.414L8 11.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 010-1.414z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover{
            background: black;
        }

        button a {
            text-decoration: none;
            color: black;
        }

        button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        button:hover {
            text-decoration: underline;
        }

        .success {
            color: green;
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .select {
            width: 25%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;            
        }

        .materia {
            width: 33%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .docente {
            width: 35%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
</html>
<?php
// Obtener el ID de la URL
$id = $_GET["id"];

// Conectar a la base de datos (configura las credenciales adecuadamente)
include 'conexion.php';

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para seleccionar la fila específica por ID
$sql = "SELECT * FROM `horarios` WHERE `id_horario` = '$id'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los valores en el formulario para que el usuario pueda actualizarlos
    $row = $result->fetch_assoc();
    $dia = $row["Dias"];
    $hora = $row["Hora"];
    $gradoGrupo = $row["grado_grupo"];
    $materias = $row["Materias"];
    $docente = $row["Docentes"];
    $aula = $row["Aula"];
    $turno = $row["turno"];
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<div class="container">
<div class="form-container">
<!-- Luego, mostrar los valores en el formulario -->
<br><br><br><form id="actualizarForm" action="actualizar_fila.php?id=<?php echo $id; ?>" method="POST">
    <label>Grado y Grupo:</label>
    <input class="input" type="text" name="nuevoGradoGrupo" value="<?php echo $gradoGrupo; ?>"><br><br>

    <label>Día:</label>
    <select class="select" name="nuevoDia">
        <option value="<?php echo $dia; ?>"><?php echo $dia;?></option>
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miercoles">Miercoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Viernes">Viernes</option> 
    </select><br><br>

    <label>Materia:</label>
    <input class="materia" type="text" name="nuevoMateria" value="<?php echo $materias; ?>"><br><br>

    <label>Docente:</label>
    <input class="docente" type="text" name="nuevoDocente" value="<?php echo $docente; ?>"><br><br>

    <label>Hora Clase:</label>
    <select class="select" name="nuevoHora">
        <option value="<?php echo $hora; ?>"><?php echo $hora;?></option>
        <option value="<?php echo $hora; ?>"><?php echo $hora;?></option>
        <option value="7:00 - 7:45">7:00am - 7:45am</option>
        <option value="7:45 - 8:30">7:45am - 8:30am</option>
        <option value="8:30 - 9:15">8:30am - 9:15am</option>            
        <option value="9:15 - 10:00">9:15am - 10:00am</option>
        <option value="10:30 - 11:15">10:30am - 11:15am</option>
        <option value="11:15 - 12:00">11:15am - 12:00pm</option>
        <option value="12:00 - 12:45">12:00am - 12:45am</option>
        <option value="12:45 - 1:30">12:45pm - 1:30pm</option>

        <option value="2:00 - 2:45">2:00pm - 2:45pm</option>
        <option value="2:45 - 3:30">2:45pm - 3:30pm</option>
        <option value="3:30 - 4:15">3:30pm - 4:15pm</option>
        <option value="4:15 - 5:00">4:15pm - 5:00pm</option>
        <option value="5:30 - 6:15">5:30pm - 6:15pm</option>
        <option value="6:15 - 7:00">6:15pm - 7:00pm</option>
        <option value="7:00 - 7:45">7:00pm - 7:45pm</option>
        <option value="7:45 - 8:30">7:45pm - 8:30pm</option>
    </select><br><br>

    <label>Aula:</label>
    <input class="input" type="text" name="nuevoAula" value="<?php echo $aula; ?>"><br><br>

    <label>Turno:</label>
        <select name="nuevoTurno" class="select">
            <option value="<?php echo $turno; ?>"><?php echo $turno;?></option>
            <option value="Matutino">Matutino</option>
            <option value="Vespertino">Vespertino</option>
        </select><br><br>

    <input type="submit" name="Actualizar" value="Actualizar">
    <button><a href="../views/consultar_horarios.php">Cancelar</a></button>
</form>
</div>
<div class="image-container">            
</div>
</div>

<?php
    // Verificar si el formulario se ha enviado
    if (isset($_POST["Actualizar"])) {
        // Obtener los valores actualizados del formulario
        $nuevoDia = $_POST["nuevoDia"];
        $nuevoHora = $_POST["nuevoHora"];
        $nuevoGradoGrupo = $_POST["nuevoGradoGrupo"];
        $nuevoMateria = $_POST["nuevoMateria"];
        $nuevoDocente = $_POST["nuevoDocente"];
        $nuevoAula = $_POST["nuevoAula"];
        $nuevoTurno = $_POST["nuevoTurno"];

        // Conectar a la base de datos (configura las credenciales adecuadamente)
        include 'conexion.php';

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta SQL para actualizar la fila en la base de datos
        $sql = "UPDATE `horarios` SET `Dias`='$nuevoDia', `Hora`='$nuevoHora', `grado_grupo`='$nuevoGradoGrupo', `Materias`='$nuevoMateria', `Docentes`='$nuevoDocente', `Aula`='$nuevoAula', `turno`='$nuevoTurno' WHERE `id_horario`='$id'";

        if ($conexion->query($sql) === TRUE) {
            echo "<label>Los datos se han actualizado correctamente.</label>";
            echo '<meta http-equiv="refresh" content="1 URL=../views/consultar_horarios.php">';
        } else {
            echo "<label>Error al actualizar los datos: </label>" . $conexion->error;
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    }
?>