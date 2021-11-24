<?php
  require 'conexion.php';
  session_start();

  $idCliente = $_POST['txtId'];
  $nombreCliente = $_POST['txtNombre'];
  $direccionCliente = $_POST['txtDireccion'];
  $telefonoCliente1 = $_POST['txtTelefono1'];
  $telefonoCliente2 = $_POST['txtTelefono2'];
  $telefonoCliente3 = $_POST['txtTelefono3'];
  $redSocialCliente1 = $_POST['txtRedSocial1'];
  $redSocialCliente2 = $_POST['txtRedSocial2'];
  $redSocialCliente3 = $_POST['txtRedSocial3'];
  
  $sql = "INSERT INTO `clientes` (`id`, `nombres`, `direccion`) VALUES ('$idCliente', '$nombreCliente', '$direccionCliente')";
  $resultado = $mysqli->query($sql);
  $idTelefono = $idCliente."_".$telefonoCliente1;
  $sqlTelefono = "INSERT INTO `telefonos` (`id`, `telefono`, `idCliente_fk`) VALUES ('$idTelefono', '$telefonoCliente1', '$idCliente')";
  $resultadoTelefono1 = $mysqli->query($sqlTelefono);
  $idTelefono = $idCliente."_".$telefonoCliente2;
  if(!empty($telefonoCliente2)){
    $sqlTelefono2 = "INSERT INTO `telefonos` (`id`, `telefono`, `idCliente_fk`) VALUES ('$idTelefono', '$telefonoCliente2', '$idCliente')";
    $resultadoTelefono2 = $mysqli->query($sqlTelefono2);
  }
  $idTelefono = $idCliente."_".$telefonoCliente3;
  if(!empty($telefonoCliente3)){
    $sqlTelefono3 = "INSERT INTO `telefonos` (`id`, `telefono`, `idCliente_fk`) VALUES ('$idTelefono', '$telefonoCliente3', '$idCliente')";
    $resultadoTelefono2 = $mysqli->query($sqlTelefono3);
  }
  $idRedSocial = $idCliente."_Facebook";
  $sqlRedSocial = "INSERT INTO `redessociales` (`id`, `nombre`, `usuario`, `idCliente_fk`) VALUES ('$idRedSocial', 'Facebook', '$redSocialCliente1', '$idCliente')";
  $resultadoRed1 = $mysqli->query($sqlRedSocial);
  $idRedSocial = $idCliente."_Twitter";
  if(!empty($redSocialCliente2)){
    $resultadoRed2 = "INSERT INTO `redessociales` (`id`, `nombre`, `usuario`, `idCliente_fk`) VALUES ('$idRedSocial', 'Twitter', '$redSocialCliente2', '$idCliente')";
    $resultadoRedFinal2 = $mysqli->query($resultadoRed2);
  }
  $idRedSocial = $idCliente."_Instagram";
  if(!empty($redSocialCliente3)){
    $resultadoRed3 = "INSERT INTO `redessociales` (`id`, `nombre`, `usuario`, `idCliente_fk`) VALUES ('$idRedSocial', 'Instagram', '$redSocialCliente3', '$idCliente')";
    $resultadoRedFinal3 = $mysqli->query($resultadoRed3);
  }
  if($resultado){
    header("Location: menu-clientes.php");
  }
  else{
    // header("Location: menu.php");
    echo "malardo";
  }
?>