<?php


    if(isset($_POST['btnSubmit'])){
            if(!isset($_SESSION['user'])){
                header("Location: login.html");
            }else{
                $user = $_SESSION['user'];
                $prName = $_POST['prName'];
                $price = $_POST['price'];
                $amount = $_POST['amount'];
                $date = date("Y-m-d H:i:s");
                $sizes = $_POST["sizes"];
                $image = $_POST["image"];

                $sqlInsert = mysqli_query($connection, "INSERT INTO sales (productName, amount, sizes, price, costumerUser, date, image, type) VALUES ('$prName','$amount','$sizes','$price','$user','$date','$image', '$type')");
                header("Location: index.html");
            }
    }

?>