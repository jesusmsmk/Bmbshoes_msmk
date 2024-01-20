<?php
include('../../includes/connect.php');

session_start();
error_reporting(0);

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $message = $_POST['message'];

    // Insertar los datos en la base de datos, concretamente en la tabla de contacto
    $sql = $db->query("INSERT INTO contact (name, surname, email, tel, message) VALUES ('$name', '$surname', '$email', '$tel', '$message');");

    // Verificar si la consulta se realizó con éxito
    if ($sql) {
        echo "<div id='successPopup'>Consulta enviada con éxito</div>";
    } else {
        echo "<div id='errorPopup'>Ha ocurrido un error, vuelve a intentarlo</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="icon" href="https://media.discordapp.net/attachments/823245667916578857/1163558482126061719/BmbSinFondo.png?ex=65400348&is=652d8e48&hm=91cbc91a0a98f9f128dead2c98bb2d697b88f260ec061136b8c4aa54b4046870&=&width=790&height=702">
    <link rel="stylesheet" href="../../../assets/css/default.css">
    <link rel="stylesheet" href="../../../assets/css/contact.css">
    <link rel="stylesheet" href="../../../assets/css/forms.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="menu row justify-content-around">
            <img class="menu__logo col-6 col-md-1 col-sm-4 mb-4 " src="../../../assets/img/BmbSinFondo.png" alt="BMB Shoes Logo">
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="../../../index.php">Inicio</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../shop.php#man">Hombre</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../shop.php#woman">Mujer</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./contact.php">Contáctanos</a>

            <?php
                session_start();
                if(!$_SESSION['username']) {
                    echo '<a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./login.php">Iniciar Sesión</a>';
                } else {
                    $username = $_SESSION['username'];
                    echo "<a class='menu__link col-6 col-md-2 col-sm-6 mb-4' href='./../panels/userpanel.php'>$username</a>";
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
                echo "<a href='./../panels/adminpanel.php' class='submenu__link col-12 col-md-4'>Panel de administración</a>";
            }
            ?>
            <a href="./../shopping-cart.php"
                class="submenu__link col-12 col-md-4">Carrito (<?php echo (empty($_SESSION['shcart'])) ? 0 : count($_SESSION['shcart']); ?>)
            </a>
        </div>
        <div class="ads">
    </header>
    
    <main class="main-content">

        <div class="col-12 row justify-content-center mb-3">
            <h2 class="main-content__title col-5 col-md-3">Contacta con nosotros</h2>
        </div>
            
        <div class="row col-12 justify-content-center">
            <form class="form col-8 col-md-5 row" method="POST" action="">
                <label class="form__label col-12" for="name">Nombre: </label>
                <input class="form__input col-12 mb-3" type="text" name="name" id="name" required>

                <label class="form__label col-12" for="surname">Apellidos: </label>
                <input class="form__input col-12 mb-3" type="text" name="surname" id="surname" required>

                <label class="form__label" for="email">Email: </label>
                <input class="form__input mb-2" type="text" name="email" id="email" pattern="[a-zA-Z0-9]{4,}+@[a-zA-Z0-9]{2,}+\.[a-zA-Z]{2,}" required>

                <label class="form__label" for="tel">Número de teléfono (+34): </label>
                <input class="form__input" type="text" name="tel" pattern="[0-9]{9}" id="tel" required>

                <label class="form__label" for="message">Consulta: </label>
                <textarea class="form__input mb-5" type="password" name="message" id="message" required></textarea>
            
                <input class="form__submit" type="submit" value="Enviar">
            </form>;
        </div>

    </main>
              

    <footer class="shop-footer row justify-content-around">
        <section class="footer-flex--1 col-12 col-sm-7 text-center mb-4">
            <h3 class="footer-flex--1__title">Nuestras redes sociales:</h3>
            <div class="footer-subflex row text-center justify-content-around">
                <a class="footer-flex--1__link col-4 py-1 ml-4" href="#">
                    <img src="../../../assets/img/instagram.png" alt="Instagram">
                    Instagram
                </a>
                <a class="footer-flex--1__link col-4 py-1" href="#">
                    <img src="../../../assets/img/facebook.png" alt="Facebook">
                    Facebook
                </a>
                <a class="footer-flex--1__link col-4 py-1" href="#">
                    <img src="../../../assets/img/twitter.png" alt="Twitter">
                    Twitter
                </a>
            </div>
        </section>

        <section class="footer-flex--2 col-12 col-sm-5 text-center">
            <h3 class="footer-flex--2__title">Donde puedes encontrarnos:</h3>
            <p class="footer-flex--2__ubication py-1">
                <img src="../../../assets/img/pin.png" alt="Ubicación">
                Calle Consuegra, 3, 28026, Madrid
            </p>
        </section>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
