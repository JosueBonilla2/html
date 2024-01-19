<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylePA.css">
    <title>Productos</title>
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

    <h1>PRODUCTOS</h1>

<section class="contenido">
    <div class="mostrador" id="mostrador">
        <?php
            include 'conexion.php';

            // Consulta para obtener los productos
            $sql = "SELECT * FROM licor";

            $result = $con->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="item">';
                    echo '<div class="cont-imagenes">';
                        echo '<img src="img/'.$row['id'].'.jpg">';
                    echo '</div>';
                    echo '<h2 class="producto">'.$row['nombre'].'</h2>';
                    echo '<p class="descripcion"> SABOR: ' . $row['sabor'] . '</p>';
                    echo '<p class="cantidad">Cant.Alh:' . $row['cant_alcohol'] . '</p>';
                    echo '<span class="precio">$' .$row['precio']. '</span><br>';
                    echo "<a href='modificar.php?id=".$row['id']."'><button class='boton'  type='submit'>MODIFICAR</button></a>";
                echo '</div>';
            }
        ?>

    </div> 

    <!--CONTENEDOR DE LOS ITEM SELECCIONADOS-->

    <div class="seleccion" id="seleccion">
        <div class="cerrar" onclick="cerrar()">
            <p>X</p>
        </div>
        <div class="info">
            <img src="img/licor-cafe-jose.jpg" alt="" id="img">
            <h2 id="modelo">DOÑA JOSE LICOR DE CAFÉ</h2>
            <p id="descripcion">18% Alc.Vol. Original de Tequila, Jalisco,Mex</p>
            <span class="precio" id="precio">$490.00</span>
                <!--<div class="fila">
                    <div class="size">
                        <label for="size">Cantidad de Pedido:</label>
                        <select name="" id="">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                            <option value="">6</option>
                        </select>
                    </div>
                </div>-->
            <br>
                <?php echo "<a href='FormatoPdfA.php?id=7'><button class='boton' type='submit'>ENVIAR CORREO</button></a>";?>
                <button class="carrito" type="submit">AGREGAR AL CARRITO</button><br>
            </div>
    </div>

    <?php  $con->close(); ?>

</section>

<script src="mostrar.js"></script>

    <footer>
        Josue Bonilla Cardenas | 4P <br> Desarrollo WEB | Base de datos
    </footer>
</body>
</html>