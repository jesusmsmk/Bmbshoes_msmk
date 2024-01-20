<?php
    session_start();
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://media.discordapp.net/attachments/823245667916578857/1163558482126061719/BmbSinFondo.png?ex=65400348&is=652d8e48&hm=91cbc91a0a98f9f128dead2c98bb2d697b88f260ec061136b8c4aa54b4046870&=&width=790&height=702">
    <title>Generador de Contraseñas</title>
    <link rel="stylesheet" href="../../assets/css/default.css">
    <link rel="stylesheet" href="../../assets/css/forms.css">
    <link rel="stylesheet" href="../../assets/css/passgen.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="menu row justify-content-around">
            <img class="menu__logo col-6 col-md-1 col-sm-4 mb-4" src="../../assets/img/BmbSinFondo.png" alt="BMB Shoes Logo">
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="../../index.php">Inicio</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./shop.php">Tienda</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./forms/contact.php">Contáctanos</a>

            <?php
                if(!$_SESSION['username']) {
                    echo '<a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./forms/login.php">Iniciar Sesión</a>';
                } else {
                    $username = $_SESSION['username'];
                    echo "<a class='menu__link col-6 col-md-2 col-sm-6 mb-4' href='./panels/userpanel.php'>$username</a>";
                }
            ?>
        </div>
        <div class="submenu row justify-content-around">
            <a href="#" class="submenu__link col-12 col-md-4">Español</a>
            <!-- Si el usuario es admin permite acceder al panel de administración -->
            <?php 
            if ($username != 'admin') {
                echo "<a href='#' class='submenu__link col-12 col-md-4'>Encontrar una tienda</a>";
            } else {
                echo "<a href='./panels/adminpanel.php' class='submenu__link col-12 col-md-4'>Panel de administración</a>";
            }
            ?>
            <a href="./shopping-cart.php"
                class="submenu__link col-12 col-md-4">Carrito (<?php echo (empty($_SESSION['shcart'])) ? 0 : count($_SESSION['shcart']); ?>)
            </a>
        </div>
        <div class="ads">
    </header>

    <main class="main-content row justify-content-center">
        <div class="col-12 row justify-content-center mb-3">
            <h2 class="main-content__title col-8 col-md-3">Generador de Contraseñas</h2>
        </div>

        <div class="row col-12 justify-content-center">
            <form class="form col-10 col-md-5 row">
                <label class="form__label" for="length">Longitud de la Contraseña:</label>
                <div class="row col-12 ml-3">
                    <input class="form__input col-4 charquantity" type="number" id="length" value="12" min="6" max="50">
                </div>
              
                <label class="form__label" for="includeUppercase">Incluir Mayúsculas:</label>
                <div>
                    <input class="form__input checkbox" type="checkbox" id="includeUppercase" checked>
                </div>
              
                <label class="form__label" for="includeNumbers">Incluir Números:</label>
                <div>
                    <input class="form__input checkbox" type="checkbox" id="includeNumbers" checked>
                </div>

                <label class="form__label" for="includeSymbols">Incluir Símbolos:</label>
                <div>
                    <input class="form__input checkbox" type="checkbox" id="includeSymbols" checked>
                </div>

                <label class="form__label result-label" for="password">Contraseña generada: </label>
                <div class="row col-12 ml-3"> 
                    <input class="form__input result-pass col-8" type="text" id="password" readonly>
                </div>

                <button class="form__submit mt-5" id="generateBtn" type="button">Generar Contraseña</button>
                <button class="form__submit mt-5" id="copyBtn" type="button">Copiar Contraseña</button>
              
                <a class="form__link mt-3" href="./forms/signup.php">Volver al registro</a>
            </form>
        </div>
    </main>

    <div id="successPopup" style="display:none;">Contraseña copiada con éxito</div>

    <footer class="shop-footer row justify-content-around">
        <section class="footer-flex--1 col-12 col-sm-7 text-center mb-4">
            <h3 class="footer-flex--1__title">Nuestras redes sociales:</h3>
            <div class="footer-subflex row text-center justify-content-around">
                <a class="footer-flex--1__link col-4 py-1 ml-4" href="#">
                    <img src="../../assets/img/instagram.png" alt="Instagram">
                    Instagram
                </a>
                <a class="footer-flex--1__link col-4 py-1" href="#">
                    <img src="../../assets/img/facebook.png" alt="Facebook">
                    Facebook
                </a>
                <a class="footer-flex--1__link col-4 py-1" href="#">
                    <img src="../../assets/img/twitter.png" alt="Twitter">
                    Twitter
                </a>
            </div>
        </section>

        <section class="footer-flex--2 col-12 col-sm-5 text-center">
            <h3 class="footer-flex--2__title">Donde puedes encontrarnos:</h3>
            <p class="footer-flex--2__ubication py-1">
                <img src="../../assets/img/pin.png" alt="Ubicación">
                Calle Consuegra, 3, 28026, Madrid
            </p>
        </section>
    </footer>

    <!-- Script de generación de contraseñas -->
    <script src="../../assets/js/passgen.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
