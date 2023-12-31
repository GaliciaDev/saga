<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/icon.png">        
    <link rel="stylesheet" href="css/index_home.css">
    <link rel="stylesheet" href="css/diseño_responsivo.css">
    <title>EST 153</title>  
</head>
<body>
<header class="header">
        <div class="menu">
            <label for="menu" class="menu-icono">&#9776;</label>
            <div class="logo"></div>
            <input type="checkbox" id="menu-desplegable">
            <nav class="navbar menu">
                <ul>
                    <li><a href="https://www.facebook.com/tecnicabasiliovadillo.turnovespertino.9/?locale=es_LA%22%20class%3D%22nav__links%22">Nosotros</a></li>
                    <li><a href="../saga/views/formulario_alumnos.php">Alumnos</a></li>
                    <li><a href="../saga/views/formulario_docente.php">Docentes</a></li>
                    <!--<li><a href="../saga/views/formulario_tutores.php">Tutores</a></li>-->
                    <li><a href="../saga/views/formulario_administradores.php">Administrativo</a></li>
                </ul>
            </nav>
        </div>

        <!-- Informacion -->
        <div class="header-content container">
            <div class="header-txt">
                <h1>Escuela secundaria técnica 153</h1>
                <p></p>
                <a href="https://www.facebook.com/p/Escuela-Secundaria-Tecnica-153-100063556944973/" class="btn-1">Informacion</a><br><br>
            </div>
        </div>
    </header>


    <!--Informacion de contacto cliente-->
    <section class="direction container">
        <p>Dirección: Benjamín García 119-II, Basilio Badillo, 45406 Tonalá, Jal.</p>
        <p></p>
        <p>555-555-5555</p>
    </section>

    <!-- Informacion y contenedor de la imagen -->
    <section class="about container">

        <div class="about-img">
            <img src="/assets/img/menu1.jpg" alt="">
        </div>

        <div class="about-txt">
            <h2>Mision y Vision</h2>
            <p>
            <p id="subtexto">MISIÓN</p>
                <p>Somos un plantel al servicio de nuestros alumnos, que proporciona educación secundaria técnica de calidad.</p> 
            <br><br>
            <p>VISIÓN</p>
                <p>La Escuela Secundaria Técnica 1 de Jalisco es un plantel de excelencia en la Educación Básica, en donde buscamos cultivar los valores que sustentan un alto espíritu humanista que impulsa la calidad personal, lo que hace que nuestra institución avance hacia una educación integral.

                Ofrecemos educación técnica de calidad en el área de Informática, lo que nos permite ser reconocidos por el desempeño de nuestros alumnos y docentes

                Nuestros alumnos han aprendido a pensar críticamente y nuestros docentes aplican los principios constructivistas y de la Escuela Inteligente en la enseñanza usando los mejores recursos pedagógicos y tecnológicos.

                Cumplimos con un propósito de conformar un equipo en superación permanente, con prestigio por sus innovaciones y comprometidos voluntariamente con el proceso dinámico de la calidad educativa.

                Su comunidad se significa por el gran compromiso con la participación social y contamos con la corresponsabilidad de nuestros padres de familia para una mejor educación.</p>
            </p>
            <a href="https://www.facebook.com/p/Escuela-Secundaria-Tecnica-153-100063556944973/" class="btn-1">Informacion</a>
        </div>
    </section>

    <!-- Contenido principal, oferta de servicios -->
    <main class="information container">
        
        <div class="information-1">
            <h3>Secundatias Técnicas</h3>
            <p>La Subdirección de Educación Secundaria Técnica de la Secretaría de Educación de Veracruz, y cada una de las Escuelas Secundarias Técnicas oficiales e incorporadas tienen como meta fundamental proporcionar un servicio educativo de calidad, responsable e incluyente, que al mismo tiempo satisfaga las necesidades de los trabajadores al servicio de esta modalidad.</p>            
        </div>        
    </main>

    <!-- Productos -->
    <section class="house">
        <!-- Agregando 2 clases -->
        <div class="house-1 txt">
            <span>01</span>
            <h3>Calidad</h3>
            <p>Servicio</p>
        </div>

        <div class="house-2 txt">
            <span>02</span>
            <h3>Oportunidad</h3>
            <p>Innovación</p>
        </div>

        <div class="house-3 txt">
            <span>03</span>
            <h3>Integridad</h3>
            <p>Profesionalismo</p>
        </div>

        <div class="house-4 txt">
            <span>04</span>
            <h3>Responsabilidad</h3>
            <p>Pertinencia</p>
        </div>

        <div class="house-5 txt">
            <span>05</span>
            <h3>Compromiso social</h3>
            <p>Actitudes de éxito</p>
        </div>
    </section>

    <center><?php include 'php/footerG.php';?></center>


</body>
</html>