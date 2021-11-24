<?php
    require 'conexion.php';
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
                        if($i == 2){
                            echo '<li class="hovered">';
                            echo '<a class="'.$arrayClass[$i].'" href="'.$arrayHref[$i].'">';
                        }else echo '<li><a class="'.$arrayClass[$i].'" href="'.$arrayHref[$i].'">';
                        echo '<span class="icon"><ion-icon name="'.$arrayIcon[$i].'"></ion-icon></span>';
                        echo '<span class="title">'.$array[$i].'</span></a></li>';
                    }
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
                    <button id="btnNewCustomer" type="button">Registrar producto</button>

                </div>
                <div class="details">
                    <div class="recentOrders">
                        <table>
                            <thead>
                                <tr>
                                    <td>Nombre</td>
                                    <td>Cantidad</td>
                                    <td>Precio</td>
                                    <td>Familia</td>
                                    <td>Estado</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $sql = "SELECT c.nombre nombreProducto, c.cantidad, c.precio, d.nombre nombres FROM productos c INNER JOIN familias d ON c.idFamilia_fk = d.id;";
                                    $resultado = $mysqli->query($sql);
                                    foreach($resultado as $row){
                                    $status = "Disponible";
                                    $color = "delivered";
                                        if($row['cantidad'] == 0){
                                            $color = "return";
                                            $status = "No disponible";
                                        }else if($row['cantidad'] < 20){
                                            $color = "pending";
                                            $status = "Pocas unidades";
                                        }
                                        echo "<tr>";
                                        echo "<td>".$row['nombreProducto']."</td>";
                                        echo "<td>".$row['cantidad']."</td>";
                                        echo "<td>$".$row['precio']."</td>";
                                        echo "<td>".$row['nombres']."</td>";
                                        echo "<td><span class='status ".$color."'>";
                                        echo $status."</span></td>";
                                    } echo "</tr>";

                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Nombre</td>
                                    <td>Cantidad</td>
                                    <td>Precio</td>
                                    <td>Familia</td>
                                    <td>Estado</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="addCustomer">
                    <?php
                        if(isset($_POST['registrarProducto'])){
                            if($_POST['select'] != 0){
                                $nombreProducto = $_POST['txtNombre']; 
                                $precioProducto = $_POST['txtPrecio']; 
                                $familiaProducto = $_POST['select']; 
                                $binariosImagen = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
                                $tipoArchivo = $_FILES['foto']['type']; 
                                $nombreArchivo = $_FILES['foto']['name'];
                                $sql = "INSERT INTO `productos` (`nombre`, `cantidad`, `precio`,`imagen`, `tipoImagen`, `nombreImagen`, `idFamilia_fk`) VALUES ( '$nombreProducto',0,'$precioProducto','$binariosImagen','$tipoArchivo','$nombreArchivo','$familiaProducto');";
                                $resultado = $mysqli->query($sql);
                                if($resultado)
                                    echo "Registro exitoso";
                                else
                                    echo "Error en el registro";
                            }else{
                                echo "Error al registrar. Vuelve a intentarlo";
                            }
                        }
                    ?>
                    <form action="menu-productos.php" method="post" enctype="multipart/form-data">
                        <label for="">Nombre:</label><br>
                        <input type="text" name="txtNombre" id=""><br>
                        <label for="">Precio:</label><br>
                        <input type="text" name="txtPrecio" id=""><br>
                        <label for="">Imagen:</label>
                        <input type="file" name="foto" id=""><br>
                        <select name="select">
                            <?php
                                $sql = "SELECT id, nombre FROM familias;";
                                $resultado = $mysqli->query($sql);
                                echo "<option value='0'>Seleccionar familia</option>";
                                foreach($resultado as $row){
                                    echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                                } 
                            ?>
                        </select>
                        <button id="btnNewCustomer" name="registrarProducto" type="submit">Registrar</button>
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