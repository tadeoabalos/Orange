<?php
    session_start();
    include("../conexion.php");
    $id = $_SESSION['id'];
    $consulta_tipo = "SELECT tipo FROM usuarios WHERE id = $id";
    $resultado_tipo = mysqli_query($conexion, $consulta_tipo);
    $fila_tipo = mysqli_fetch_assoc($resultado_tipo);
    if ($fila_tipo['tipo'] == 1) {
        $premium = true;
    } else {
        $premium = false;
    }
    sleep(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./estilo.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://kit.fontawesome.com/556c5129ce.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <nav id="nav-bar">
            <h1 style="color: orange"><a href="../index_logueado.php">Orange</a></h1>
            <div>
                <form action="" method="get">
                    <input type="text" placeholder="¿Que estas buscando?"  name="buscar" id="busqueda">
                    <input type="submit" name="enviar" value="Buscar" style="background-color: white">  
                </form>                        
            </div>
            <div class="botonera">                
                <a style="text-decoration: none; color: orange; margin-right: 5px" href="../cerrarsesion.php">Cerrar Sesión</a>                
                <a style="text-decoration: none; color: orange; margin-right: 15px" href="">Premium</a>
            </div>
    </nav>
</html>
<?php
    if(isset($_GET['libro_id'])) {
        $id = $_GET['libro_id'];
        $consulta_sql = "SELECT * FROM libros WHERE id = $id";
        $resultado = mysqli_query($conexion, $consulta_sql);
        if($resultado){
            while($row = $resultado->fetch_array()){
                $id = $row['id'];
                $nombre = $row['nombre'];
                $autor = $row['autor'];
                $year = $row['fecha'];
                $imagen = $row['foto'];
                $precio = $row['precio'];
                $desc = $row['descripcion'];
                ?>

                <link rel="stylesheet" type="text/css" href="estilo.css">
                <div id="contenedor">
                    <?php echo "<img src='../$imagen' height='570px' width='360px'/>" ?>  
                    <div id="libro">               
                        <div class="foot_book">
                        <span class="nombre"><?php echo $nombre ?></span>
                        <br/>
                        <p class="autor"><?php echo $autor ?></p>
                        <br/>
                        <?php 
                            if($premium){
                                $precio = $precio - ($precio * 0.2);
                                ?><span class="precio">U$<?php echo number_format($precio, 2); ?><i class="fa-solid fa-crown" style="color: #ff9100;"></i></span><?php
                            }
                            else {
                                ?><span class="precio">U$<?php echo $precio ?></span><?php
                            }
                        
                        ?>
                        
                        <br/>                        
                        <input class="boton-de-compra" type="submit" value="COMPRAR" id="compra">                        
                        <br/>                        
                        <h3 style="margin-left: 30px; color: orange">Descripción</h3>
                        <hr/>
                        <div class="desc">
                            <p><?php echo $desc ?></p>
                        </div>                
                    </div>
                    <div id="ventana-tarjeta" class="ven_invisible">
                        
                        <div class="cabecera"><button id="close" class="botonven">X</button></div>
                        <form method="post" action="compra_ventana.php" >         
                            <input name="id" type="hidden" value="<?php echo $id ?>">            
                            <label for="nombre">Nombre:</label>
                            <input class="nya" type="text" id="nombre" name="nombre" required>
                            
                            <label for="apellido">Apellido:</label>
                            <input class="nya" type="text" id="nombre" name="apellido" required>

                            <label for="numero">Número de Tarjeta:</label>
                            <input type="text" id="numero" name="numero" required>

                            <label for="expiracion">Fecha de Expiración:</label>
                            <input type="text" id="expiracion" name="expiracion" placeholder="MM/AA" required>

                            <label for="cvv">CVV:</label>
                            <input type="text" id="cvv" name="cvv" required>

                            <label for="opcion_envio">Selecciona una opción:</label>
                            <select name="opcion_envio" id="opcion_envio">
                                <option value="Retiro" >Retirar en Local</option>
                                <option value="Envio">Pagar Envío</option>
                            </select>

                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
                
                <?php                        
            }
        }
}
?>
<script>
    document.getElementById("compra").addEventListener("click", function() {
        $("#ventana-tarjeta").attr("class", "ven_visible");
        });

    document.getElementById("close").addEventListener("click", function() {
        $("#ventana-tarjeta").attr("class", "ven_invisible");
        });
</script>
</body>
</html>
        
