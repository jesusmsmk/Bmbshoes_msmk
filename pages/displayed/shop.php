<?php
include('../includes/connect.php');
session_start();
error_reporting(0);

include('../includes/shcart.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Información meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="https://media.discordapp.net/attachments/823245667916578857/1163558482126061719/BmbSinFondo.png?ex=65400348&is=652d8e48&hm=91cbc91a0a98f9f128dead2c98bb2d697b88f260ec061136b8c4aa54b4046870&=&width=790&height=702">

    <!-- Título de la página -->
    <title>Tienda</title>

    <!-- Estilo CSS -->
    <link rel="stylesheet" href="../../assets/css/default.css">
    <link rel="stylesheet" href="../../assets/css/forms.css">
    <link rel="stylesheet" href="../../assets/css/shop.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Sección de encabezado -->
    <header>
        <!-- Menú -->
        <div class="menu row justify-content-around">
            <!-- Logo -->
            <img class="menu__logo col-6 col-md-1 col-sm-4 mb-4 " src="../../assets/img/BmbSinFondo.png"
                alt="BMB Shoes Logo">

            <!-- Enlaces de navegación -->
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="../../index.php">Inicio</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./shop.php">Tienda</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./forms/contact.php">Contáctanos</a>

            <!-- Estado de inicio de sesión del usuario -->
            <?php
            session_start();
            if (!$_SESSION['username']) {
                echo '<a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./forms/login.php">Iniciar Sesión</a>';
            } else {
                $username = $_SESSION['username'];
                echo "<a class='menu__link col-6 col-md-2 col-sm-6 mb-4' href='./panels/userpanel.php'>$username</a>";
            }
            ?>
        </div>
        <!-- Submenú -->
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

    <!-- Contenido principal -->
    <main class="container">
        <section class="row">
            <!-- Mostrar productos de la base de datos -->
            <?php
            foreach ($result as $product) {
            ?>
                <article class="col-6 col-sm-4 col-md-3 my-3" draggable="true">
                    <div class="card">
                        <img alt="<?php echo $product['name'] ?>" title="<?php echo $product['name'] ?>"
                            class="card-img-top" data-bs-toggle="popover" data-bs-trigger="hover"
                            data-bs-content="<?php echo $product['description'] ?>" src="<?php echo $product['image'] ?>" />
                        <div class="card-body">
                            <span><?php echo $product['name'] ?></span>
                            <h4 class="card-title"><?php echo $product['price'] ?>€</h4>
                            <form action="" method="POST">
                                <input type="hidden" name="id"
                                    value="<?php echo openssl_encrypt($product['id'], Cod, Key); ?>">
                                <input type="hidden" name="name"
                                    value="<?php echo openssl_encrypt($product['name'], Cod, Key); ?>">
                                <input type="hidden" name="price"
                                    value="<?php echo openssl_encrypt($product['price'], Cod, Key); ?>">
                                <input type="hidden" name="quantity"
                                    value="<?php echo openssl_encrypt(1, Cod, Key); ?>">
                                <button class="btn btn-primary" name="btnaction" value="Add" type="submit">Agregar al
                                    carrito</button>
                            </form>
                        </div>
                    </div>
                </article>
            <?php }; ?>
        </section>
    </main>

    <!-- Pie de página -->
    <footer class="shop-footer row justify-content-around">
        <!-- Sección de redes sociales -->
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

        <!-- Sección de ubicación -->
        <section class="footer-flex--2 col-12 col-sm-5 text-center">
            <h3 class="footer-flex--2__title">Donde puedes encontrarnos:</h3>
            <p class="footer-flex--2__ubication py-1">
                <img src="../../assets/img/pin.png" alt="Ubicación">
                Calle Consuegra, 3, 28026, Madrid
            </p>
        </section>
    </footer>

    <!-- Scripts -->
    <script src="../../assets/js/popups.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>
    <!-- Script de bootstrap para mostrar la descripción al pasar el cursor -->
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
</body>

</html>
