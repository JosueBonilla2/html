<?php
    require_once "conexion.php";

    session_start();

    if(!isset($_SESSION['user'])){
        header("Location: logIn.html");
    }
    else{
        $user = $_SESSION['user'];
    }

    if(isset($_POST['venta'])){
        if(!isset($_SESSION['user'])){
            header("Location: logIn.html");
        }
        else{
            $user = $_SESSION["user"];
            $nombre_p = $_POST['nombre'];
            $sabor = $_POST['sabor'];
            $precio = $_POST['precio'];
            $cant_alcohol = $_POST['cant_alcohol'];
            $cantidad = $_POST['cantidad'];
            
            $sqlIn = mysqli_query($con, "INSERT INTO ventas (nombre_p, sabor, cant_alcohol, precio, usuario, cantidad) VALUES ('$nombre_p','$sabor','$cant_alcohol','$precio','$user','$cantidad')");

            header("Location: carrito.php");

        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleP.css">
    <title>Productos</title>
</head>
<body>
    <header>
        <nav>
          <ul>
            <li><a href="salir.php">Salir</a></li>
            <li><a href="logIn.html">LogIn</a></li>
            <li><a href="Registros.html">Registros</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="index.html">Inicio</a></li>
          </ul>  
          <a class="carrito" href="carrito.php"><img class="c" src="img\carrito.png" alt=""></a>
        </nav>
    </header>

    <h1>PRODUCTOS</h1>

    <section class="contenido">
        <div class="mostrador" id="mostrador">

            <?php

                include 'conexion.php';

                // Consulta para obtener los productos
                $sql = "SELECT * FROM licor";
                $result = $con->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo '<form action="" method="post">';
                        echo '<div class="item">';
                            echo '<div class="cont-imagenes">';
                                echo '<img src="img/' . $row['id'] . '.jpg">';
                            echo '</div>';

                            echo '<input name="nombre" type="hidden" value="'.$row["nombre"].'">';
                            echo '<input name="sabor" type="hidden" value="'.$row["sabor"].'">';
                            echo '<input name="cant_alcohol" type="hidden" value="'.$row["cant_alcohol"].'">';
                            echo '<input name="precio" type="hidden" value="'.$row["precio"].'">';
                            echo '<input name="cantidad" type="hidden" value="1">';

                            echo '<h2 class="producto">' . $row['nombre'] . '</h2>';
                            echo '<p class="descripcion"> SABOR: ' . $row['sabor'] . '</p>';
                            echo '<p class="cantidad">Cant.Alh:' . $row['cant_alcohol'] . '</p>';
                            echo '<span class="precio" value="1">$' . $row['precio'] . '</span>';

                            echo '<button class="carrito" type="submit" name="venta" >AGREGAR AL CARRITO</button><br>';

                        echo '</div>';
                    echo '</form>';

                }

                $con->close();
            ?>
        </div> 
    </section>
    
    <script src="mostrar.js"></script>
    
    <footer>
        Josue Bonilla Cardenas | 4P <br> Desarrollo WEB | Base de datos
    </footer>
</body>
</html>