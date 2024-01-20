<?php
    // Se incluye el archivo connect.php para establecer la conexión con la base de datos
    include('../../includes/connect.php');

    // Se recupera la sesión
    session_start();
    error_reporting(0);

    // Si el usuario no ha iniciado sesión, se redirige a la página de inicio
    if (!isset($_SESSION['username'])) {
        header('Location: ./../../../index.php');
    }

    // Se obtiene el nombre de usuario de la sesión
    $username = $_SESSION['username'];

    // Se realiza una consulta JOIN para obtener la información del usuario y sus detalles procedente de ambas tablas relacionadas con el usuario
    $sql = $db->query("SELECT u.*, ud.* FROM users u LEFT JOIN user_details ud ON u.id = ud.user_id WHERE u.username='$username'");
    $result = $sql->fetch_assoc();

    // Se almacena el id en una variable
    $user_id = $result['id'];

    // Se verifica que la petición sea POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Se obtienen los datos del formulario
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];
        $newpasswd = $_POST['newpasswd'];

        // Variable para controlar errores
        $error = false;

        // Se verifica que la contraseña no esté vacía para realizar el cambio de esta
        if (!empty($passwd)) {
            // Se verifica que la contraseña ingresada coincida con la almacenada
            if (password_verify($passwd, $result['u.passwd'])) {
                // Se hashea y actualiza la nueva contraseña en la base de datos
                $passwd_hash = password_hash($newpasswd, PASSWORD_DEFAULT);

                $update_sql = "UPDATE users SET passwd = '$passwd_hash' WHERE id='$user_id'";
                $update_result = $db->query($update_sql);

                // Se muestra un mensaje según el resultado de la actualización
                if (!$update_result) {
                    echo "<div id='errorPopup'>La contraseña no se ha modificado correctamente</div>"; 
                } else {
                    echo "<div id='successPopup'>La contraseña se ha modificado correctamente</div>";
                }
            } else {
                echo "<div id='errorPopup'>La contraseña no es correcta</div>";
                $error = true;
            }
        }

        // Si no hay errores, se actualizan los detalles del usuario
        if($error == false) {
            $update_sql = "UPDATE user_details SET name='$name', surname='$surname', address='$address', tel='$tel', email='$email' WHERE user_id=$user_id;";
            $update_result = $db->query($update_sql);

            // Se muestra un mensaje de éxito y se redirige después de medio segundo
            echo "<div id='successPopup'>Datos modificados con éxito</div>"; 
            echo "<script>
                    setTimeout(function(){
                        window.location.href = 'userpanel.php';
                    }, 500); 
                </script>";
        }
        
    }

    if(isset($_GET['action'])) {
        if($_GET['action'] === 'exit') {
            session_destroy();

            echo "<div id='successPopup'>Has cerraco sesión con éxito</div>"; 

            echo "<script>
                    setTimeout(function(){
                        window.location.href = '../../../index.php';
                    }, 2000); 
                </script>";
        } else if($_GET['action'] === 'deluser') {
            
            $sql_delete_user_details = "DELETE FROM user_details WHERE user_id = $user_id";
            $result_delete_user_details = $db->query($sql_delete_user_details);
            
            $sql_delete_user = "DELETE FROM users WHERE id = $user_id";
            $result_delete_user = $db->query($sql_delete_user);

            if($result_delete_user_details && $result_delete_user) {
                session_destroy();
                echo "<div id='successPopup'>Has eliminado tu usuario con éxito</div>"; 

                echo "<script>
                        setTimeout(function(){
                            window.location.href = '../../../index.php';
                        }, 2000); 
                    </script>";
            } else {
                echo "<div id='errorPopup'>No se ha podido eliminar tu usuario</div>"; 
            }

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://media.discordapp.net/attachments/823245667916578857/1163558482126061719/BmbSinFondo.png?ex=65400348&is=652d8e48&hm=91cbc91a0a98f9f128dead2c98bb2d697b88f260ec061136b8c4aa54b4046870&=&width=790&height=702">
    <link rel="stylesheet" href="../../../assets/css/default.css">
    <link rel="stylesheet" href="../../../assets/css/forms.css">
    <link rel="stylesheet" href="../../../assets/css/userpanel.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Panel de usuario</title>
</head>
<body>
    <header>
        <div class="menu row justify-content-around">
            <img class="menu__logo col-6 col-md-1 col-sm-4 mb-4 " src="../../../assets/img/BmbSinFondo.png" alt="BMB Shoes Logo">
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="../../../index.php">Inicio</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../shop.php#man">Hombre</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../shop.php#woman">Mujer</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../forms/contact.php">Contáctanos</a>

            <?php
                session_start();
                if (!$_SESSION['username']) {
                    echo '<a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../forms/login.php">Iniciar Sesión</a>';
                } else {
                    $username = $_SESSION['username'];
                    echo "<a class='menu__link col-6 col-md-2 col-sm-6 mb-4' href='./userpanel.php'>$username</a>";
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
                echo "<a href='./adminpanel.php' class='submenu__link col-12 col-md-4'>Panel de administración</a>";
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
        <h2 class="main-content__title col-5 col-md-2">Panel de usuario</h2>
    </div>

    <div class="row col-12 justify-content-center">
    <!-- Panel de información del usuario -->
    <form class="form col-8 col-md-4 row" method="POST" action="userpanel.php">
    <fieldset class="form__fieldset">
        <legend class="form__legend">Información de usuario</legend>

        <!-- Campo de nombre de usuario el cual no es modificable-->
        <label class="form__label" for="username">Nombre de usuario: </label>
        <input class="form__input username" type="text" name="username" id="username" value='<?php echo $result['username'] ?>' readonly required>
    
        <!-- Campos para la información personal del usuario -->
        <label class="form__label" for="name">Nombre: </label>
        <input class="form__input" type="text" name="name" id="name" value="<?php echo $result['name']; ?>" required>

        <label class="form__label" for="surname">Apellidos: </label>
        <input class="form__input" type="text" name="surname" id="surname" value="<?php echo $result['surname']; ?>" required>

        <label class="form__label" for="address">Dirección: </label>
        <input class="form__input" type="text" name="address" id="address" value="<?php echo $result['address']; ?>" required>

        <label class="form__label" for="tel">Teléfono (+34): </label>
        <input class="form__input" maxlength="9" pattern="[0-9]{9}" type="text" name="tel" id="tel" value="<?php echo $result['tel']; ?>" required>

        <label class="form__label" for="email" pattern="[a-zA-Z0-9]{4,}+@[a-zA-Z0-9]{2,}+\.[a-zA-Z]{2,}">Correo electrónico: </label>
        <input class="form__input" type="text" name="email" id="email" value="<?php echo $result['email']; ?>" required>
    </fieldset>

    <hr>

    <fieldset class="form__fieldset">
        <legend class="form__legend">Modificar contraseña: </legend>

        <!-- Campo para la contraseña actual -->
        <label class="form__label" for="passwd">Contraseña actual: </label>
        <input class="form__input" type="password" name="passwd" id="passwd">

        <!-- Campo para la nueva contraseña -->
        <label class="form__label" for="newpasswd">Nueva contraseña: </label>
        <input class="form__input" minlength="8" type="password" name="newpasswd" id="newpasswd">
    </fieldset>
    
    <hr>

    <div class="row col-12 justify-content-center">
        <!-- Enlaces para cerrar sesión y eliminar usuario los cuales funcionan mediante una petición get-->
        <a class="form__action action-first col-5" href="userpanel.php?action=exit">Cerrar sesión</a>

        <a class="form__action col-6" href="userpanel.php?action=deluser">Eliminar usuario</a>
    </div>

    <!-- Botón para guardar cambios -->
    <input class="form__submit mt-5" type="submit" value="Guardar">
</form>
    </div>
</main>

<footer class="shop-footer row justify-content-around">
    <!-- Sección de redes sociales -->
    <section class="footer-flex--1 col-12 col-sm-7 text-center mb-4">
        <h3 class="footer-flex--1__title">Nuestras redes sociales:</h3>
        <div class="footer-subflex row text-center justify-content-around">
            <!-- Enlaces a las redes sociales -->
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

    <!-- Sección de ubicación -->
    <section class="footer-flex--2 col-12 col-sm-5 text-center">
        <h3 class="footer-flex--2__title">Donde puedes encontrarnos:</h3>
        <!-- Información de ubicación -->
        <p class="footer-flex--2__ubication py-1">
            <img src="../../../assets/img/pin.png" alt="Ubicación">
            Calle Consuegra, 3, 28026, Madrid
        </p>
    </section>
</footer>

<!-- Scripts de JavaScript -->
<script src="../../../assets/js/popups.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
