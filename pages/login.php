<?php

  require "conexion.php";
  session_start();

  if($_POST){
    // Name agregado en los input
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT id_usuario, nombres, contraseña, tipo_usuario   FROM usuario WHERE id_usuario = '$usuario'";
    $resultado = $mysqli->query($sql);
    $num = $resultado->num_rows;
    
    if($num>0){
      $row = $resultado->fetch_assoc();
      $password_bd = $row['contraseña'];
      // $pass_c = sha1($password);

      if($password_bd == $password){
        $_SESSION['id'] = $row['id_usuario'];
        $_SESSION['nombre'] = $row['nombres'];
        $_SESSION['tipo'] = $row['tipo_usuario'];
        $_SESSION['password'] = $row['contraseña'];
        header("Location: ../index.php");
      }else{
        echo "La contraseña no coincide";
        echo " ".$password_bd." ".$pass_c;
      }
    }else{
      echo "No existe el usuario";
    }

  }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/CSS/login.css">
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
  <title>Login</title>
</head>
<body>
  <div class="containerLogin">
    <div class="containerInput">
      <div class="contentHeader">
        <h1>Login</h1>
        <p>Si no tienes una cuenta, regresa a nuestro catálogo <a href="../">aquí</a></p>
      </div>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label>Email*</label>
        <input name="usuario" type="text" placeholder="Ingrese su usuario">
        <label>Password*</label>
        <input name="password" type="password" placeholder="Ingrese su contraseña">
        <div class="contentPassword">
          <a href="./remember.html">¿Olvidé la contraseña?</a>
        </div>
        <button type="submit" class="btnLogin">Login</button>
      </form>
      <footer>
        <p>©De todo para todos All Rights reserved</p>
      </footer>
    </div>
    <div class="containerDesign">
      <img class="top_left" src="../assets/Resources/login-images/top_left.svg">
      <img class="bottom_right" src="../assets/Resources/login-images/bottom_right.svg">
      <img class="design_circle" src="../assets/Resources/login-images/design-circle.svg">
      <img class="design_points" src="../assets/Resources/login-images/design-points.svg">
      <img class="design_center" src="../assets/Resources/login-images/desing-center.svg">
      <div class="cardTop">
        
      </div>
      <div class="cardBottom">

      </div>
      <div class="circlePig circle"><img width="52" height="52" src="../assets/Resources/login-images/ahorrar-dinero.png"></div>
      <div class="circleShop circle"><img width="52" height="52" src="../assets/Resources/login-images/shop.png"></div>
      <div class="circleSecurity circle"><img width="64" height="64" src="../assets/Resources/login-images/proteger.png"></div>
    </div>
  </div>
</body>
</html>