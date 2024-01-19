<?php

    include("conexion.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleA.css">
    <title>Registros</title>
</head>
<body>
    <header>
        <nav>
          <ul class="menu_horizontal">
            <li>
                <a href="#">Eliminar</a>
                <ul class="menu_vertical">
                    <li><a href="eliminar.html">Eliminar producto</a></li>
                    <li><a href="eliminarU.html">Eliminar usuarios</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Agregar</a>
                <ul class="menu_vertical">
                    <li><a href="agregarP.html">Agregar producto</a></li>
                    <li><a href="Registros.html">Agregar usuarios</a></li>
                </ul>
            </li>
            <li><a href="salir.php">Salir</a></li>
            <li><a href="bitacoras.php">Bitacoras</a></li>
            <li><a href="logIn.html">LogIn</a></li>
            <li><a href="Registros.html">Registros</a></li>
            <li><a href="productosA.php">Productos</a></li>
            <li><a href="index.html">Inicio</a></li>
          </ul>  
        </nav>
    </header>

    <?php
        if(isset($_POST["enviar"])){

            $id= $_POST['id'];
            $nombre= $_POST["nombre"];
            $sabor = $_POST["sabor"];
            $cant = $_POST["cant_alcohol"];
            $precio = $_POST["precio"];

            $sql = "UPDATE licor SET nombre='".$nombre."', sabor='".$sabor."', precio='".$precio."', cant_alcohol='".$cant."' WHERE id='".$id."'";
            $result = mysqli_query($con,$sql);

            if($result){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron de manera correcta');
                        location.assign('productosA.php');
                        </script>";
            }else{
                echo "<script language='JavaScript'>
                        alert('Los datos NO se actualizaron de manera correcta');
                        location.assign('productosA.php');
                        </script>";
            }

            $sqlU = "CREATE TRIGGER bitacora_licor_update
            AFTER UPDATE ON licor
            FOR EACH ROW
            BEGIN
                INSERT INTO bitacora_licor (fecha, sentencia, contrasentencia)
                VALUES (NOW(), 
                        CONCAT('UPDATE licor SET nombre = ''', NEW.nombre, ''', precio = ''', NEW.precio, ''', sabor = ''', NEW.sabor, ''', cant_alcohol = ''', NEW.cant_alcohol, ''' WHERE id = ', OLD.id),
                        CONCAT('UPDATE licor SET nombre = ''', OLD.nombre, ''', precio = ''', OLD.precio, ''', sabor = ''', OLD.sabor, ''', cant_alcohol = ''', OLD.cant_alcohol, ''' WHERE id = ', NEW.id)
                );
            
                IF ROW_COUNT() = 0 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'TRIGGER NO INSERTADO';
                END IF;
            END";

            if ($con->multi_query($sqlU) === TRUE) {
                echo "TRIGGER CREADO";
            } else {
                echo "Error al crear el trigger: " . $con->error;
            }

            mysqli_close($con);

        }else{

            $id = $_GET['id'];
            $sql = "SELECT * FROM licor WHERE id='".$id."'";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();

            $nombre = $row['nombre'];
            $precio = $row['precio'];
            $sabor = $row['sabor'];
            $cant_alcohol = $row['cant_alcohol'];

            $con->close();
    ?>

    <div class="Registro-box">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                
            <h1>Modificar producto</h1>
    
            <label for="nombre"> Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                
            <label for="precio"> Precio: </label>
            <input type="text" name="precio" id="precio" value="<?php echo $precio; ?>">
    
            <label for="sabor"> Sabor: </label>
            <input type="text" name="sabor" id="sabor" value="<?php echo $sabor; ?>">
    
            <label for="cantidad"> Cantidad alcohol: </label>
            <input type="text" name="cant_alcohol" id="cant_alcohol" value="<?php echo $cant_alcohol; ?>">

            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

            <button type="submit" name="enviar" value="actualizar">MODIFICAR</button>
        </form>
    </div>

    <?php } ?>
    
    <footer>
        Josue Bonilla Cardenas | 4P <br> Desarrollo WEB  Base de datos
    </footer>
</body>
</html>