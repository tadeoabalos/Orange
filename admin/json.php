<?php 
include("../conexion.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    //$consulta = "SELECT id, nombre, autor, fecha, precio, stock FROM libros WHERE id = $id"; PRIMERA MODIFICACION, TRAER LA DIRECCION DE LA IMAGEN
    $consulta = "SELECT id, nombre, autor, fecha, precio, stock, foto FROM libros WHERE id = $id";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $array_libro = mysqli_fetch_assoc($resultado);
        echo json_encode($array_libro);
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
    echo "No se recibió variable";
}

?>


