<?php
    include "conexion.php";

    $correo = $_POST['correo'];

    $sql = mysqli_query($con, "DELETE FROM usuario WHERE correo = '$correo'");

    if($sql){
        echo "<br> Se Elimino el usuario";
        header("Location: bitacoras.php");

    }else{
        echo "<br> Error" .$sql. "<br>" . mysqli_error($con);
    }

    $sqlDU = "CREATE TRIGGER bitacora_usuario_delete
    AFTER DELETE ON usuario
    FOR EACH ROW
    BEGIN
    INSERT INTO bitacora_usuario (fecha, sentencia, contrasentencia)
    VALUES (NOW(), 
            CONCAT('DELETE FROM usuario WHERE id = ', OLD.id),
            CONCAT('INSERT INTO usuario (nombre, edad, estado, ciudad, direccion, correo, cel) VALUES (''', OLD.nombre, ''', ''', OLD.edad, ''', ''', OLD.estado, ''', ''', OLD.ciudad, ''', ''', OLD.direccion, ''', ''', OLD.correo, ''', ''', OLD.cel, ''',);')
    );
        IF ROW_COUNT() = 0 THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'TRIGGER NO INSERTADO';
        END IF;
    END";

if ($con->multi_query($sqlDU) === TRUE) {
    echo "TRIGGER CREADO";
} else {
    echo "Error al crear el trigger: " . $con->error;
}

    mysqli_close($con);

?>