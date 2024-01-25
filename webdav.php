<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tus Tickets</title>
    <style>
        body {
            background-color: #111;
            color: #d4af37; /* Dorado */
            font-family: 'Gothic', sans-serif;
            text-align: center;
            margin: 50px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            border: 1px solid #d4af37; /* Dorado */
        }

        th {
            background-color: #111;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        a {
            color: #d4af37; /* Dorado */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Tus Tickets</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre del Archivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $webdavUrl = 'http://10.0.0.5'; // Ajusta la URL según tu configuración

            // Obtener lista de archivos en WebDAV
            $files = scandir($webdavUrl);

            // Excluir directorios especiales y archivos ocultos
            $files = array_diff($files, array('..', '.'));

            foreach ($files as $file) {
                echo '<tr>';
                echo '<td>' . $file . '</td>';
                echo '<td><a href="' . $webdavUrl . '/' . $file . '" target="_blank">Ver</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
