
<?php
    require_once "conexion.php";

    session_start();

    global $total, $subTotal, $user;

    if(!isset($_SESSION['user'])){
        header("Location: logIn.html");
    }
    else{
        $user = $_SESSION['user'];
        $sql = mysqli_query($con, "SELECT * FROM ventas WHERE usuario='$user'");
        $sqlD = mysqli_query($con, "SELECT precio, cantidad FROM ventas WHERE usuario='$user'");
        while ($sub = mysqli_fetch_assoc($sqlD)) {
            $subTotal += $sub['precio']*$sub['cantidad'];
        }
        $total = $subTotal + 99;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/cartStyle.css">
    <link rel="shortcut icon" href="Images/logoIcon.png" />
    <title>Carrito</title>
</head>
<style>

    *{
        margin: 0;
        padding: 0;
        background: #E7EBEB;
        box-sizing: border-box;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    ul{
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: black;
        bottom: 5em;
    }

    li{
        float: right;
    }

    li a{
        display:block;
        font-size: 1em;
        text-align: center;
        color: #C69D04;
        padding:1em 1em;
        text-decoration: none;
        background: black;
        font-family:Arial;
    }

    li a:hover{
        background-color:#C69D04;
        color: black;
    }

    .agradecimiento {
        background: none;
        color: #ffd700; 
        text-align: center;
        font-size: 24px; 
        margin-top: 1em;
        margin-bottom: 2em; 
    }

    main {
        background-color: #000;
        padding: 20px;
    }

    .products {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1em;
        margin-bottom: 4em;
    }

    .products th{
        border: 1px solid #fff;
        padding: 10px;
        background: goldenrod;
        text-align: center;
    }

    .products td {
        border: 1px solid #fff;
        padding: 10px;
        text-align: center;
    }

    #brd {
        border: 1px solid #fff;
    }

    #blnk1 button {
        background-color: #000;
        color: #fff;
        border: 1px solid #fff;
        padding: 5px;
    }

    .divSumm {
        margin-top: 20px;
        margin-bottom: 4em;
    }

    .summary {
        width: 100%;
        border-collapse: collapse;
    }

    .summary th{
        border: 1px solid #fff;
        padding: 10px;
        background: goldenrod;
        text-align: center;
    }

    .summary td {
        border: 1px solid #fff;
        padding: 10px;
        text-align: center;
    }

    #spacing {
        padding-right: 20px;
    }

    button {
        height: 3em;
        width: 98.2em;
        border-radius: .5em;
        background-color: #ffd700;
        color: #000;
        border: none;
        padding: 10px;
        cursor: pointer;
        margin:auto;
    }

    .eliminar {
        height: 3em;
        width: 6em;
        border-radius: .5em;
        background-color: #ffd700;
        color: #000;
        border: none;
        padding: 10px;
        cursor: pointer;
    }

    .eliminar:hover {
        background: goldenrod;
        color: #000;
    }

    footer {
        height: 3em;
        font-size: 1em;
        background: #5A5959;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        text-align: center;
        color: white;
    }

</style>

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
        </nav>
    </header>

    <main>
        <h2 class="agradecimiento">!Gracias por tu pedido <?php echo $user; ?>!</h2>
        <table class="products">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th id="brd">Cantidad</th>
            </tr>
                <?php
                while ($data = mysqli_fetch_assoc($sql)) {
                ?>
                    <tr>
                        <td><?php echo $data['nombre_p']; ?></td>
                        <td><?php echo $data['precio']; ?></td>
                        <td id="brd"><?php echo $data['cantidad']; ?></td>
                        <td id="blnk1">
                            <a href="eliminarC.php?usuario=<?php echo $user;?>&nombre_p=<?php echo $data['nombre_p'];?>&precio=<?php echo $data['precio']; ?>&cantidad=<?php echo $data['cantidad']; ?>">
                                <button class="eliminar">ELIMINAR</button>
                            </a>
                        </td>
                    </tr>
                <?php
                }?>
        </table>
        <form action="pdf.php" method="post" class="divSumm">

            <table class="summary">
                <tr>
                    <th>PAGOS</th>
                </tr>
                <tr>
                    <td id="spacing">Sub total: MXN$ <?php echo $subTotal;?></td>
                </tr>
                <tr>
                    <td id="spacing">Envio: MXN$ 99</td>
                </tr>
                <tr>
                    <td id="spacing">Total a pagar: MXN$ <?php echo $total;?></td>
                </tr>
            </table>

            <input type="text" id="subtotal" name="subtotal" value="<?php echo $subTotal; ?>" style="display: none;">
            <input type="text" id="total" name="total" value="<?php echo $total; ?>" style="display: none;">

            <button type="submit" name="btnSubmit">ENVIAR TICKET</button>

        </form>

        <?php mysqli_close($con);?>

    </main>
    <footer>
        Josue Bonilla Cardenas | 4P <br> Desarrollo WEB | Base de datos
    </footer>
</body>
</html>