<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_registro_usuarios.css">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <title>Formulario Administrativo</title>
    </head>
<body>
    <form class="registro" action="../php/recibir_datos_administrativo.php" method="post" id="registro_docente" name="Contacto">
        <div id="Campos">
            <h4 class="titulo">Registro de Administrativo</h4>
            <label class="mat">Matricula</label>
                <input class="matr" autofocusu type="text" name="id_admin" placeholder="Introduzca su Matricula"><br><br>
            <label class="nom">Nombre</label>
                <input class="nombre" autofocusu type="text" name="nombreAa" placeholder="Introduzca su Nombre"><br><br>
            <label class="nom">Apellido Paterno</label>
                <input class="apell" autofocusu type="text" name="apellidoPa" placeholder="Apellido Paterno"><br><br>
            <label class="nom">Apellido Materno</label>
                <input class="apell" autofocusu type="text" name="apellidoM" placeholder="Apellido Materno"><br><br>
            <label class="ed">Edad</label>
                <input class="edad" type="number" name="edadA" min="11" max="99" placeholder="- -" required><br><br>
            <label class="te">Telefono Particular</label>
                <input class="tel" type="number" name="telefonoA"placeholder="10 Digitos" min="10" required><br><br>
            <label class="domi"> Dirrecion</label>
            <input class="domicilio" type="text" name="direccionA" placeholder="Donde Vive" required><br><br>
            <label class="ge">Genero</label><br>
                <label class="Etiquetas">Hombre</label><input class="genero" type="radio" name="sexoA" value="Hombre">
                <label class="Etiquetas">Mujer</label><input class="genero" type="radio" name="sexoA" value="Mujer"><br><br>
            <label>Cargo</label>            
            <select class="car" name="cargoA">
                <option class="carg" value="opcion">Elija una Opcion</option>
                <option class="carg" value="Docente">Docente</option>
                <option class="carg" value="Coordinacion">Coordinacion</option>
                <option class="carg" value="Secretaria">Secretaria</option>
                <option class="carg" value="Prefecto">Prefecto</option>
                <option class="carg" value="Administrativo">Administrativo</option>
            </select><br><br>
            <label class="corr">Correo Electronico</label>
                <input class="correito" type="email" name="correoA" placeholder="Ejemplo@example.com" required class="formulario"><br><br>
            <label class="a">Area</label>
            <select class="reg" name="areaA">
                <option class="reg" value="opcion">Elija una Opcion</option>
                <option class="reg" value="Docente">Ciencias Administrativas</option>
                <option class="reg" value="Coordinacion">Control Escolar</option>
                <option class="reg" value="Secretaria">Administrador</option>            
            </select><br><br>
            <label class="fe">Fecha de Nacimiento</label>
                <input class="na" type="date" name="natalicioA" class="CajasL" required><br><br>
            <label class="tel"> Telefono Emergencia</label>
                <input class="reg" type="number" name="telefonoEa"placeholder="10 Digitos" min="10" required><br><br>
            <label class="turn">Turno</label>
                <select class="turn" name="turno" required>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select><br><br>
            <label class="con">Contraseña</label>
                <input class="pass" type="password" placeholder="Preferible Caracteres Especiales" name="Clave_adm" class="formulario" id="CajaPass"><br>     
            <label class="con">Confirmar Contraseña</label><br>
                <input class="pass" type="password" placeholder="Repita su Contraseña" name="Clave_confirmar" class="formulario" id="CajaPass"><br><br><br>

                <script>
                    document.getElementById('registro_docente').addEventListener('submit', function(event) {
                        var password = document.getElementById('password').value;
                        var confirmPassword = document.getElementById('confirmPassword').value;

                        if (password !== confirmPassword) {
                            alert('Las contraseñas no coinciden. Por favor, vuelva a ingresarlas.');
                            event.preventDefault(); // Evita que se envíe el formulario
                        }
                    });
                </script>

            <input class="btnguardar" name="Enviar" type="submit" id="btnEnviar" value="Agregar"><br><br><br>
        </div>
        
        <div id="Botones">
            <img src="../assets/img/img2.png" style="width: 100%;" />
            <input class="btnlimpiar" name="Limpiar" type="reset" id="btnResetear" value="Limpiar"><br><br><br>
            <a href="consulta_administrativo.php"><input class="btnconsulta" name="Consultar" type="button" id="btnSalir" value="Consultar y Actualizar"></a><br><br><br>
            <a href="eliminar_administrativo.php"><input class="btneliminar" name="Consultar" type="button" id="btnSalir" value="Eliminar"></a><br><br><br>        
            <a href="../index_administrativo.php"><input class="btnsalir" name="Salir" type="button" id="btnSalir" value="Salir"></a><br><br>
            <img src="../assets/img/img3.png" style="width: 100%;" />
        </div>
    </form>
</body>
    <footer>
    <?php include '../php/footerG.php';?>
    </footer>
</html>