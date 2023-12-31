<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/calificaciones_alumno.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <title>Calificaciones</title>
</head>
<body>
<?php include '../php/nav_A.php'; ?>

<table class="tabla_informacion">                    
    <tr>
        <br><h2>Reporte de Calificaciones</h2><br>
        <?php       
        // Verifica si la variable de sesión 'alumno' está configurada
        if (isset($_SESSION['alumno'])) {
            // Obtiene la matrícula del alumno desde la variable de sesión
            $matricula = $_SESSION['alumno'];

            // Conexion a la BD
            include '../php/conexion.php';            

            // Realizamos consulta para obtener todas las materias del alumno
            $resultado = mysqli_query($conexion, "SELECT * FROM `materias` WHERE `id_alumno` = '$matricula';");

            $alumno = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$matricula' LIMIT  1;");                      

            if ($resultado && $alumno) {
                // Inicializamos variables
                $faltas_totales = 0;
                $promedio_total = 0;

                echo '
                <tr>
                    <th rowspan="2">Materias</th>
                    <th rowspan="2">Docente</th>
                    <th colspan="2">1er Trimestre</th>
                    <th colspan="2">2do Trimestre</th>
                    <th colspan="2">3er Trimestre</th>
                    <th colspan="2">Final</th>
                    <th rowspan="2">Situación</th>
                </tr>
                <tr>
                    <th>Faltas</th>
                    <th>Calif.</th>
                    <th>Faltas</th>
                    <th>Calif.</th>
                    <th>Faltas</th>
                    <th>Calif.</th>
                    <th>Faltas</th>
                    <th>Calif.</th>
                </tr>';                
                
                while ($campos = mysqli_fetch_array($resultado)) {
                    $total_mat = 0;
                    $total_cal = 0;

                    // Obtener el nombre del docente de la tabla tira_materias
                    $materia = $campos['Nom_Materia'];
                    $consulta_docente = mysqli_query($conexion, "SELECT `docente` FROM `tira_materias` WHERE `Materias` = '$materia' LIMIT 1;");
                    $nombre_docente = "";
                    if ($consulta_docente && mysqli_num_rows($consulta_docente) > 0) {
                        $fila_docente = mysqli_fetch_assoc($consulta_docente);
                        $nombre_docente = $fila_docente['docente'];
                    }

                    // Calcular faltas totales y promedio total
                    $faltas_totales = $campos['Faltas_1'] + $campos['Faltas_2'] + $campos['Faltas_3'];
                    $promedio_total = ($campos['Calificacion_1'] + $campos['Calificacion_2'] + $campos['Calificacion_3'])/3;

                    // Determinar la situación                    
                    $situacion = ($promedio_total < 60.00) ? 'Reprobado' : 'Aprobado';

                    echo '
                    <tr>                                
                        <td>' . ($campos['Nom_Materia']) . '</td>
                        <td>' . $nombre_docente . '</td>
                        <td>' . ($campos['Faltas_1']) . '</td>
                        <td>' . (number_format($campos['Calificacion_1'], 2)) . '</td>
                        <td>' . ($campos['Faltas_2']) . '</td>
                        <td>' . (number_format($campos['Calificacion_2'], 2)) . '</td>
                        <td>' . ($campos['Faltas_3']) . '</td>
                        <td>' . (number_format($campos['Calificacion_3'], 2)) . '</td>
                        <td>' . $faltas_totales . '</td>
                        <td>'. number_format($promedio_total, 1, '.') .'</td>
                        <td>' . $situacion . '</td>
                    </tr>';                

                    $total_mat++;
                    $total_cal += $campos['Promedio_Mat'];
                }
                $id = $matricula;
                echo '<br><a target="_blank" href="../php/imprimir_calificacion_alumno.php?id_alumno='.$id.'"><button class="btnguardar">Imprimir PDF</button></a><br><br>';
                
            } else {
                echo "Error en la consulta SQL.";
            }
        } else {
            echo "La variable de sesión 'alumno' no está configurada. Por favor inicie sesión para ver sus calificaciones.";
        }
        ?>
    </tr>
</table>
<style>
        .btnguardar {
            width: 16%;
            padding: 10px;
            color: white;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #944d1e;
        }
        .btnguardar:hover {
            background-color: #5a2502;
        }
    </style>
</body>
<br><footer>
<?php include '../php/footerG.php';?>
</footer>
</html>