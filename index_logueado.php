<?php
    sleep(1);
    session_start();
    include("./conexion.php");

    $id = $_SESSION['id'];
    $consulta_tipo = "SELECT tipo FROM usuarios WHERE id = $id";
    $resultado_tipo = mysqli_query($conexion, $consulta_tipo);
    $fila_tipo = mysqli_fetch_assoc($resultado_tipo);
    if ($fila_tipo['tipo'] == 1) {
        $premium = true;
    } else {
        $premium = false;
    }

    if(!isset($_SESSION["usuario"]))
    {
        header('Location:index.php');
        exit();
    }

    if($premium){
        header('Location: ./premium/index.php');
        exit();
    }
    
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
        <title>Orange</title>
    </head>
    <body>
        <nav id="nav-bar">
        <a style="text-decoration: none" href="./index_logueado.php"><h1 style="color: orange">Orange</h1></a>
    <?php 
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
        $consulta_direccion = "SELECT direccion FROM usuarios WHERE id = $id";
        $resultado_direccion = mysqli_query($conexion, $consulta_direccion);

        if ($resultado_direccion) {
            $fila_direccion = mysqli_fetch_assoc($resultado_direccion);
            $direccion = $fila_direccion['direccion'];
            $_SESSION['direccion'] = $direccion;
            if ($direccion != NULL) {
                ?>
                <button id="direccion" style="text-decoration: none; color:orange;">
                    <?php echo $direccion; ?>
                    <i class="fa-solid fa-location-dot" style="color: #ff9100;"></i>
                </button>
                <?php
            } else {
                ?>
                <button id="direccion" style="text-decoration: none; color:orange;">
                    Dirección <i class="fa-solid fa-location-dot" style="color: #ff9100;"></i>
                </button>
                <?php
            }
        } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
        }
        else {?>
            <button id="direccion" style="text-decoration: none; color:orange;">
                Dirección <i class="fa-solid fa-location-dot" style="color: #ff9100;"></i>
            </button>
            <?php
        }
    ?>
            <div>
                <form action="" method="get">
                    <input type="text" placeholder="¿Que estas buscando?"  name="buscar" id="busqueda">                    
                    <input type="submit" name="enviar" id="buscar" value="Buscar" >                    
                </form>                        
            </div>
            <div class="botonera">
                <span style="color: orange; padding-right: 10px; font-size: 15px">¡Bienvenido <?php echo $_SESSION['usuario']?>!</span>       
                <a style="text-decoration: none; color: orange; margin-right: 5px" href="./premium/form_premium.php">Premium<i class="fa-solid fa-crown" style="color: #ff9100;"></i></a>          
                <span style="color: orange;"> | </span>
                <a style="text-decoration: none; color: orange; margin-left: 5px; margin-right: 15px" href="cerrarsesion.php">Cerrar Sesión</a>                              
            </div>
        </nav>
        <?php 
            $inc = include("conexion.php");
                    if($inc){
                            if(isset($_GET['enviar'])){
                                $busqueda = $_GET['buscar'];
                                $consulta = "SELECT * FROM libros WHERE nombre LIKE '%$busqueda%' or autor LIKE '%$busqueda%'";  
                            }
                            else{
                                $consulta = "SELECT * FROM libros";
                            }
                            
                        
                            $resultado = mysqli_query($conexion, $consulta);
                            ?>
                            
                            <div id="content-container">
                                
                            <div id="libros">
                            <?php
                            if($resultado){
                                while($row = $resultado->fetch_array()){
                                    $id = $row['id'];
                                    $nombre = $row['nombre'];
                                    $autor = $row['autor'];
                                    $year = $row['fecha'];
                                    $imagen = $row['foto'];
                                    $precio = $row['precio'];
                                    $stock = $row['stock'];
                                    ?>
                                    <link rel="stylesheet" type="text/css" href="estilo.css">
                                    <div id="libro">
                                        <?php echo "<img src='$imagen' height='300' width='200'/>" ?>
                                        <div class="foot_book">
                                        <span style="color: orange;"><?php echo $nombre ?></span>
                                        <br/>
                                        <span><?php echo $autor ?></span>
                                        <br/>
                                        <span >$<?php echo  $precio ?></span>
                                        <br/>                                        
                                        <?php 
                                            if($stock > 0){
                                                ?>
                                                <form action="./compra/compra.php" method="get">
                                                <input type="hidden" name="libro_id" value="<?php echo $id; ?>">
                                                <input type="submit" value="COMPRAR">
                                                </form>                                                
                                                <?php
                                            }
                                            else {
                                                ?>
                                                <input style="background-color: red; cursor: not-allowed;" type="submit" value="SIN STOCK">
                                                <?php
                                            }
                                        ?>                            
                                        </div>                    
                                    </div>
                                    <?php                        
                                }
                            }
                    }
                    
            ?>
        </div>
        <div id="ventana-direccion" class="ven_invisible">
            <div class="cabecera"><span style="padding-left: 15px ;">Coloque su direccion</span><button id="closeven" class="botonven">X</button></div>
            <div id="contendor-form">
                <form id="form-direccion" method="post" >
                    <label for="direccion">Dirección: <input type="text" id="direc" name="direc" value="" required></label>
                    <input type="submit" id="env" name="envio" value="Enviar">
                </form>
            </div>
        </div> 
        </div>
        <footer>
            <h3>Orange</h3>
            <a href="./contacto/index.php">Formulario de contacto  </a>            
            <div id="redes">
                <a href="#"><i class="fa-brands fa-twitter" style="color: #ff9100;"></i></a>
                <a href="#"><i class="fa-brands fa-facebook" style="color: #ff9100;"></i></a>
                <a href="#"><i class="fa-brands fa-instagram" style="color: #ff9100;"></i></a>
            </div>
        </footer>
        <script>
            document.getElementById("direccion").addEventListener("click", function() {
                $("#ventana-direccion").attr("class", "ven_visible");
            });
            document.getElementById("closeven").addEventListener("click", function() {
                $("#ventana-direccion").attr("class", "ven_invisible");
            });
            
            $("#form-direccion").submit(function(e) {
                e.preventDefault(); 
                var direccion = $("#direc").val();
                var id = <?php echo $_SESSION['id']; ?>; 

                $.ajax({
                    type: "POST",
                    url: "direccion.php", 
                    data: { direccion: direccion, id: id }, 
                    success: function(response) {
                        alert("Direccion guardada correctamente.");
                        $("#ventana-direccion").attr("class", "ven_invisible");
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        </script>
    </body>
    </html>