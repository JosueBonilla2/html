<?php
    require_once "conexion.php";

    $usuario = $_GET['usuario'];
    $nombre_p = $_GET['nombre_p'];
    $precio = $_GET['precio'];
    $cantidad= $_GET['cantidad'];

    $sqlD = mysqli_query($con, "DELETE FROM ventas WHERE usuario='$usuario' AND nombre_p='$nombre_p'AND cantidad='$cantidad'");
    header("Location: carrito.php");

    mysqli_close($con);
?>