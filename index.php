<?php
    require './pages/conexion.php';
    session_start();
    if(isset($_SESSION['nombre'])){
        $nombrePOST = $_SESSION['nombre'];
        $nombreArray = explode(" ",$nombrePOST);
        $nombres = $nombreArray[0]." ".$nombreArray[1];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://kit.fontawesome.com/bcc14d4623.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css"/>
    <link rel="stylesheet" href="assets/CSS/slider.css"/>
    <link rel="stylesheet" href="assets/CSS/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,100;1,300&display=swap" rel="stylesheet"/>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>Catálogo web</title>
</head>

<body>
    <div class="containerPage">
        <div class="menuBar">
            <span class="iconBar">
          <img src="assets/Resources/img/logo.png" width="64px" />
        </span>
            <span class="iconBar"><ion-icon name="home-outline"></ion-icon></span>
            <span class="iconBar"><ion-icon name="shirt-outline"></ion-icon></span>
            <span class="iconBar"><ion-icon name="phone-landscape-outline"></ion-icon
        ></span>
            <span class="iconBar"><ion-icon name="desktop-outline"></ion-icon
        ></span>
        </div>
        <div class="contentPage">
            <header>
                <p id="parrafoJS">
                    Nueva Colección 2022
                    <span class="parrafo">Los mejores precios en el mismo lugar al mejor precio. Revisa nuestro catálogo para escoger entre todos los productos que tenemos para ti.</span>
                </p>
                <div class="container-slider">
                    <div class="slider" id="slider">
                        <div class="slider__section">
                            <img src="assets/Resources/slider-images/img1-2.jpg" alt="Fotografía de expendedoras" class="slider__img" />
                        </div>
                        <div class="slider__section">
                            <img src="assets/Resources/slider-images/img2-2.jpg" alt="Fotografía de suministros de oficina" class="slider__img" />
                        </div>
                        <div class="slider__section">
                            <img src="assets/Resources/slider-images/img3-2.jpg" alt="Fotografía de ropa" class="slider__img" />
                        </div>
                    </div>
                    <div class="slider__btn slider__btn--right" id="btn-right">
                        <span>&#62;</span>
                    </div>
                    <div class="slider__btn slider__btn--left" id="btn-left">
                        <span>&#60;</span>
                    </div>
                    <div class="contentHeader">
                        <div class="logoHeader">
                            <h1>Catálogo</h1>
                        </div>
                        <div class="containerHeader">
                            <ion-icon name="search-outline"></ion-icon>
                        <?php
                            if(isset($_SESSION['nombre'])){      
                                echo '<a href="./pages/menu.php">';
                                echo '<div class="contentAccess">';
                                echo '<ion-icon name="person-outline"></ion-icon>';
                                echo "<span>".$nombres."</span>";
                            }else{
                                echo '<a href="./pages/login.php">';
                                echo '<div class="contentAccess">';
                                echo '<ion-icon name="person-outline"></ion-icon>';
                                echo "<span>Acceder</span>";}
                            ?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <div class="contentHome">
                <div class="contentCategory">
                    <h2>Categorías de productos</h2>
                    <div class="contentCardCategory">
                        <div class="card">
                            <div class="contentNull"></div>
                            <div class="contentCardText">
                                <div class="contentNull"></div>
                                <div class="contentText">
                                    <span>87 productos</span>
                                    <h3>Ropa</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="contentNull"></div>
                            <div class="contentCardText">
                                <div class="contentNull"></div>
                                <div class="contentText">
                                    <span>125 productos</span>
                                    <h3>Electrodomésticos</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="contentNull"></div>
                            <div class="contentCardText">
                                <div class="contentNull"></div>
                                <div class="contentText">
                                    <span>17 productos</span>
                                    <h3>Suministro de oficinas</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="contentNull"></div>
                            <div class="contentCardText">
                                <div class="contentNull"></div>
                                <div class="contentText">
                                    <span>23 productos</span>
                                    <h3>Servicios</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contentNovedades">
                    <h2>Novedades</h2>
                    <div class="contentCardNovedades">
                        <?php
                            $sentence = "SELECT c.nombre nombreProducto, c.precio, d.nombre nombreFamilia, c.imagen, c.tipoImagen FROM productos c INNER JOIN familias d ON c.idFamilia_fk = d.id LIMIT 0,6;";
                            $rpta = $mysqli->query($sentence);
                            foreach($rpta as $row){
                                echo "<div class='cardProduct'><span class='span'>New</span>";
                                echo "<div class='contentRopa'>";
                                echo "<img src='data:".$row['tipoImagen'].";base64, ".base64_encode($row['imagen'])."' alt='Imagen del producto ".$row['nombreProducto']."'/></div>";
                                echo "<div class='contentRopaText'>";
                                echo "<span class='category'>".strtoupper($row['nombreFamilia'])."</span>";
                                echo "<h3>".$row['nombreProducto']."</h3>";
                                echo "<span class='price'>s/ ".$row['precio']."</span></div></div>";
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/JS/slider.js"></script>

</html>