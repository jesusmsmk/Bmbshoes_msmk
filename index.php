<?php
    session_start(); // Se reanuda la sesión abierta
    error_reporting(0); // Desactiva la aparición de errores en pantalla
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Encabezado -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMB Sneakers</title>
    <!-- Ícono de la página -->
    <link rel="icon" href="https://media.discordapp.net/attachments/823245667916578857/1163558482126061719/BmbSinFondo.png?ex=65400348&is=652d8e48&hm=91cbc91a0a98f9f128dead2c98bb2d697b88f260ec061136b8c4aa54b4046870&=&width=790&height=702">
    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;1,900&display=swap" rel="stylesheet">
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="./assets/css/default.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <!-- Encabezado de la página -->
    <header>
        <!-- Menú principal -->
        <div class="menu row justify-content-around">
            <!-- Logo -->
            <img class="menu__logo col-6 col-md-1 col-sm-4 mb-4" src="./assets/img/BmbSinFondo.png" alt="BMB Shoes Logo">
            <!-- Enlaces del menú -->
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./index.php">Inicio</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./pages/displayed/shop.php#man">Hombre</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./pages/displayed/shop.php#woman">Mujer</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./pages/displayed/contact.php">Contáctanos</a>
            <?php
                // Verificación de si el usuario ha iniciado sesión para mostrarte un elemento u otro
                session_start();
                if(!$_SESSION['username']) {
                    echo '<a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./pages/displayed/forms/login.php">Iniciar Sesión</a>';
                } else {
                    $username = $_SESSION['username'];
                    echo "<a class='menu__link col-6 col-md-2 col-sm-6 mb-4' href='./pages/displayed/panels/userpanel.php'>$username</a>";
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
                echo "<a href='./pages/displayed/panels/adminpanel.php' class='submenu__link col-12 col-md-4'>Panel de administración</a>";
            }
            ?>
            <a href="./pages/displayed/shopping-cart.php"
                class="submenu__link col-12 col-md-4">Carrito (<?php echo (empty($_SESSION['shcart'])) ? 0 : count($_SESSION['shcart']); ?>)
            </a>
        </div>
        <div class="ads">
    </header>

    <!-- Contenido principal -->
    <main>
        <!-- Sección de collage -->
        <section class="collage row justify-content-around">
            <!-- Artículo principal del collage -->
            <article class="collage__article--main col-12">
                <h2 class="collage__article--main__title">Es hora de moverse</h2>
                <a class="collage__article--main__link" href="./pages/displayed/shop.php">Comprar Ahora</a>
            </article>
       
            <!-- Otros artículos del collage -->
            <article class="collage__article col-4">
                <!-- Imagen de baloncesto -->
                <img class="collage__article__img" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_14_08_fl_onl_back_2_sport_ecom_activation/05_final_output_files/ecom_look_2/spain/2023_14_08_ONL_FL_BacktoSport_Spain_Look2_TBBasketball_1600x1600_F.jpg" width="100%" alt="">
                <h2 class="collage__article__title" >Baloncesto</h2>
                <a class="collage__article__link" href="./pages/displayed/shop.php">Comprar ahora</a>
            </article> 

            <article class="collage__article col-4">
                <!-- Imagen de colección de fútbol -->
                <img class="collage__article__img" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_14_08_fl_onl_back_2_sport_ecom_activation/05_final_output_files/ecom_look_2/spain/2023_14_08_ONL_FL_BacktoSport_Spain_Look2_TBFootball_1600x1600_F.jpg" width="100%" alt="">
                <h2 class="collage__article__title">Colección de fútbol</h2>
                <a class="collage__article__link" href="./pages/displayed/shop.php">Comprar ahora</a>
            </article>

            <article class="collage__article col-4">
                <!-- Imagen de correr con estilo -->
                <img class="collage__article__img" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_14_08_fl_onl_back_2_sport_ecom_activation/05_final_output_files/ecom_look_2/spain/2023_14_08_ONL_FL_BacktoSport_Spain_Look2_TBRunTrain_1600x1600_F.jpg" width="100%" alt="">
                <h2 class="collage__article__title">Correr con estilo</h2>
                <a class="collage__article__link" href="./pages/displayed/shop.php">Comprar ahora</a>
            </article>

        </section>

        <!-- Sección de marcas -->
        <section class="brands-container row justify-content-around mb-4">
            <a class="brands-container__link col-12 col-sm-3 mr-3" href="./pages/displayed/shop.php">
                <img src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2021/2021_06_035_onl_new_hp_layout/04_final_output_files/2021_06_035_ONL_Nike_bar_800x280.jpg#" alt="">
            </a>
            <a class="brands-container__link col-12 col-sm-3 mr-3" href="./pages/displayed/shop.php">
                <img src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2022/fl_ecom_hp_brand_bar/05_final_output_files/2023_04_20_FL_HP_Redesign_ADIDAS_Logo_Design.jpg" alt="">
            </a>
            <a class="brands-container__link col-12 col-sm-3 mr-3" href="./pages/displayed/shop.php">
                <img src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2021/2021_06_035_onl_new_hp_layout/04_final_output_files/2021_06_035_ONL_Nike_bar_800x280.jpg#" alt="">
            </a>
            <a class="brands-container__link col-12 col-sm-3 mr-3" href="./pages/displayed/shop.php">
                <img src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2021/2021_06_035_onl_new_hp_layout/04_final_output_files/Converse_Primary_logo_bar_800x280.jpg" alt="">
            </a>
            <a class="brands-container__link col-12 col-sm-3 mr-3" href="./pages/displayed/shop.php">
                <img src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2022/fl_ecom_hp_brand_bar/05_final_output_files/FL_ECOM_HP_Brand_Asics_bar_800x280.jpg" alt="">
            </a>
            <a class="brands-container__link col-12 col-sm-3 mr-3" href="./pages/displayed/shop.php">
                <img src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2021/2021_06_035_onl_new_hp_layout/04_final_output_files/2021_06_035_ONL_all_brands_bar_es_800x280.jpg#" alt="">
            </a>
        </section>

        <!-- Sección de productos destacados -->
        <section class="trending">
            <div class="trending__container">
                <h2 class="trending__container__title">DISPONIBLE DE NUEVO: AIR FORCE 1</h2>
                <a class="trending__container__link" href="#">COMPRAR AHORA ></a>
            </div>
        </section>

        <!-- Sección de productos favoritos -->
        <section class="favorite">
            <h2 class="favorite__title">FAVORITO BMB SHOES</h2>
            <div class="favorite-grid row text-center justify-content-around">
                <article class="favorite-grid__article col-12 col-md-3 mx-1">
                    <img class="favorite-grid__article__img" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/vendor-stories/2023/puma/2023_10_12_puma_exote/2023_10_12_PUMA_EXOTEK_HP_Banner_V2.jpg" width="100%" alt="Puma Exotec">
                    <h3 class="favorite-grid__article__title" >Puma Exotec</h3>
                    <a class="favorite-grid__article__link" href="./pages/displayed/shop.php">Comprar ahora</a>
                </article> 
    
                <article class="favorite-grid__article col-12 col-md-3 mx-1">
                    <img class="favorite-grid__article__img" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_10_16_fl_omn_on_aw23_campaign-/05_final_output_files/ecom/2023_10_16_FL_OMN_ON_Ecom_HPbutton02_1600x1600.jpg" width="100%" alt="On Cloudnova">
                    <h3 class="favorite-grid__article__title">On Cloudnova</h3>
                    <a class="favorite-grid__article__link" href="./pages/displayed/shop.php">Comprar ahora</a>
                </article>
    
                <article class="favorite-grid__article col-12 col-md-3 mx-1">
                    <img class="favorite-grid__article__img" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/vendor-stories/2023/new_era/2023_10_12_onl_new_era_mlb/HP_button.jpg" width="100%" alt="New Era">
                    <h3 class="favorite-grid__article__title">New Era</h3>
                    <a class="favorite-grid__article__link" href="./pages/displayed/shop.php">Comprar ahora</a>
                </article>
            </div>
        </section>

        <!-- Sección de inspiración -->
        <section class="inspiration">
            <h2 class="inspiration__title">GET INSPIRED</h2>
            <div class="inspiration-grid row text-center justify-content-around">
                <article class="inspiration-grid__article col-12 col-md-3 mx-1">
                    <img class="inspiration-grid__article__img" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_07_25_fl_omn_winterized/05_final_output_files/ecom/HPbutton_Winterized-Campaign-800x800_1c.jpg" width="100%" alt="Sorteo Napapijiri">
                    <h3 class="inspiration-grid__article__title" >Sorteo Napapijiri</h3>
                    <a class="inspiration-grid__article__link" href="./pages/displayed/shop.php">Únete Gratis</a>
                </article> 
    
                <article class="inspiration-grid__article col-12 col-md-3 mx-1">
                    <img class="inspiration-grid__article__img" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_07_25_fl_omn_winterized/05_final_output_files/ecom/HPbutton_Winterized-Campaign-800x800_1a.jpg" width="100%" alt="Timberland">
                    <h3 class="inspiration-grid__article__title">Timberland</h3>
                    <a class="inspiration-grid__article__link" href="./pages/displayed/shop.php">Comprar ahora</a>
                </article>
    
                <article class="inspiration-grid__article col-12 col-md-3 mx-1">
                    <img class="inspiration-grid__article__img" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_07_25_fl_omn_winterized/05_final_output_files/ecom/HPbutton_Winterized-Campaign-800x800_1b.jpg" width="100%" alt="Ugg">
                    <h3 class="inspiration-grid__article__title">Ugg</h3>
                    <a class="inspiration-grid__article__link" href="./pages/displayed/shop.php">Más Información</a>
                </article>
            </div>
        </section>


    <section class="category container">
    <h2 class="category__title text-center mb-4">COMPRAR POR CATEGORÍA</h2>

    <div class="row">
        <!-- Hombre -->
        <div class="col-6 col-md-4 col-lg-2 mb-4">
            <div class="card">
                <a href="#">
                    <img class="card-img-top" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_05_09_fl_omn_certifiedclassics/05_final_output_files/ecom/category/2023_05_09_FL_OMN_CertifiedClassics_MEN_EN_HP_Button_800x800.jpg" alt="Hombre">
                </a>
                <div class="card-body text-center">
                    <h3 class="card-title">Hombre</h3>
                </div>
            </div>
        </div>

        <!-- Mujer -->
        <div class="col-6 col-md-4 col-lg-2 mb-4">
            <div class="card">
                <a href="#">
                    <img class="card-img-top" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_05_09_fl_omn_certifiedclassics/05_final_output_files/ecom/category/2023_05_09_FL_OMN_CertifiedClassics_HP_Button_GENDER_Women_A_800x800.jpg" alt="Mujer">
                </a>
                <div class="card-body text-center">
                    <h3 class="card-title">Mujer</h3>
                </div>
            </div>
        </div>

        <!-- Niños -->
        <div class="col-6 col-md-4 col-lg-2 mb-4">
            <div class="card">
                <a href="#">
                    <img class="card-img-top" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_05_09_fl_omn_certifiedclassics/05_final_output_files/ecom/category/2023_05_09_FL_OMN_CertifiedClassics_KIDS_EN_HP_Button_800x800.jpg" alt="Niños">
                </a>
                <div class="card-body text-center">
                    <h3 class="card-title">Niños</h3>
                </div>
            </div>
        </div>

        <!-- Artículos más vendidos -->
        <div class="col-6 col-md-4 col-lg-2 mb-4">
            <div class="card">
                <a href="#">
                    <img class="card-img-top" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_05_09_fl_omn_certifiedclassics/05_final_output_files/ecom/category/2023_05_09_FL_OMN_CertifiedClassics_HP_Button_BESTSELLERS_GIF_800x800.gif" alt="Artículos más vendidos">
                </a>
                <div class="card-body text-center">
                    <h3 class="card-title">Artículos más vendidos</h3>
                </div>
            </div>
        </div>

        <!-- Solo en BMB Shoes -->
        <div class="col-6 col-md-4 col-lg-2 mb-4">
            <div class="card">
                <a href="#">
                    <img class="card-img-top" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_05_09_fl_omn_certifiedclassics/05_final_output_files/ecom/category/2023_05_09_FL_OMN_CertifiedClassics_LAUNCHES_EN_HP_Button_800x800.jpg" alt="Solo en BMB Shoes">
                </a>
                <div class="card-body text-center">
                    <h3 class="card-title">Solo en BMB Shoes</h3>
                </div>
            </div>
        </div>

        <!-- Novedades -->
        <div class="col-6 col-md-4 col-lg-2 mb-4">
            <div class="card">
                <a href="#">
                    <img class="card-img-top" src="https://images.footlocker.com/content/dam/final/footlockereurope/Online_activations/fl-campaign/2023/2023_05_09_fl_omn_certifiedclassics/05_final_output_files/ecom/category/2023_05_09_FL_OMN_CertifiedClassics_NEWIN_EN_HP_Button_800x800.jpg" alt="Novedades">
                </a>
                <div class="card-body text-center">
                    <h3 class="card-title">Novedades</h3>
                </div>
            </div>
        </div>
    </div>
</section>

</main>

<!-- Pie de la web -->
<footer class="footer bg-dark text-light py-5">
<div class="container">
    <div class="row">
        <!-- Sección de ubicación -->
        <div class="col-md-6 mb-4">
            <h2 class="footer__location__title">¿Dónde nos encontramos?</h2>
            <iframe class="footer__location__map w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3035.020748125787!2d-3.6765456999999997!3d40.474806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4229475fc7e749%3A0x71a6fb4707b13a23!2sC.%20Consuegra%2C%203%2C%2028036%20Madrid!5e0!3m2!1sen!2ses!4v1697482679679!5m2!1sen!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- Sección de contacto -->
        <div class="col-md-6">
            <h2 class="footer__contact__title">Contacta con nosotros</h2>
            <form class="footer_contact__form" action="./pages/displayed/forms/contact.php" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Nombre" />
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="surname" placeholder="Apellidos" />
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" pattern="[a-zA-Z0-9]{4,}+@[a-zA-Z0-9]{2,}+\.[a-zA-Z]{2,}" />
                </div>
                <div class="mb-3">
                    <input type="tel" class="form-control" name="tel" pattern="[0-9]{9}" placeholder="Teléfono" />
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="message" placeholder="Mensaje"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
