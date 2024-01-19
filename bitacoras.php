<?php

include 'conexion.php';

$sql = "SELECT * FROM bitacora_licor";
$result = $con->query($sql);

$sqlU = "SELECT * FROM bitacora_usuario";
$resultU = $con->query($sqlU);

$con->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitácoras</title>
    <style>
        body {
            background-color: black;
            color: gold;
            font-family: 'Gothic', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid gold;
        }

        th {
            background-color: gold;
            color: black;
        }

        tr:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Bitácora de Licor</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Sentencia</th>
                <th>Contrasentencia</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["fecha"] . "</td>";
                    echo "<td>" . $row["sentencia"] . "</td>";
                    echo "<td>" . $row["contrasentencia"] . "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay datos en la tabla.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h1>Bitácora de Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Sentencia</th>
                <th>Contrasentencia</th>
                <!-- Agrega más columnas según la estructura de tu tabla -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar datos de la tabla bitacora_licor
            if ($resultU->num_rows > 0) {
                while ($rowU = $resultU->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rowU["id"] . "</td>";
                    echo "<td>" . $rowU["fecha"] . "</td>";
                    echo "<td>" . $rowU["sentencia"] . "</td>";
                    echo "<td>" . $rowU["contrasentencia"] . "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay datos en la tabla.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>