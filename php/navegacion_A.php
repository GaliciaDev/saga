<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CSS Menu responsivo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>    
        ul {
            list-style-type:none;
            margin:0;
            padding:0;
            position: absolute;
            justify-content: center;
            display: flex;
            width: 100%;
        }

        li {
            display:inline-block;
            float: left;
            margin-right: 1px;
        }

        /* Estilo para los links */
        li a {
            background: #944d1e;
            color: #FFF;
            min-width: 180px;
            transition: background 0.5s, color 0.5s, transform 0.5s;
            margin: 0px 6px 6px 0px;
            padding: 20px 40px;
            box-sizing: border-box;
            border-radius: 3px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
            position: relative;
            justify-content: center;
            display: flex;
        }

        li:hover a {
            background: #4e280f;
        }

        li:hover ul a {
            background: #e1e1e1;
            color: #222;
            height: 35px;
            line-height: 35px;
        }

        /* Hover para enlaces desplegados */
        li:hover ul a:hover {
            background: #2598c3;
            color: #fff;
        }

        /* Ocultar enlaces desplegables hasta que se necesiten */
        li ul {
            display: none;
        }

        /* Hacer vínculos desplegables verticales */
        li ul li {
            display: block;
            float: none;
        }

        li ul li a {
            width: auto;
            min-width: 100px;
            padding: 0 19px;
        }

         /* Visualizar el menú desplegable en hover */
         li:hover > ul,
          li ul:hover {
              display: block;
          }

        /* Estilos boton desplegar menu */
        .show-menu {
            display: none;
        }

        .menu-icon {
            cursor: pointer;
        }

        input[type=checkbox] {
            display: none;
        }

        /* Mostrar menú cuando se marca la casilla de verificación invisible */
        input[type=checkbox]:checked ~ #menu {
            display: block;
        }

        .icono {
            display: none;
        }

        /* Estilo responsivo ancho menor de 750px */
        @media screen and (max-width: 750px) {
            /* Hacer que los vínculos desplegables aparezcan en línea */
            ul {
                position: static;
                display: none;
            }
            /* Crear espacio vertical */
            li {
                margin-bottom: 1px;
            }
            /* Todos los enlaces del menú de ancho completo */
            ul li, li a {
                width: 100%;
            }

            .show-menu {
                display: block;
                cursor: pointer;
            }

            .icono {
                display: block;
                width: 50px;
                height: 50px;
                margin-left: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <label for="show-menu" class="menu-icon">            
            <img class="icono" src="assets/img/icono_menu.png" alt="Menú"><br><br>
        </label>
        <input type="checkbox" id="show-menu" role="button">
        <ul id="menu">
            <li><a href="index_alumno.php">Inicio</a></li>
            <li><a href="views/consultar_horario_alumnos.php">Horario</a></li>
            <li><a href="views/tira_materias_alumno.php">Tira Materias</a></li>
            <li><a href="views/calificaciones_alumno.php">Calificaciones</a></li>
            <li><a href="views/kardex.php">Kardex</a></li>
            <li><a href="php/cerrarsesion.php">Cerrar Sesión</a></li>
        </ul>
    </header>
    <br><br>
</body>
</html>
