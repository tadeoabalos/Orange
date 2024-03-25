<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulario de Contacto</title>
</head>
<body>

<div class="container">
    <h1>Orange</h1>  
    <h2>Formulario de contacto</h2>    

    <form action="procesar_formulario.php" method="post">    
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

        <button type="submit" name="submit">Enviar</button>
    </form>

    <a href="../index_logueado.php" style=" text-decoration:none; color: black;"><h3>Volver a Orange</h3></a>
</div>

</body>
</html>
