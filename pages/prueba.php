<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prueba</title>
</head>
<body>
  <?php
    require "conexion.php";
    $sql = "SELECT count(*) FROM producto;";
    $resultado = $mysqli->query($sql);
    echo $resultado->fetch_array()[0] ?? 'Hola';
  ?>
</body>
</html>