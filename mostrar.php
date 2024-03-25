<?php
include("conexion.php");

$inc = include("conexion.php");
if ($inc) {
    if (isset($_GET['enviar'])) {
        $busqueda = $_GET['buscar'];
        $consulta = "SELECT * FROM libros WHERE nombre LIKE '%$busqueda%'";
    } else {
        $consulta = "SELECT * FROM libros";
    }

    $resultado = mysqli_query($conexion, $consulta);
    ?>
    <div id="libros">
        <?php
        if ($resultado) {
            while ($row = $resultado->fetch_array()) {
                $id = $row['id'];
                $nombre = $row['nombre'];
                $autor = $row['autor'];
                $year = $row['fecha'];
                $imagen = $row['foto'];
                $precio = $row['precio'];
                ?>
                <link rel="stylesheet" type="text/css" href="estilo.css">
                <div id="libro">
                    <?php echo "<img src='$imagen' height='300' width='200'/>" ?>
                    <div class="foot_book">
                    <span><?php echo $nombre ?></span>
                    <br/>
                    <span><?php echo $autor ?></span>
                    <br/>
                    <span>$<?php echo  $precio ?></span>
                    <br/>
                    <form action="form_registro.php" enctype="multipart/form-data" method="post">
                        <input type="submit" value="COMPRAR">
                    </form>
                    </div>                                     
                </div>
                <?php
            }
        }
    }
    ?>

</div>
