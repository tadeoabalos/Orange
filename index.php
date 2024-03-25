<?php 
    sleep(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" type="text/css" href="./estilo.css" media="all" >
    <script src="https://kit.fontawesome.com/556c5129ce.js" crossorigin="anonymous"></script>
    <title>Orange</title>
</head>
<body>
        <nav id="nav-bar">
        <a href="./index_logueado.php" style="text-decoration: none"><h1 style="color: orange;">Orange</h1></a>        
            <div>
                <form action="" method="get">
                    <input type="text" placeholder="¿Qué estás buscando?"  name="buscar" id="busqueda">
                    <input type="submit" name="enviar" value="Buscar" id="buscar">  
                </form>                        
            </div>
            <div class="botonera">
                <a href="form_login.php">Acceder</a>
                <a href="form_registro.php" style="padding-right: 20px;">Crear Cuenta</a>                
            </div>
        </nav>                          
        <div id="content-container">                 
            <?php         
                require("mostrar.php");
            ?>
        </div>
        <footer>
            <h3>Orange</h3>
            <a href="./form_registro.php">Formulario de contacto  </a>            
            <div id="redes">
                <a href="#"><i class="fa-brands fa-twitter" style="color: #ff9100;"></i></a>
                <a href="#"><i class="fa-brands fa-facebook" style="color: #ff9100;"></i></a>
                <a href="#"><i class="fa-brands fa-instagram" style="color: #ff9100;"></i></a>
            </div>
        </footer>
</body>
</html>
