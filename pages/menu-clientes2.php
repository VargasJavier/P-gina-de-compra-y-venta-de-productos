<?php
    require "conexion.php";
    session_start();
    if(!isset($_SESSION['nombre'])){
        header("Location: ../index.php");
    }
    $nombrePOST = $_SESSION['nombre'];
    $nombreArray = explode(" ",$nombrePOST);
    $nombres = $nombreArray[0]." ".$nombreArray[1];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/menu.css">
    <link rel="stylesheet" href="../assets/CSS/login.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <title>Menú</title>
</head>
<body>
    <div class="containerBar">
        <ul>
            <li>
                <a class="logo">
                    <span class="icon"><ion-icon name="logo-ionic"></ion-icon></span>
                    <h1 class="title-h1 title">De todos para todos</h1>
                </a>
                <hr>
            </li>
            <li>
                <a class="home" href="menu.php">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="title">Home</span>
                </a>
            </li>
            <?php
            if($_SESSION['tipo'] == 0){
                $array = array("Compras", "Clientes", "Productos", "Contraseña");
                $arrayClass = array("sales", "customer","products","password");
                $arrayIcon = array("cart-outline","man-outline","dice-outline","lock-closed-outline");
                $arrayHref = array("menu-compras.php","menu-clientes.php","menu-productos.php","menu-contraseña.php");
                for($i = 0; $i < count($array); $i++){
                    if($i == 1)
                        echo "<li class='hovered'>";
                    else echo "<li>";
                    echo '<a class="'.$arrayClass[$i].'" href="'.$arrayHref[$i].'">';
                    echo '<span class="icon"><ion-icon name="'.$arrayIcon[$i].'"></ion-icon></span>';
                    echo '<span class="title">'.$array[$i].'</span></a></li>';
                }
            }else{
                echo "<li>";
                echo'<a class="shop" href="menu-ventas.php">';
                echo '<span class="icon"><ion-icon name="cash"></ion-icon></span>';
                echo '<span class="title">Ventas</span></a></li>'; 
                echo "<li class='hovered'>";
                echo '<a class="customer" href="menu-clientes.php">';
                echo '<span class="icon"><ion-icon name="man-outline"></ion-icon></span>';
                echo '<span class="title">Clientes</span></a></li>';
            }?>
            <li>
                <a class="sign out" href="logout.php">
                    <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                    <span class="title">Salir</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Contenedor de contenedores -->
    <div class="contentContenedores main">
    <!-- main -->
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu"></ion-icon>
                </div>
                <!-- Search -->
                <div class="search">
                    <a href="../index.php">Regresar</a>
                </div>
                <!-- userImg -->
                <!-- <div class="user"> -->
                <div>
                    <div class="contentAccess" style="display: flex; align-items: center; justify-content: space-between; width: 12em;">
                    <?php
                        if(isset($_SESSION['nombre'])){
                            echo '<ion-icon name="person-outline"></ion-icon>';
                            echo "<span>".$nombres."</span>";
                        }else{
                            echo "chau";
                        }
                    ?>
                    </div>
                </div>
            </div>

            <div class="contentClientes contentClientes2">
                <div class="addCustomer card">
                    <?php
                        if(isset($_POST['registrarCliente'])){
                            $idCliente = $_POST['txtId'];
                            $nombreCliente = $_POST['txtNombre'];
                            $direccionCliente = $_POST['txtDireccion'];
                            $telefonoCliente = $_POST['txtTelefono'];
                            $redCliente = $_POST['txtRedSocial'];
                            $idTelefono = $idCliente."_".$telefonoCliente;
                            $idRed = $idCliente."_Facebook";
                            $sql = "INSERT INTO clientes VALUES ('$idCliente','$nombreCliente','$direccionCliente');";
                            $sql1 = "INSERT INTO telefonos VALUES ('$idTelefono','$telefonoCliente','$idCliente');";
                            $sql2 = "INSERT INTO redessociales VALUES ('$idRed','Facebook','$redCliente','$idCliente');";
                            $resultado = $mysqli->query($sql);
                            $resultado1 = $mysqli->query($sql1);
                            $resultado2 = $mysqli->query($sql2);
                            if($resultado && $resultado1 && $resultado2)
                                echo "Registro exitoso";
                            else
                                echo "Error en el registro";
                        }
                    ?>
                    <form action="clientesInsert.php" method="post">
                        <h2 style="text-align:center;">Registro de clientes</h2>
                        <label for="">Identificador:</label>
                        <input type="text" name="txtId">
                        <label for="">Nombre:</label>
                        <input type="text" name="txtNombre">
                        <label for="">Dirección:</label>
                        <input type="text" name="txtDireccion">
                        <label for="">Teléfono:</label>
                        <div class="contentTelefonos">
                            <input type="tel" placeholder="Teléfono 1" name="txtTelefono1"><br>
                            <input type="tel" placeholder="Opcional" name="txtTelefono2"><br>
                            <input type="tel" placeholder="Opcional" name="txtTelefono3"><br>
                        </div>
                        <label for="">Red Social:</label>
                        <div class="contentRed">
                            <select>
                                <option>Facebook</option>
                            </select>
                            <input type="text" name=""><br>
                        </div>
                        <div class="contentRed">
                            <select>
                                <option>Twitter</option>
                            </select>
                            <input type="text" name="txtRedSocial2"><br>
                        </div>
                        <div class="contentRed">
                            <select>
                                <option>Instagram</option>
                            </select>
                            <input type="text" name="txtRedSocial3"><br>
                        </div>
                        <button id="btnNewCustomer" name="registrarCliente" type="submit">Registrar</button>
                    </form>
                </div>
            </div>
  </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    // Menu Deslizable
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.containerBar');
    let main = document.querySelector('.main');

    toggle.onclick = function() {
        navigation.classList.toggle('active');
        main.classList.toggle('active');
        console.log("Prueba");
    }

    // add hovered class
    let list = document.querySelectorAll('.containerBar li');
    let li = document.querySelectorAll('.containerBar li');
    let bloque = document.querySelectorAll('.main');

    function activarLink() {
        list.forEach((item, i) =>{
            item.classList.remove('hovered'));}
        this.classList.add('hovered');
    }
    list.forEach((item) =>
        item.addEventListener('click', activarLink));

</script>


</html>