<?php
	if ($_POST){
		$Materias=$_POST['materias'];
		$Calificacion=$_POST['calificacion'];
		$Promedio_Materias=$_POST['prom_materias'];
		$Promedio_General=$_POST['prom_general'];

		include 'conexion.php';			

		$Resultado=mysqli_query($conexion,"INSERT INTO `calificaciones`(`Materias`, `Calificacion`, `Promedio_Materias`, `Promedio_General`) VALUES ('".$Materias."','".$Calificacion."','".$Promedio_Materias."','".$Promedio_General."');");
		if($Resultado==true){
			echo "Gracias Hemos Recibido Tus Datos. Espere un Momento Por Favor\n";
			echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=login.php">';
		}
		else{ echo "ERROR En La Consulta";
		mysqli_close($conexion);
		}
	}
	else{
		echo "ERROR";
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=../views/registro_alumno.html>';
	}
?>