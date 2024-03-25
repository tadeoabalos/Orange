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
        <h1><a href="index.php">Orange admins</a></h1>
        <div>
        <form action="" method="get">
                <input type="text" placeholder="¿Que estas buscando?"  name="buscar" id="busqueda">
                <input class="buscar-btn" type="submit" name="enviar" value="Buscar">  
            </form>         
        </div>
        <div class="botonera">
            <button id="alta" class="alta">Agregar libro <i class="fa-solid fa-plus" style="color: #ff9100;"></i></button>  
            <a href="../cerrarsesion.php"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #fa9100;"></i></a>                      
        </div>
        
        <!-- VENTANA MODAL DE ALTA ***********************************************************************************************-->
        <div id="ventanaalt" class="ven_invisible" >
        <div class="cabecera"><span>Carga de libro</span><button id="closealt" class="botonven">X</button></div>
                <div class="formulario">
                    <form action="alta.php" enctype="multipart/form-data" method="post">              
                            <label>NOMBRE: <input type="text" name="nombre" required></label><br/>         
                            <label>AUTOR:<input type="text" name="autor" required></label><br/>                                             
                            <label>AÑO:<input type="text" name="fecha"required></label><br/>   
                            <label>PRECIO:<input type="text" name="precio" required></label><br/>                
                            <label>STOCK:<input type="text" name="stock" required></label><br/>                     
                            <label>CARGA DE IMAGEN:<input type="file" name="foto" accept="image/*"><br/>                       
                        <button class="botonenviar" id="envioalt">Enviar</button>
                    </form>     
                </div>
            </div>
        </div>
        <a href=""></a>
        <!-- VENTANA MODAL DE MODI ***********************************************************************************************-->
        <div id="ventanamod" class="ven_invisible" >
        <div class="cabecera"><span>Editar libro</span><button id="closemod" class="botonven">X</button></div>
                <div class="formulario">
                    <form id="form_mod" enctype="multipart/form-data" method="post">    
                            <label>ID: <input type="text" id="mod_id" name="id" value="" readonly ></label><br/>    
                            <label>NOMBRE: <input type="text" id="mod_nombre" name="nombre" value="" required></label><br/>         
                            <label>AUTOR:<input type="text" id="mod_autor" name="autor" required></label><br/>                                             
                            <label>AÑO:<input type="text" id="mod_fecha" name="fecha"required></label><br/>   
                            <label>PRECIO:<input type="text" id="mod_precio" name="precio" required></label><br/>                
                            <label>STOCK:<input type="text" id="mod_stock" name="stock" required></label><br/>                     
                            <label>CARGA DE IMAGEN:<input type="file" name="foto" accept="image/*"><br/>   
                            <input type="submit" name="enviomod" value="actualizar">                            
                    </form>     
                </div>
            </div>
        </div>
    </nav>
    <?php 
        $inc = include("../conexion.php");
        if($inc){
            if(isset($_GET['enviar'])){
                $busqueda = $_GET['buscar'];
                $consulta = "SELECT * FROM libros where nombre LIKE '%$busqueda%'";
            } else {
                $consulta = "SELECT * FROM libros";
            }
            
            $resultado = mysqli_query($conexion, $consulta);
    ?>
    
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
                ?>
                <link rel="stylesheet" type="text/css" href="estilo.css">
                <div class="libro">                    
                    <?php echo "<img src='../$imagen' height='300' width='200'/>"?>
                    <p><?php echo $nombre ?></p>                                        
                    <button class="editar" onclick="enviarId(<?php echo $id; ?>)">Editar</button>
                    <button class="baja" onclick="baja_articulo(<?php echo $id; ?>)"><i class="fa-solid fa-xmark" style="color: #ff9100;"></i></button>                         
                </div>
                <?php
            }
        }
    }       
    ?>
    <script>
        
        function enviarId(id) 
        {
            $.ajax({
                type: "POST",
                url: "json.php",
                data: { id: id },
                success: function (response) {
                    objetoDato = JSON.parse(response);
                    $("#mod_id").val(objetoDato.id);
                    $("#mod_nombre").val(objetoDato.nombre);
                    $("#mod_autor").val(objetoDato.autor);
                    $("#mod_fecha").val(objetoDato.fecha);
                    $("#mod_precio").val(objetoDato.precio);
                    $("#mod_stock").val(objetoDato.stock);
                }
            });
        }
        
        function baja_articulo(id)
        {
            
            $.ajax({
                type: "post",
                url: "baja.php",
                data: {id : id},
                success: function(respuesta)
                {
                    alert("Se elimino el registro correctamente");
                }
            });
        }

        $('#form_mod').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

                $.ajax({
                    url: 'mod.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {                    
                        alert(response); 
                    },
                    error: function(error) {
                        console.log(error);
                }
            });
        });

        

        document.addEventListener("DOMContentLoaded", function() {

        document.getElementById("alta").addEventListener("click", function() {
        $("#ventanaalt").attr("class", "ven_visible");
        });

        document.getElementById("closealt").addEventListener("click", function() {
        $("#ventanaalt").attr("class", "ven_invisible");
        });
        
        var botonesEditar = document.querySelectorAll(".editar");
        botonesEditar.forEach(function(boton) {
            boton.addEventListener("click", function() {
                $("#ventanamod").attr("class", "ven_visible");
            });
        });

        document.getElementById("closemod").addEventListener("click", function() {
        $("#ventanamod").attr("class", "ven_invisible");
        });

        $(document).ready(function() {
            $('#editar').on('click', function() {
                rellenar_form();
            });
        });
       

    });
    </script>
</body>
</html>