<?php
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['mail'];
    $user = $_POST['user'];
    $pw = md5($_POST['pass']);

    include("conexion.php");

    $validar = "SELECT * FROM usuarios WHERE mail = '$email' OR user = '$user'";
    $validacion = mysqli_query($conexion, $validar);
    $resultado = mysqli_num_rows($validacion);

    if ($resultado > 0) {
        // Usuario ya existe, mostrar alerta y redirigir al formulario de registro
        echo "<script>alert('Usuario ya existente.')</script>";
        echo "<script>window.location.href = 'form_registro.php';</script>";
        exit();
    } else {
        $consulta = mysqli_query($conexion, "INSERT INTO usuarios (nombre, apellido, mail, user, pass, tipo)
            VALUES('$nombre','$apellido','$email', '$user', '$pw', 0)");

        if ($consulta) {
            // Obtener el ID después de la inserción
            $id_usuario = mysqli_insert_id($conexion);

            session_start();
            $_SESSION['usuario'] = $user;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $id_usuario; 

            header("Location: index_logueado.php");
            exit();
        } else {            
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
    }
?>
