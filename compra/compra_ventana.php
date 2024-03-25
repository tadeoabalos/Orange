<?php 
    session_start();
    include("../conexion.php");
    $id = $_SESSION['id'];
    $consulta_addr = "SELECT direccion FROM usuarios WHERE id = $id";
    $resultado = mysqli_query($conexion, $consulta_addr);
    
    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
    
        if ($fila !== null) {
            $direccion = $fila['direccion'];
        } else {
            echo "No se encontró dirección para el usuario con ID $id";
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }    


    $consulta_tipo = "SELECT tipo FROM usuarios WHERE id = $id";
    $resultado_tipo = mysqli_query($conexion, $consulta_tipo);
    $fila_tipo = mysqli_fetch_assoc($resultado_tipo);
    if ($fila_tipo['tipo'] == 1) {
        $premium = true;
    } else {
        $premium = false;
    }
    
    $id = $_POST['id'];
    $consulta = "SELECT * FROM libros WHERE id = $id";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        while ($row = $resultado->fetch_array()) {            
            $nombre = $row['nombre'];            
            $autor = $row['autor'];
            $year = $row['fecha'];
            $imagen = $row['foto'];
            $precio = $row['precio'];
        }
    }
    else {
        echo "ERROR EN LA CONSULTA";
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <link rel="stylesheet" type="text/css" href="./estilo.css" media="all" >
        <script src="https://kit.fontawesome.com/556c5129ce.js" crossorigin="anonymous"></script>
        <title><?php echo $nombre?></title>
    </head>
    <body>
        <nav id="nav-bar">
        <?php 
            if($premium){
                ?><a href="../premium/index.php" style="text-decoration: none"><h1 style="color: orange;">Orange</h1></a><?php
            }
            else {
                ?><a href="../index_logueado.php" style="text-decoration: none"><h1 style="color: orange;">Orange</h1></a><?php
            }
        ?>
        </nav>
        <div id="caja-compras">
        <table style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Precio</th>
                <th>Método de entrega</th>
                <th>Dirección</th>
                <th>Precio Envío</th>
                <th>Total</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $nombre; ?></td>
                <td><?php echo $autor; ?></td>
                <?php 
                if(!$premium){
                    echo "<td>$" . $precio . "</td>";
                    if($_POST['opcion_envio'] == "Retiro"){
                        echo "<td>Retiro en local</td>";
                        echo "<td>Rosales 811</td>";
                        echo "<td>$0</td>";
                        echo "<td>$" . $precio . "</td>";
                    }
                    else {
                        echo "<td>Envío</td>";
                        echo "<td><input id='direc-input' type='text' value=' $direccion ' required>";
                        echo "<td>$2.5</td>";
                        echo "<td>$" . ($precio + 2.5 ) . "</td>";
                    }
                }
                else {
                    $precio = $precio - ($precio * 0.2);
                    echo "<td>$". (number_format($precio, 2)) . "<i class='fa-solid fa-crown' style='color: #ff9100;'></i></td>";
                    if($_POST['opcion_envio'] == "Retiro"){
                        echo "<td>Retiro en local</td>";
                        echo "<td>Rosales 811</td>";
                        echo "<td>Gratis<i class='fa-solid fa-crown' style='color: #ff9100;'></i></td></td>";
                        echo "<td>$" . (number_format($precio, 2)) . "</td>";
                    }
                    else {
                        echo "<td>Envío</td>";
                        echo "<td><input id='direc-input' type='text' value=' $direccion ' required>" . "</td>";
                        echo "<td>Gratis<i class='fa-solid fa-crown' style='color: #ff9100;'></i></td></td>";
                        echo "<td>$" . (number_format($precio, 2)) . "</td>";
                    }
                }
                ?>
            </tr>
        </tbody>
        </table>
        <form action="baja_stock.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input id="compra-btn" type="submit" value="Finalizar Compra">
        </form>
        </div>
                      
             
</body>
</html>
   