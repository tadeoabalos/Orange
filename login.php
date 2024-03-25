<?php
    $usuario = $_POST['user'];
    $pw = md5($_POST['pass']);
    
    include("conexion.php");
    
    $consulta = mysqli_query($conexion, "SELECT id, nombre, apellido, mail, user, tipo FROM usuarios WHERE user='$usuario' AND pass='$pw'");
    
    $resultado = mysqli_num_rows($consulta);
    
    if($resultado != 0){
        session_start();
        
        $respuesta = mysqli_fetch_array($consulta);
        $_SESSION['sesion'] = session_create_id();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['id'] = 35;
        echo $_SESSION['id'];
        $tipoUsuario = $respuesta['tipo'];
        /*if($tipoUsuario == 2){                                
            header("Location: ./admin/index.php");
        } else {
            header("Location: index_logueado.php");                
        }*/
    } else {
        echo "<script>alert('No es un usuario registrado')</script>";
    }
?>
