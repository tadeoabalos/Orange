$sql = "DELETE FROM administrador_ventas WHERE codart = :CODART";
<?php 
    include("../conexion.php");

    $id = $_POST['id'];
   
    $consulta = "DELETE FROM libros WHERE id = $id";

    mysqli_query($conexion, $consulta);
?>