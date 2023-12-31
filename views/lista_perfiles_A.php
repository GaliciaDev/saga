<?php
    include '../php/variabledS.php';
    validarSad();

    include '../php/conexion.php';
    $consultaUsuarios = "SELECT * FROM `alumnos`";
    $resultadoUsuarios = mysqli_query($conexion, $consultaUsuarios);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_perfiles_usuarios.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <title>Perfiles</title>
    </head> 
<body>
<?php include '../php/nav_Admin.php'; ?>   
        <br><h2>Usuarios Alumnos</h2>
        <div id="Botones"><br><br><br>
            <a class="boton" href="lista_perfiles_D.php">Perfiles Docentes</a>
            <a class="boton" href="lista_perfiles.php">Perfiles Administrativos</a>
        </div><br><br><br>
            <center><table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Grado</th>                    
                    <th>Grupo</th>
                    <th>Turno</th>
                    <th>Periodo</th>
                    <th>Acciones</th>
                </tr>
                <?php
                while ($fila = mysqli_fetch_assoc($resultadoUsuarios)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_alumno'] . "</td>";
                    $nombreCompleto = implode(' ', [$fila['nombre'], $fila['apellidoP'], $fila['apellidoM']]);
                    echo "<td>" . $nombreCompleto . "</td>";
                    echo "<td>" . $fila['correo'] . "</td>";
                    echo "<td>" . $fila['telefono'] . "</td>";
                    echo "<td>" . $fila['domicilio'] . "</td>";
                    echo "<td>" . $fila['grado'] . "</td>";
                    echo "<td>" . $fila['grupo'] . "</td>";
                    echo "<td>" . $fila['turno'] . "</td>";
                    echo "<td>" . $fila['periodo'] . "</td>";
                    echo "<td><a href='consultar_alumnos.php?id=" . $fila['id_alumno'] . "'>Ver Mas...</a></td>";
                    echo "</tr>";
                }
                ?>
            </table></center><br><br>
</body>
    <footer>
    <?php include '../php/footerG.php';?>
    </footer>
</html>  