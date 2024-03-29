<?php
    require "conexion.php";
    session_start();
    if(!isset($_SESSION['nombre'])){
        header("Location: ../index.php");
    }
    $nombrePOST = $_SESSION['nombre'];
    $contraseña = $_SESSION['password'];
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
                        if($i == 3){
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
        <div class="contentMain">
            <div class="card">
                <h2>Modificar contraseña</h2>
                <?php
                    if(isset($_REQUEST['botonPassword'])){
                        $contraseñaPOST = $_POST['contraseñaActual'];
                        if($contraseña == $contraseñaPOST){
                            $contraseñaNueva = $_POST['nuevaContraseña'];
                            $id = $_POST['select'];
                            $sql = "UPDATE usuarios SET contraseña='".$contraseñaNueva."' WHERE id = '$id'";
                            $resultado = $mysqli->query($sql);
                            if($resultado){
                                echo "Contraseña modificada";   
                                $_SESSION['password'] = $contraseñaNueva;
                            }else{
                                echo "No se pudo modificar. Intente nuevamente";
                            }
                        }else{
                            echo "Su contraseña actual no coincide. Vuelva a intentarlo 1".$contraseña." 2".$contraseñaPOST;
                        }
                    }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <br><select name="select">
                        <?php
                            $sql = "SELECT id, nombres FROM usuarios;";
                            $resultado = $mysqli->query($sql);
                            echo "<option value='0'>Seleccionar cuenta</option>";
                            foreach($resultado as $row){
                                echo "<option value='".$row['id']."'>".$row['nombres']."</option>";
                            } 
                        ?>
                    </select><br>
                    <input type="password" name="contraseñaActual" placeholder="Ingrese su contraseña actual"><br>
                    <input type="password" name="nuevaContraseña" placeholder="Ingrese su nueva contraseña"><br>
                    <div class="contentButtonsVenta">
                        <a id="btnNewCustomer" class="addCustomerButton" href="menu-contraseña2.php">Registrar usuario</a>
                        <button style="padding: 0 2em;" type="submit" name="botonPassword">Modificar</button>
                    </div>
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