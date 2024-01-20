<?php
include('../../includes/connect.php');

session_start();
error_reporting(0);

// Redireccionar si el usuario ya ha iniciado sesión
if (isset($_SESSION['username'])) {
    header('Location: ./../../../index.php');
}

// Verificar el método de la petición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nombre de usuario y la contraseña introducidos en el formulario
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    // Consultar si el usuario existe en la base de datos utilizando una consulta preparada para evitar inyecciones sql
    $check_user_query = $db->prepare("SELECT * FROM users WHERE username = ?");
    $check_user_query->bind_param('s', $username);
    $check_user_query->execute();
    $check_user_result = $check_user_query->get_result();

    if ($check_user_result->num_rows > 0) {
        // Obtener el hash de la contraseña almacenada en la base de datos
        $passwd_hash_query = $db->prepare("SELECT passwd FROM users WHERE username = ?");
        $passwd_hash_query->bind_param('s', $username);
        $passwd_hash_query->execute();
        $passwd_hash_result = $passwd_hash_query->get_result()->fetch_assoc();

        // Verificar la contraseña ingresada con el hash almacenado
        if ($passwd_hash_result && password_verify($passwd, $passwd_hash_result['passwd'])) {
            // Establecer la sesión y redirigir a la página principal
            $_SESSION['username'] = $username;

            echo "<div id='successPopup'>Has iniciado sesión con el usuario $username</div>";

            echo "<script>
                setTimeout(function(){
                    window.location.href = '../../../index.php';
                }, 2000); 
               </script>";
        } else {
            echo "<div id='errorPopup'>Contraseña incorrecta</div>";
        }
    } else {
        echo "<div id='errorPopup'>El usuario $username no existe</div>";
    }

    // Cerrar las consultas preparadas
    $check_user_query->close();
    $passwd_hash_query->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://media.discordapp.net/attachments/823245667916578857/1163558482126061719/BmbSinFondo.png?ex=65400348&is=652d8e48&hm=91cbc91a0a98f9f128dead2c98bb2d697b88f260ec061136b8c4aa54b4046870&=&width=790&height=702">
    <link rel="stylesheet" href="../../../assets/css/default.css">
    <link rel="stylesheet" href="../../../assets/css/forms.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Inicio de Sesión</title>
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

    <main class="main-content row justify-content-center">
            
        <div class="col-12 row justify-content-center mb-3">
            <h2 class="main-content__title col-5 col-md-2">Iniciar Sesión</h2>
        </div>
            
        <div class="row col-12 justify-content-center">
            <form class="form col-8 col-md-5 row" method="POST" action="login.php" id="registrationForm">
                <label class="form__label col-12" for="username">Nombre de usuario: </label>
                <input class="form__input col-12 mb-3" type="text" name="username" id="username" required>

                <label class="form__label" for="password">Contraseña: </label>
                <input class="form__input mb-2" type="password" name="passwd" id="password" required>
            
                <p class="form__text mb-4">¿No estás registrado aún? <a href="./signup.php">Regístrate</a></p>
            
                <input class="form__submit" type="submit" value="Enviar">
            </form>
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
    <script src="../../../assets/js/popups.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
