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

            <div class="contentClientes">
                <div class="contentButtonCustomer">
                    <button id="btnNewCustomer" type="button">Registrar cliente</button>

                </div>
                <div class="details">
                    <div class="recentOrders">
                        <table>
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Dirección</td>
                                    <td>Teléfono</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //SELECT c.id_cliente,nombre, COUNT(*) as c_compras FROM cliente c INNER JOIN venta d ON c.id_cliente = d.id_cliente GROUP BY c.id_cliente ORDER BY c_compras DESC;
                                    $sql = "SELECT c.id, c.nombres,c.direccion, d.telefono FROM clientes c INNER JOIN telefonos d ON c.id = d.idCliente_fk;";
                                    $resultado = $mysqli->query($sql);
                                    $nombres = "Hola";
                                    foreach($resultado as $row){
                                        if($row['id'] == $nombres) continue;
                                        echo "<tr>";
                                        echo "<td>".$row['id']."</td>";
                                        echo "<td>".$row['nombres']."</td>";
                                        echo "<td>".$row['direccion']."</td>";
                                        echo "<td>".$row['telefono']."</td>";
                                        $nombres = $row['id'];
                                    } echo "</tr>";

                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Teléfono</td>
                                    <td>N° Compras</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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