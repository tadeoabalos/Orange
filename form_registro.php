<?php 
    sleep(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./estilo_login.css"> 
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h1 style="color: orange;">Regístrate</h1>
            <form action="registro.php" method="post">
                <label for="firstName">Nombre</label>
                <input type="text" id="firstName" name="nombre" required>

                <label for="lastName">Apellido</label>
                <input type="text" id="lastName" name="apellido" required>

                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="mail" required>

                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="user" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="pass" required>

                <button type="submit">Registrarse</button>
            </form>
            <div class="footer">
                <p>¿Ya tienes una cuenta? <a href="./form_login.php">Inicia sesión</a></p>
                <p><a href="index.php">Salir</a></p>
            </div>
        </div>
    </div>    
</body>
</html>