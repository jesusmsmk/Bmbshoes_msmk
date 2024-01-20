<?php


include('../includes/connect.php');
session_start();
error_reporting(0);

// Manejo de acciones sobre el carrito
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
    <title>Carrito</title>

    <!-- Estilo CSS -->
    <link rel="stylesheet" href="../../assets/css/default.css">
    <link rel="stylesheet" href="../../assets/css/forms.css">
    <link rel="stylesheet" href="../../assets/css/tables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Encabezado -->
    <header>
        <!-- Menú -->
        <div class="menu row justify-content-around">
            <!-- Logo -->
            <img class="menu__logo col-6 col-md-1 col-sm-4 mb-4 " src="../../assets/img/BmbSinFondo.png" alt="BMB Shoes Logo">

            <!-- Enlaces de navegación -->
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="../../index.php">Inicio</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./shop.php#man">Hombre</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./shop.php#woman">Mujer</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./forms/contact.php">Contáctanos</a>

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
    <main class="main-content row">
        <section class="col-12 row justify-content-center">
            <table class="main-table">
                <!-- Cabecera -->
                <thead class="thead">
                    <tr class="trow trow-main-header ">
                        <th class="thead-main-data" colspan="5">Carrito de productos</th>
                    </tr>
                </thead>
                <!-- Cuerpo -->
                <tbody class="tbody">
                    <tr class="trow trow-head">
                        <th class="thead-data">Producto</th>
                        <th class="thead-data">Cantidad</th>
                        <th class="thead-data">Precio</th>
                        <th class="thead-data">Total</th>
                        <th class="thead-data">--</th>
                    </tr>
                    <?php
                    if (empty($_SESSION['shcart'])) {
                        echo '<tr class="trow">
                                <td colspan="5" class="tdata empty">No hay productos en el carrito</td>
                            </tr>';
                    } else {
                        $total = 0;
                        foreach ($_SESSION['shcart'] as $in => $item) { ?>
                            <tr class='trow'>
                                <td class='tdata'><?php echo $item['name'] ?></td>
                                <td class='tdata'><?php echo $item['quantity'] ?></td>
                                <td class='tdata'><?php echo $item['price'] ?>€</td>
                                <td class='tdata'><?php echo number_format($item['price'] * $item['quantity'], 2) . '€' ?></td>
                                <td class='tdata'>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id"
                                            value="<?php echo openssl_encrypt($item['id'], Cod, Key); ?>">
                                        <button class='btn btn-danger' value="Delete" name="btnaction"
                                            type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            $total += $item['price'] * $item['quantity'];
                        }
                    }
                    ?>
                </tbody>
                <!-- Pie -->
                <tfoot class="tfoot">
                    <tr class="trow trow-foot">
                        <td class="tdata tdata-foot total" colspan="3">Total del carrito:</td>
                        <td class="tdata tdata-foot"><?php echo number_format($total, 2) . '€' ?></td>
                        <td class="tdata tdata-foot"></td>
                    </tr>
                </tfoot>
            </table>
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
        crossorigin="anonymous"></script>
</body>

</html>
