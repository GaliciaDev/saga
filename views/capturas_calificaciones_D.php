<?php
include '../php/variabledS.php';
validarSd();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/capturas.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <title>Captura Calificacion</title>
</head>
<body>
    <header>
        <nav>
        <ul class="menu">
                <li><a href="../index_docente.php">Inicio</a></li>
                <li><a href="consulta_horarios_D.php">Horario</a></li>                                    
                <li><a href="modificar_calificacion_D.php">Modificar Calificacion</a></li>
                <li class="dropdown">
                    <button class="dropbtn">Estadisticas Alumnos</button>
                    <div class="dropdown-content">
                        <a href="estadisticas_alumno_D.php">Alumno</a>
                        <a href="estadisticas_grupal_D.php">Grupal</a>
                    </div>
                </li>
                <li><a href="contactos_tutores_D.php">Contacto Tutores</a></li>
                <li><a href="../php/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <h1>Captura Calificacion</h1>
    <br><br>

    <?php
        if (isset($_SESSION['docente'])) {
            $id_docente = $_SESSION['docente'];

            include '../php/conexion_be.php';

            // Consulta para obtener el nombre completo del docente
            $consulta_nombre = "SELECT nombreD, apellidoPd, apellidoMd FROM `docentes` WHERE `id_docente` = '$id_docente';";
            $resultado_nombre = mysqli_query($conexion, $consulta_nombre);

            if ($row = mysqli_fetch_assoc($resultado_nombre)) {
                $nombre_profesor = $row['nombreD'] . ' ' . $row['apellidoPd'] . ' ' . $row['apellidoMd'];

                // Consulta para obtener los grados y grupos asociados al docente
                $consulta_grados_grupos = "SELECT grado_grupo FROM `horarios` WHERE `Docentes` = '$nombre_profesor';";
                $resultado_grados_grupos = mysqli_query($conexion, $consulta_grados_grupos);

                echo '<form class="form_captura" action="capturas_calificaciones_D.php" method="POST">
                        <label>Grado y Grupo</label>
                        <select class="materias" name="lista_mat">';
                
                // Agrega opciones al select con los grados y grupos obtenidos
                while ($fila = mysqli_fetch_assoc($resultado_grados_grupos)) {
                    echo '<option value="' . $fila['grado_grupo'] . '">' . $fila['grado_grupo'] . '</option>';
                }
                
                echo '</select>
                    <input type="submit" class="busqueda" name="buscar" value="Buscar">
                    </form><br>';
            } else {
                echo 'No se encontró un docente con el ID proporcionado.';
            }
        } else {
            echo 'No se ha iniciado sesión. Por favor, inicie sesión para ver los horarios.';
        }
                      
        // Consulta para obtener las materias del docente        
        $consulta_materias = "SELECT `Materias` FROM `horarios` WHERE `Docentes` = '$nombre_profesor';";
        $resultado_materias = mysqli_query($conexion, $consulta_materias);
        
        if (mysqli_num_rows($resultado_materias) > 0) {
            echo '<form action="capturas_calificaciones_D.php" method="POST">
                    <label>Materia</label>
                    <select class="materias" name="materia">';
            
            // Agrega opciones al select con las materias del docente
            $primerDato = mysqli_fetch_assoc($resultado_materias);
            $nomMateria = $primerDato['Materias'];
            echo "<option value='.$nomMateria'>$nomMateria</option>";
            while ($fila = mysqli_fetch_assoc($resultado_materias)) {
                if ($nomMateria != $fila['Materias']) {
                    $nomMateria = $fila['Materias'];
                    echo "<option value='.$nomMateria'>$nomMateria</option>";
                }
            }                        
            echo '</select>';
        } else {
            echo 'El docente no tiene materias asociadas.';
        }

        echo '<h4>Seleccione un Trimestre: </h4>
                <input type="radio" id="cal1" name="opc" value="cal1" required>
                <label for="cal1">Primer Trimestre</label>

                <input type="radio" id="cal2" name="opc" value="cal2" required>
                <label for="cal2">Segundo Trimestre</label>

                <input type="radio" id="cal3" name="opc" value="cal3" required>
                <label for="cal3">Tercer Trimestre</label><br>

                <br><table class="tabla_calificaciones">
                    <tr>
                        <th>Alumno</th>
                        <th>Matricula</th>
                        <th>Faltas</th>
                        <th>Calificacion</th>
                    </tr>';    
    ?>
    <?php
        //Recibir los datos del buscador
        if (isset($_POST['buscar'])) {
            $grupo = $_POST['lista_mat'];                    

            $grado = str_split($grupo);
            

            //Conexion a la BD
            $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
            mysqli_select_db($conexion, "sagadb");

            //Realizamos consulta
            $resultado = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `grado` = '$grado[0]' AND `grupo` = '$grado[1]';");

            while ($campo = mysqli_fetch_array($resultado)) {
                echo '
                <tr>
                    <td>'.(implode(" ", [$campo['nombre'], $campo['apellidoP'], $campo['apellidoM']])).'</td>
                    <td>'.($campo['id_alumno']).'<input type="hidden" name="id[]" value="'.($campo['id_alumno']).'"></td>
                    <td><input type="number" min="0" max="99" name="faltas[]"></td>
                    <td><input type="number" min="0" max="100" name="calificacion[]"></td>
                </tr>  
                ';                            
            }
            mysqli_close($conexion);
        }                    
        else if (isset($_POST['capturar'])) {
            switch($_POST['opc']){
                case "cal1":
                    $id = $_POST['id'];
                    $faltas = $_POST['faltas'];
                    $calificacion = $_POST['calificacion'];
                    $mat = $_POST['materia'];                   

                    $conexion=mysqli_connect("localhost","DBA-Saga","srvtySDL&");
                    mysqli_select_db($conexion, "sagadb");
                    
                    for ($i = 0; $i < (count($id)); $i++) {
                        $consulta = mysqli_query($conexion, "SELECT * FROM `materias` WHERE `id_alumno` = '$id[$i]' AND `Nom_Materia` = '$mat' LIMIT 1;");                                                                                                        
                        if (mysqli_num_rows($consulta) == 0) {                                        
                            $resultado = mysqli_query($conexion, "INSERT INTO `materias`(`id_alumno`, `Nom_Materia`, `Calificacion_1`, `Calificacion_2`, `Calificacion_3`, `Faltas_1`, `Faltas_2`, `Faltas_3`, `Promedio_Mat`) VALUES ('$id[$i]','$mat','$calificacion[$i]', NULL, NULL,'$faltas[$i]', NULL, NULL, NULL);");
                        }
                        else {
                            $resultado = mysqli_query($conexion, "UPDATE `materias` SET `Calificacion_1` = '$calificacion[$i]', `Faltas_1` = '$faltas[$i]   ' WHERE `id_alumno` = '$id[$i]' AND `Nom_Materia` = '$mat';");
                        }                                    
                    }
                    
                    if($resultado==true){
                        echo '<br><br><label class="mensajito">Datos Capturados del Grupo Del Primer Trimestre</label>
                        <style>
                            .mensajito {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                font-size: 24px;
                            }
                        </<style>';
                    }
                break;
                case "cal2":
                    $id = $_POST['id'];
                    $faltas = $_POST['faltas'];
                    $calificacion = $_POST['calificacion'];           
                    $mat = $_POST['materia'];                           

                    $conexion=mysqli_connect("localhost","DBA-Saga","srvtySDL&");
                    mysqli_select_db($conexion, "sagadb");
                    
                    for ($i = 0; $i < (count($id)); $i++) {
                        $consulta = mysqli_query($conexion, "SELECT * FROM `materias` WHERE `id_alumno` = '$id[$i]' AND `Nom_Materia` = '$mat' LIMIT 1;");



                        if (mysqli_num_rows($consulta) == 0) {
                            $resultado = mysqli_query($conexion, "INSERT INTO `materias`(`id_alumno`, `Nom_Materia`, `Calificacion_1`, `Calificacion_2`, `Calificacion_3`, `Faltas_1`, `Faltas_2`, `Faltas_3`, `Promedio_Mat`) VALUES ('$id[$i]','$mat',NULL, $calificacion[$i], NULL, NULL, '$faltas[$i]', NULL, NULL);");
                        }
                        else {
                            $resultado = mysqli_query($conexion, "UPDATE `materias` SET `Calificacion_2` = '$calificacion[$i]', `Faltas_2` = '$faltas[$i]   ' WHERE `id_alumno` = '$id[$i]' AND `Nom_Materia` = '$mat';");
                        }
                    }
                    
                    if($resultado==true){
                        echo '<br><br><label class="mensajito">Datos Capturados del Grupo Del Segundo Trimestre</label>
                        <style>
                            .mensajito {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                font-size: 24px;
                            }
                        </<style>';
                    }
                break;
                case "cal3":
                    $id = $_POST['id'];
                    $faltas = $_POST['faltas'];
                    $calificacion = $_POST['calificacion'];  
                    $mat = $_POST['materia'];                  

                    $conexion=mysqli_connect("localhost","DBA-Saga","srvtySDL&");
                    mysqli_select_db($conexion, "sagadb");
                    
                    for ($i = 0; $i < (count($id)); $i++) {
                        $consulta = mysqli_query($conexion, "SELECT * FROM `materias` WHERE `id_alumno` = '$id[$i]' AND `Nom_Materia` = '$mat' LIMIT 1;");

                        if (mysqli_num_rows($consulta) == 0) {
                            $resultado = mysqli_query($conexion, "INSERT INTO `materias`(`id_alumno`, `Nom_Materia`, `Calificacion_1`, `Calificacion_2`, `Calificacion_3`, `Faltas_1`, `Faltas_2`, `Faltas_3`, `Promedio_Mat`) VALUES ('$id[$i]','$mat',NULL, NULL, $calificacion[$i], NULL, NULL, '$faltas[$i]', NULL);");
                        }
                        else {
                            $resultado = mysqli_query($conexion, "UPDATE `materias` SET `Calificacion_3` = '$calificacion[$i]', `Faltas_3` = '$faltas[$i]   ' WHERE `id_alumno` = '$id[$i]' AND `Nom_Materia` = '$mat';");
                        }
                    }
                    
                    if($resultado==true){
                        echo '<br><br><label class="mensajito">Datos Capturados del Grupo Del Tercer Trimestre</label>
                        <style>
                            .mensajito {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                font-size: 24px;
                            }
                        </<style>';
                    }
                break;                            
            }
            
            for ($i = 0; $i < (count($id)); $i++) {
                $consulta = mysqli_query($conexion, "SELECT * FROM `materias` WHERE `id_alumno` = '$id[$i]' AND `Nom_Materia` = '$mat';");

                while ($cal = mysqli_fetch_array($consulta)) {
                    $cal1 = $cal['Calificacion_1'];
                    $cal2 = $cal['Calificacion_2'];
                    $cal3 = $cal['Calificacion_3'];

                    if ($cal1 != NULL && $cal2 != NULL && $cal3 != NULL) {
                        $promedio = ($cal1 + $cal2 + $cal3)/3;
                        $resultado = mysqli_query($conexion, "UPDATE `materias` SET `Promedio_Mat` = '$promedio' WHERE `id_alumno` = '$id[$i]' AND `Nom_Materia` = '$mat';");
                    }
                }
            }
            mysqli_close($conexion);
        }
    ?>
                            
            </table>
            <br><br><input type="submit" name="capturar" value="Capturar calificacion">      
    </form><br>
</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>