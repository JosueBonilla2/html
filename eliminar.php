<?php
    include "conexion.php";

    $nombre = $_POST['nombre'];

    $sql = mysqli_query($con, "DELETE FROM licor WHERE nombre = '$nombre'");

    if($sql){
        echo "<br> Se Elimino el producto";
        header("Location: productosA.php");
    }else{
        echo "<br> Error" .$sql. "<br>" . mysqli_error($con);
    }

    $sqlD = "CREATE TRIGGER bitacora_licor_delete
    AFTER DELETE ON licor
    FOR EACH ROW
    BEGIN
    INSERT INTO bitacora_licor (fecha, sentencia, contrasentencia)
    VALUES (NOW(), 
            CONCAT('DELETE FROM licor WHERE id = ', OLD.id),
            CONCAT('INSERT INTO licor (nombre, precio, sabor, cant_alcohol) VALUES (''', OLD.nombre, ''', ''', OLD.sabor, ''', ''', OLD.precio, ''', ''', OLD.cant_alcohol, ''');')
    );
        IF ROW_COUNT() = 0 THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'TRIGGER NO INSERTADO';
        END IF;
    END";

    if ($con->multi_query($sqlD) === TRUE) {
        echo "TRIGGER CREADO";
    } else {
        echo "Error al crear el trigger: " . $con->error;
    }

    mysqli_close($con);
?>