<?php
    include "conexion.php";

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $sabor = $_POST['sabor'];
    $cantidad = $_POST['cantidad'];

    $sql = mysqli_query($con, "INSERT INTO licor (id,nombre,precio,sabor,cant_alcohol) VALUES (0,'$nombre','$precio','$sabor','$cantidad')");

    if($sql){
        echo "<br> Licor agregado ";
        header("Location: productosA.php");
    }else{
        echo "<br> Error" .$sql. "<br>" . mysqli_error($con);
    }

    $sqlIn = "CREATE TRIGGER bitacora_licor
    AFTER INSERT ON licor
    FOR EACH ROW
    BEGIN
    INSERT INTO bitacora_licor (fecha, sentencia, contrasentencia)
    VALUES (NOW(), 
            CONCAT('INSERT INTO licor (nombre, precio, sabor, cant_alcohol) VALUES (''', NEW.nombre, ''', ''', NEW.sabor, ''', ''', NEW.precio, ''', ''', NEW.cant_alcohol, ''');'),
            CONCAT('DELETE FROM licor WHERE id = ', NEW.id)
    );
        IF ROW_COUNT() = 0 THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'TRIGGER NO INSERTADO';
        END IF;
    END";

    if ($con->multi_query($sqlIn) === TRUE) {
        echo "TRIGGER CREADO";
    } else {
        echo "Error al crear los triggers: " . $con->error;
    }

    mysqli_close($con);

?>