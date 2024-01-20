<?php
include('../../includes/connect.php');

session_start();
error_reporting(0);

// Redireccionar a la página principal si el usuario ya ha iniciado sesión
if (isset($_SESSION['username'])) {
    header('Location: ./../../../index.php');
}

// Procesar el formulario de registro cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newusername = $_POST['newusername'];
    $passwd = $_POST['passwd'];
    $passwd_hash = password_hash($passwd, PASSWORD_DEFAULT);

    // Verificar si el nombre de usuario ya está registrado utilizando una consulta preparada para evitar inyecciones SQL
    $check_user_query = $db->prepare("SELECT * FROM users WHERE username = ?");
    $check_user_query->bind_param('s', $newusername);
    $check_user_query->execute();
    $check_user_result = $check_user_query->get_result();

    if ($check_user_result->num_rows > 0) {
        // Mostrar mensaje de error si el usuario ya está registrado
        echo "<div id='errorPopup'>El usuario $newusername ya está registrado</div>";
    } else {
        // Insertar nuevo usuario en la tabla users utilizando una consulta preparada para evitar inyecciones SQL
        $insert_user_query = $db->prepare("INSERT INTO users(username, passwd) VALUES (?, ?)");
        $insert_user_query->bind_param('ss', $newusername, $passwd_hash);
        $insert_user_result = $insert_user_query->execute();

        if ($insert_user_result) {
            // Obtener el ID del usuario recién insertado
            $user_id = $db->insert_id;

            // Insertar información adicional en la tabla user_details, por defecto la información adicional está vacía a opción de ser completada en el panel de usuario
            $insert_details_query = $db->prepare("INSERT INTO user_details (user_id, username, name, surname, address, tel, email) VALUES (?, ?, '', '', '', '', '')");
            $insert_details_query->bind_param('is', $user_id, $newusername);
            $insert_details_result = $insert_details_query->execute();

            if ($insert_details_result) {
                // Mostrar mensaje de éxito si el usuario se registró correctamente
                echo "<div id='successPopup'>Usuario registrado correctamente</div>";
            } else {
                // Mostrar mensaje de error si hay un problema al insertar detalles del usuario
                echo "<div id='errorPopup'>Error al insertar detalles del usuario</div>";
            }

        } else {
            // Mostrar mensaje de error si hay un problema al insertar el usuario
            echo "<div id='errorPopup'>Error al insertar usuario</div>";
        }

        // Cerrar las consultas preparadas
        $check_user_query->close();
        $insert_user_query->close();
        $insert_details_query->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="https://media.discordapp.net/attachments/823245667916578857/1163558482126061719/BmbSinFondo.png?ex=65400348&is=652d8e48&hm=91cbc91a0a98f9f128dead2c98bb2d697b88f260ec061136b8c4aa54b4046870&=&width=790&height=702">
    <link rel="stylesheet" href="../../../assets/css/default.css">
    <link rel="stylesheet" href="../../../assets/css/forms.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Registro</title>
</head>

<body>
    <header>
        <div class="menu row justify-content-around">
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="../../../index.php">Inicio</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../shop.php#man">Hombre</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../shop.php#woman">Mujer</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./contact.php">Contáctanos</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./login.php">Iniciar Sesión</a>
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
            <h2 class="main-content__title col-5 col-md-2">Registro</h2>
        </div>

        <div class="row col-12 justify-content-center">
            <form class="form col-8 col-md-5 row" method="POST" action="signup.php">

                <label class="form__label" for="username">Nombre de usuario: </label>
                <input class="form__input mb-3" type="text" name="newusername" id="username" required>

                <label class="form__label" for="password">Contraseña: </label>
                <input class="form__input mb-2" minlength="8" type="password" name="passwd" id="password" required>

                <a class="form__link mb-4" href="./../password-generator.php">Genera una contraseña segura</a>

                <p class="form__text mb-4">¿Ya estás registrado? <a href="./login.php">Inicia sesión</a></p>

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

    <script src="../../../assets/js/popups.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
