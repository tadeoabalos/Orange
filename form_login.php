<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        sleep(1);

        $usuario = $_POST['user'];
        $pw = md5($_POST['pass']);

        include("conexion.php");

        $consulta = mysqli_query($conexion, "SELECT id, nombre, apellido, mail, user, tipo FROM usuarios WHERE user='$usuario' AND pass='$pw'");

        $resultado = mysqli_num_rows($consulta);

        if ($resultado != 0) {
            session_start();
            $_SESSION['sesion'] = session_create_id();
            $_SESSION['usuario'] = $usuario;
            $respuesta = mysqli_fetch_array($consulta);
            $tipoUsuario = $respuesta['tipo'];
            $_SESSION['id'] = $respuesta['id'];
            
            if ($tipoUsuario == 2) {
                header("Location: ./admin/index.php");                
            }
            else if ($tipoUsuario == 1) {
                header("Location: ./premium/index.php");                
            } 
            else {
                header("Location: index_logueado.php");                  
            }
        } else {
            echo "<script>alert('No es un usuario registrado'); window.location.href = 'form_login.php';</script>";
            exit; 
        }
    }
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
    <div>
        <div class="container">
            <div class="login-container">
                <h1>Iniciar sesión</h1>
                <form action="" method="post">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" id="username" name="user" required>
                    
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="pass" required>
                    
                    <button type="submit">Iniciar sesión</button>
                </form>
                <div class="footer">
                    <p>¿No tienes una cuenta? <a href="./form_registro.php">Regístrate</a></p>
                    <p><a href="index.php">Salir</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
