<?php
    require("../conexion.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $autor = $_POST['autor'];
        $precio = $_POST['precio'];
        $fecha = $_POST['fecha'];
        $stock = $_POST['stock'];

        $imagen_nombre = $_FILES['foto']['name'];
        $imagen_temp = $_FILES['foto']['tmp_name'];

        $carpeta_destino = "fotos/";
        $ruta_imagen = $carpeta_destino . $imagen_nombre;
        
        $consulta = "UPDATE libros SET nombre = '$nombre', autor = '$autor', precio = '$precio', fecha = '$fecha', stock = '$stock', foto = '$ruta_imagen' WHERE id = '$id'";
       
        $resultado = mysqli_query($conexion, $consulta);

        if($resultado){
            echo "OK";
        } else {
            echo "Error en la actualización: " . mysqli_error($conexion);
        }
    }
?>
