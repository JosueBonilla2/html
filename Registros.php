<?php
    include "conexion.php";

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $estado = $_POST['estado'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $cel = $_POST['cel'];
    $password = $_POST['password'];

    $sql = mysqli_query($con, "INSERT INTO usuario (id,nombre,edad,estado,ciudad,direccion,correo,cel,password) VALUES (0,'$nombre','$edad','$estado','$ciudad','$direccion','$correo','$cel','$password')");

    if($sql){
        echo "<br> usuario agregado";
        header("Location: logIn.html");
    }else{
        echo "<br> Error" .$sql. "<br>" . mysqli_error($con);
    }

    $sqlInU = "CREATE TRIGGER bitacora_usuario
    AFTER INSERT ON usuario
    FOR EACH ROW
    BEGIN
    INSERT INTO bitacora_usuario(fecha, sentencia, contrasentencia)
    VALUES (NOW(), 
            CONCAT('INSERT INTO usuario (nombre, edad, estado, ciudad, direccion, correo, cel) VALUES (''', NEW.nombre, ''', ''', NEW.edad, ''', ''', NEW.estado, ''', ''', NEW.ciudad, ''', ''', NEW.direccion, ''', ''', NEW.correo, ''', ''', NEW.cel, ''');'),
            CONCAT('DELETE FROM usuario WHERE id = ', NEW.id)
    );
        IF ROW_COUNT() = 0 THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'TRIGGER NO INSERTADO';
        END IF;
    END";

    if ($con->multi_query($sqlInU) === TRUE) {
        echo "TRIGGER CREADO";
    } else {
        echo "Error al crear los triggers: " . $con->error;
    }

    mysqli_close($con);
?>