<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="shortcut icon" href="assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Index del Docente</title>
    </head>
<body>
    <header>
        <nav>
            <ul class="menu">                                                
                <li><a href="consulta_horarios_D.php">Horario</a></li>                
                <li class="dropdown">
                    <button class="dropbtn">Captura Calificaciones</button>
                    <div class="dropdown-content">
                        <a href="capturas_calificaciones_D.php">Captura Calificaciones</a>
                        <a href="calificaciones_alumnado.php">Modificar Calificacion</a>                      
                    </div>
                </li>
                <li><a href="contactos_tutores_D.php">Contacto Tutores</a></li>
                <li><a href="estadisticas_alumno_D.php">Estadisticas Alumnos</a></li>
                <li><a href="apoyo_D.html">Apoyo Tecnico</a></li>
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>

    <br><br><label>En base al login direccione este index: </label>
		<form method="POST" action="index_docente.php">
			<input type="text" name="index" placeholder="Ingrese su Matricula">
			<input type="submit" value="Buscar">
		</form>

    <table class="tabla_informacion">                    
        <tr>
            <h2>Informacion General</h2>
            <?php
			//Recibir los datos del buscador
			if ($_POST) {
				$matricula = $_POST['index'];		

				//Conexion a la BD
				$conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
				mysqli_select_db($conexion, "sagadb");

				//Realizamos consulta
				$resultado = mysqli_query($conexion, "SELECT * FROM `docentes` WHERE `id_docente` = '$matricula' LIMIT 1;");

				$campo = mysqli_fetch_array($resultado);
				echo '
				<tr>
                    <th rowspan="2"><img src="img/img1.png" alt="MDN"></th>							
					<th>Nombre</th>					
                    <td>'.(implode(" ", [$campo['nombreD'], $campo['apellidoPd'], $campo['apellidoMd']])).'</td>					
					<th>Matricula</th>			
						<td>'.($campo['telefonoD']).'</td>	
                    <th>Cargo</th>					
                        <td>'.($campo['cargoD']).'</td>
				</tr>
				<tr>
					<th>Area</th>
						<td>'.($campo['areaD']).'</td>
					<th>Telefono</th>
						<td>'.($campo['telefonoD']).'</td>
                    <th>Telefono de Emergencias</th>
                        <td>'.($campo['telefonoEd']).'</td>
				</tr>  
				';                            
			}
    		?>     
        </tr>

    </table>
</body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  