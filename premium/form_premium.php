<?php 
    sleep(1);
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./estilo_login.css"> 
    <script src="https://kit.fontawesome.com/556c5129ce.js" crossorigin="anonymous"></script>
    <title>¡Hazte premium!</title>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h1 style="color: orange;">¡<?php echo $_SESSION['usuario']?> hazte premium!</h1>
            <h1>¡Siendo premium tendras descuentos exclusivos y envíos gratis!</h1>
            <a href="../index_logueado.php" style="color: orange; text-decoration: none"><h1 style="color: orange; ">Orange</h1></a>
            <div class="cuadrados">
                <div class="cuadrado">
                    <h2 style="color: orange;">1 MES <i class="fa-solid fa-crown" style="color: #ff9100;"></i></h2>
                    <h4 style="color: orange;">¡Sumérgete en la experiencia premium durante 1 mes completo!</h4>
                    <hr/>                    
                    <h2 style="color: orange;">$5,00 x MES</h2>
                    <h4 style="color: orange;">Total: 5,00$</h4>
                    <form action="premium.php" method="post">                                              
                        <button type="submit" name="one-month">COMPRAR</button><br/> 
                    </form>  
                </div>
                <div class="cuadrado">
                    <h2 style="color: orange;">6 MESES <i class="fa-solid fa-crown" style="color: #ff9100;"></i></h2>
                    <h4 style="color: orange;">¡Maximiza tus beneficios con nuestro paquete premium de 6 meses!</h4>
                    <hr/>                                                                 
                    <h2 style="color: orange;">$4,50 x MES</h2>
                    <h4 style="color: orange;">Total: 27,00$</h4>
                    <form action="premium.php" method="post">                                              
                        <button type="submit" name="six-month">COMPRAR</button><br/> 
                    </form>  
                </div>
                <div class="cuadrado">
                    <h2 style="color: orange;">12 MESES <i class="fa-solid fa-crown" style="color: #ff9100;"></i></h2>
                    <h4 style="color: orange;">¡La mejor oferta para una experiencia premium ininterrumpida!</h4>
                    <hr/>                    
                    <h2 style="color: orange;">$4,00 x MES</h2>
                    <h4 style="color: orange;">Total: 48,00$</h4>
                    <form action="premium.php" method="post">                                              
                        <button type="submit" name="tw-month">COMPRAR</button><br/> 
                    </form>                
                </div>
            </div>
            <div class="footer">                
                <p><a href="../index_logueado.php">Volver</a></p>
            </div>
        </div>
    </div>    
</body>
</html>