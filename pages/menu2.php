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
            <li class="hovered">
                <a class="home">
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
                        echo "<li>";
                        echo '<a class="'.$arrayClass[$i].'" href="'.$arrayHref[$i].'">';
                        echo '<span class="icon"><ion-icon name="'.$arrayIcon[$i].'"></ion-icon></span>';
                        echo '<span class="title">'.$array[$i].'</span></a></li>';
                    }
                }else{
                    echo "<li>";
                    echo'<a class="shop" href="menu-ventas.php">';
                    echo '<span class="icon"><ion-icon name="cash"></ion-icon></span>';
                    echo '<span class="title">Ventas</span></a></li>'; 
                    echo "<li>";
                    echo'<a class="customer" href="menu-clientes.php">';
                    echo '<span class="icon"><ion-icon name="man-outline"></ion-icon></span>';
                    echo '<span class="title">Clientes</span></a></li>';
                }
            ?>
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
                    <a href="menu.php">Regresar</a>
                </div>
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
            <div class="contentMain">
            <div class="card">
                <h2>Configuraciones anuales</h2>
                <p style="text-align:center;">
                    Recuerda que una vez configurada, no podrás modificarla hasta terminar el año. ¡Así que cuidado!
                </p>
                <?php
                    if(isset($_REQUEST['botonSettings'])){
                        $año = date('Y');
                        $meta = $_POST['txtMeta'];
                        $comisionVendedor = $_POST['txtComisionVendedor'];
                        $porcentaje = $_POST['txtPorcentajeProductos'];
                        $sql = "INSERT INTO `configuracioncomisiones` (`año`, `importe`, `porcentajeVenta`, `porcentajeVendedor`) VALUES ($año, $meta, $comisionVendedor, $porcentaje);";
                        $resultado = $mysqli->query($sql);
                        if($resultado)
                            header("Location: menu3.php");
                        else
                            echo "Sucedió un error. Inténtalo de nuevo";
                    }
                ?>
                <form class="formSettings" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <label>Meta para vendedores</label>
                    <input type="number" name="txtMeta">
                    <label>Porcentaje de comisión</label>
                    <input type="number" name="txtComisionVendedor">
                    <label>Porcentaje de productos</label>
                    <input type="number" name="txtPorcentajeProductos">
                    <button type="submit" name="botonSettings">Modificar</button>
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