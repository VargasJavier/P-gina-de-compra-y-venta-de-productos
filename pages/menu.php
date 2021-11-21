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
                    <a href="../index.php">Regresar</a>
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

            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                                $sql = "SELECT count(*) FROM productos;";
                                $resultado = $mysqli->query($sql);
                                echo $resultado->fetch_array()[0] ?? 'Hola';
                            ?>
                        </div>
                        <div class="cardName">Productos</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="eye"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                                $sql = "SELECT count(*) FROM ventas;";
                                $resultado = $mysqli->query($sql);
                                echo $resultado->fetch_array()[0] ?? 'Hola';
                            ?>
                        </div>
                        <div class="cardName">Ventas</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cart"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                                $sql = "SELECT count(*) FROM familias;";
                                $resultado = $mysqli->query($sql);
                                echo $resultado->fetch_array()[0] ?? 'Hola';
                            ?>
                        </div>
                        <div class="cardName">Familias</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="copy"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                                $sql1 = "SELECT SUM(total) FROM ventas";
                                $sql2 = "SELECT SUM(total) FROM ventas";
                                $resultadoVenta = $mysqli->query($sql1);
                                $resultadoCompra = $mysqli->query($sql2);
                                $ganancias = $resultadoVenta->fetch_array()[0] ?? 0;
                                $gastos = $resultadoVenta->fetch_array()[0] ?? 0;
                                $resultado = $ganancias - $gastos;
                                echo "$".$resultado;
                            ?>
                        </div>
                        <div class="cardName">Ganancias</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="podium"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- details list -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Productos Recientes</h2>
                        <a class="btn">View All</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Precio</td>
                                <td>Cantidad</td>
                                <td>Fecha</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $arrayStatus = array("delivered","pending","return","progress");
                                $cantidad = 0;
                                $sentence = "SELECT c.nombre nombreProducto, c.cantidad, c.precio, d.nombre nombreFamilia FROM productos c INNER JOIN familias d ON c.id = d.id;";
                                $rpta = $mysqli->query($sentence);
                                foreach($rpta as $row){
                                    echo "<tr>";
                                    echo "<td>".$row['nombreProducto']."</td>";
                                    echo "<td>$".$row['precio']."</td>";
                                    echo "<td>".$row['cantidad']."</td>";
                                    echo "<td><span class='status ".$arrayStatus[$cantidad]."'>".$row['nombreFamilia']."</span></td>";
                                    echo "</tr>";
                                    if($cantidad == 3) $cantidad = 0; else $cantidad++;
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- New Customers -->
                <?php

                    if($_SESSION['tipo'] == 1)
                        echo '<div class="recentCustomers" style="visibility: hidden;">';
                    else
                        echo '<div class="recentCustomers">';?>
                    <div class="cardHeader">
                        <h2>Usuarios</h2>
                    </div>
                    <table>
                        <?php
                            $sql = "SELECT id, nombres FROM usuarios;";
                            $resultado = $mysqli->query($sql);
                            foreach($resultado as $row){
                                echo "<tr><td width='60px'><div class='imgBx'><img src='../assets/Resources/img/image_listview.jpg' alt='Foto de usuarios'></div></td><td><h4>".$row['nombres']."<br><span>".$row['id']."</span></h4></td></tr>";
                            }
                        ?>
                        <!-- <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    <img src="../assets/Resources/slider-images/img2-2.jpg" alt="Foto de usuarios">
                                </div>
                            </td>
                            <td>
                                <h4>
                                    David<br>
                                    <span>Italy</span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../assets/Resources/slider-images/img2-2.jpg" alt="Foto de usuarios"></div>
                            </td>
                            <td>
                                <h4>David<br><span>Italy</span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../assets/Resources/slider-images/img2-2.jpg" alt="Foto de usuarios"></div>
                            </td>
                            <td>
                                
                                <h4>David<br><span>Italy</span></h4>
                            </td>
                        </tr> -->
                    </table>
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