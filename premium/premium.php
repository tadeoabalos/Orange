<?php
include("../conexion.php");
    session_start();
    $id = $_SESSION['id'];
    $consulta = "UPDATE usuarios SET tipo = 1 WHERE id = $id ";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["one-month"])) {            
            $consulta_exp = "UPDATE usuarios SET fecha_expiracion = DATE_ADD(NOW(), INTERVAL 1 MONTH) WHERE id = $id";         
        }
        else if (isset($_POST["six-month"])){
            $consulta_exp = "UPDATE usuarios SET fecha_expiracion = DATE_ADD(NOW(), INTERVAL 6 MONTH) WHERE id = $id";
        }
        else if (isset($_POST["tw-month"])){
            $consulta_exp = "UPDATE usuarios SET fecha_expiracion = DATE_ADD(NOW(), INTERVAL 12 MONTH) WHERE id = $id";
        }

        mysqli_query($conexion, $consulta_exp);
    }
    
    $resultado = mysqli_query($conexion, $consulta);

    if($resultado){
        header("Location: ./index.php");
    }
    else {
        echo "Algo salio mal";
    }

?>
