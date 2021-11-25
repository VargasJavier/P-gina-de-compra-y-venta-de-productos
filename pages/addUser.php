<?php

  require 'conexion.php';

  if(!isset($_POST)){
    header("Location: menu-contraseña2.php");
  }

  $nombre = $_POST['nombres'];
  $telefono = $_POST['telefono'];
  $rol = $_POST['selectRol'];

  $sql = "SELECT COUNT(*) FROM usuarios;";
  $resultado = $mysqli->query($sql);
  $total = $resultado->fetch_array()[0] + 1 ?? 0;
  $idUser = "";

  if($rol == 2)
    header("Location: menu-contraseña2.php");

  if($total < 10)
    $idUser = "user_000".$total;
  else
    $idUser = "user_00".$total;

  $rolNombre = "Admin";  
  if($rol == 1)
    $rolNombre = "Vendedor";

  $contraseña = $rolNombre."123";

  $sqlInsert = "INSERT INTO `usuarios` (`id`, `nombres`, `contraseña`, `telefono`, `tipoUsuario_fk`) VALUES ('$idUser', '$nombre', '$contraseña', '$telefono', $rol)";
  $resultadoInsert = $mysqli->query($sqlInsert);

  if($resultadoInsert)
    header("Location: menu-contraseña2.php");
  else
    // header("Location: menu-contraseña2.php");
    echo "No se logró crear el usuario<br>";
    echo $idUser."<br>";
    echo $nombre."<br>";
    echo $contraseña."<br>";
    echo $telefono."<br>";
    echo $rol."<br>";
?>