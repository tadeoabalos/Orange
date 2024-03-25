<?php
    include("../conexion.php");

    $id = $_POST['id'];
    $direccion = $_POST['direccion'];

    $consulta = "UPDATE usuarios SET direccion = '$direccion' WHERE id = $id";

    mysqli_query($conexion, $consulta);
?>
