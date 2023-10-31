<?php
    include '../php/variabledS.php';
    validarSad();

    include '../php/conexion_be.php';
    $consultaUsuarios = "SELECT * FROM `administrativo`";
    $resultadoUsuarios = mysqli_query($conexion, $consultaUsuarios);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/perfiles.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Perfiles</title>
    </head> 
<body>
    <header>
        <nav>            
            <ul class="menu">                                                                
                <li><a href="../index_administrativo.php">Inicio</a></li>
                <li class="dropdown">                    
                    <button class="dropbtn">Horarios</button>
                    <div class="dropdown-content">
                        <a href="views/asignar_horarios_alumnos.php">Asignar Horarios</a>
                        <a href="views/consultar_horarios.php">Consulta Horarios</a>                      
                    </div>
                </li>                   
                <li class="dropdown">
                    <button class="dropbtn">Captura Calificaciones</button>
                    <div class="dropdown-content">
                      <a href="views/modificar_calificacion.php">Modificar Calificacion</a>
                      <a href="views/capturar_calif_definitiva.php">Captura Trimestral</a>                      
                    </div>
                </li>       
                <li class="dropdown">
                    <button class="dropbtn">Materias</button>
                    <div class="dropdown-content">
                      <a href="views/asignar_materia.php">Asignar Materias</a>
                      <a href="views/modificar_materias.php">Modificar Materias</a>                      
                    </div>
                </li>       
                <li class="dropdown">
                    <button class="dropbtn">Subir Grado</button>
                    <div class="dropdown-content">                    
                      <a href="views/subir_grado.php">Aumentar Grado</a>
                      <a href="views/lista_reprobados.php">Lista Reprobados</a>
                    </div>
                </li>                                               
                <li class="dropdown">
                    <button class="dropbtn">Estadisticas Alumnos</button>
                    <div class="dropdown-content">
                      <a href="views/estadisticas_alumno.php">Alumno</a>
                      <a href="views/estadistica_grupal.php">Grupal</a>                      
                    </div>
                </li>        
                <li class="dropdown">
                    <button class="dropbtn">Perfiles</button>
                    <div class="dropdown-content">
                      <a href="views/registro_alumnos.html">Registro Alumnos</a>
                      <a href="views/registro_docentes.html">Registro Docentes</a>
                      <a href="views/registro_administrativo.html">Registro Administrativo</a>                      
                    </div>
                </li>   
                <li class="dropdown">
                    <button class="dropbtn">Incidencias</button>
                    <div class="dropdown-content">
                      <a href="views/incidencias.php">Registro Incidencias</a>
                      <a href="views/lista_incidencias.php">Lista de Incidencias</a>                      
                    </div>
                </li>                                
                <li><a href="views/contactos_tutores.php">Contacto Tutores</a></li>                    
                <li><a href="php/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>            
        </nav>        
    </header>    
        <h2>Usuarios Administrativos</h2>
        <div id="Botones">
            <a href="lista_perfiles_D.php"><button>Perfiles Docentes</button></a>
            <a href="lista_perfiles_A.php"><button>Perfiles Alumnos</button></a>
        </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Cargo</th>                    
                    <th>Acciones</th>
                </tr>
                <?php
                while ($fila = mysqli_fetch_assoc($resultadoUsuarios)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_admin'] . "</td>";
                    $nombreCompleto = implode(' ', [$fila['nombreAa'], $fila['apellidoPa'], $fila['apellidoM']]);
                    echo "<td>" . $nombreCompleto . "</td>";
                    echo "<td>" . $fila['correoA'] . "</td>";
                    echo "<td>" . $fila['telefonoA'] . "</td>";
                    echo "<td>" . $fila['direccionA'] . "</td>";
                    echo "<td>" . $fila['cargoA'] . "</td>";
                    echo "<td><a href='consulta_administrativo.php?id=" . $fila['id_admin'] . "'>Ver Mas...</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
</body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  