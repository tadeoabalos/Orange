<?php
    include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilo.css">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_POST['submit'])){

            $destinatario = "tadeoabalos99@gmail.com";
            $nombre = $_POST["nombre"];
            $email = $_POST['email'];
            $mensaje = $_POST['mensaje'];
            $asunto = $_POST['asunto'];
            $header = "Orange";
            if(mail($destinatario, $asunto, $mensaje, $header)){
                ?>
                <div class="message-container">
                <h1>Mensaje Enviado</h1>
                <h2 style="color: orange;">Muchas gracias por comunicarte con Orange</h2>
                <p>¡Tu mensaje se ha enviado correctamente!</p>
                <a href="../index_logueado.php">Volver a la Página Principal</a>
            </div>
            <?php
            }
            else{
                echo "error al enviar el mensaje";
            }


            $query = "INSERT INTO mensajes (nombre, correo, mensaje) VALUES ('$nombre', '$email', '$mensaje')" ; 
            $consulta = (mysqli_query($conexion, $query) or die(mysqli_error($conexion)));
            mysqli_close($conexion);
        }
    ?>
</body>
</html>

