<?php
    $servername = "localhost";
    $database = "postmortem";
    $username = "root"; //$username = "josue";
    $password = ""; //$password = "1234";

    $con = mysqli_connect($servername, $username, $password, $database);

    if(!$con){
        die("Fallo la conexion de la base de datos".mysqli_connect_error());
    }else{
        
    }  
?>