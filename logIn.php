<?php
    include "conexion.php";

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = mysqli_query($con, "SELECT * FROM usuario WHERE correo = '$usuario' AND password = '$password' ");
    $sqlA = mysqli_query($con, "SELECT * FROM administrador WHERE correo = '$usuario' AND password = '$password' ");

    if($sql && mysqli_num_rows($sql)>0){
        echo "<br>Usuario";
        header("Location: productos.php");
        session_start();

        $_SESSION['user'] = $usuario;
                    
    }else if($sqlA && mysqli_num_rows($sqlA) == 1){
        echo "<br>Administrador";
        header("Location: productosA.php");
        session_start();

        $_SESSION['userA'] = $usuario;
    }else{
        die("Error en la conexion de la base de datos : ".mysqli_error($con));
    }

    mysqli_close($con);

?>