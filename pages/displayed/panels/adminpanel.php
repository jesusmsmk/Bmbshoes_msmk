<?php
    // Iniciar sesión y configuración de errores
    session_start();
    error_reporting(0);
    
    // Incluir archivo de conexión
    include('../../includes/connect.php');

    // Verificar si el usuario es admin
    if (!isset($_SESSION['username'])) {
        if ($_SESSION['username'] != 'admin') {
            header('Location: ./../../../index.php');
        }
    }

    // Eliminar usuario si realiza la petición GET correspondiente
    if(isset($_GET['deluser'])) {
        $username = $_SESSION['username'];
        $user_id = $_GET['deluser'];

        // Eliminar detalles del usuario
        $sql_delete_user_details = "DELETE FROM user_details WHERE user_id = $user_id";
        $result_delete_user_details = $db->query($sql_delete_user_details);
        
        // Eliminar usuario
        $sql_delete_user = "DELETE FROM users WHERE id = $user_id";
        $result_delete_user = $db->query($sql_delete_user);

        // Mostrar mensaje según el resultado de la eliminación
        if($result_delete_user_details && $result_delete_user) {
            echo "<div id='successPopup'>Has eliminado al usuario correctamente</div>"; 
        } else {
            echo "<div id='errorPopup'>No se ha podido eliminar el usuario</div>"; 
        }
    } 
    // Eliminar producto si realiza la petición GET correspondiente
    else if (isset($_GET['delproduct'])) {
        $id = $_GET['delproduct'];

        // Eliminar producto
        $sql_product_delete = "DELETE FROM products WHERE id = $id";
        $result_product_delete = $db->query($sql_product_delete);

        // Mostrar mensaje según el resultado de la eliminación
        if($result_product_delete) {
            echo "<div id='successPopup'>Has eliminado el producto correctamente</div>"; 
        } else {
            echo "<div id='errorPopup'>No se ha podido eliminar el producto</div>"; 
        }
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Modificar datos de usuario
        if (isset($_POST['usersave'])) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
    
            $user_id = $_POST['usersave'];
            $sql = $db->query("UPDATE user_details SET name='$name', surname='$surname', address='$address', tel='$tel', email='$email' WHERE user_id=$user_id");

            // Mostrar mensaje según el resultado de la modificación
            if($sql) {
                echo "<div id='successPopup'>Datos modificados correctamente</div>"; 
            } else {
                echo "<div id='errorPopup'>Ha ocurrido un error</div>"; 
            }

        }  
        // Modificar datos de producto
        else if (isset($_POST['productsave'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image = $_POST['image'];
    
            $id = $_POST['productsave'];
            $sql = $db->query("UPDATE products SET name='$name', price='$price', description='$description', image='$image' WHERE id=$id");

            // Mostrar mensaje según el resultado de la modificación
            if($sql) {
                echo "<div id='successPopup'>Producto modificado correctamente</div>"; 
            } else {
                echo "<div id='errorPopup'>Ha ocurrido un error</div>"; 
            }

        }   
        // Crear nuevo producto
        else if (isset($_POST['productcreate'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image = $_POST['image'];

            // Insertar nuevo producto en la base de datos
            $sql = $db->query("INSERT INTO products (name, price, description, image) VALUES ('$name', '$price', '$description', '$image');");
            
            // Mostrar mensaje según el resultado de la creación
            if($sql) {
                echo "<div id='successPopup'>Producto creado correctamente</div>"; 
            } else {
                echo "<div id='errorPopup'>Ha ocurrido un error</div>"; 
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
    <link rel="stylesheet" href="../../../assets/css/tables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Panel de administración</title>
</head>
<body>
    <header>
        <!-- Menú de navegación -->
        <div class="menu row justify-content-around">
            <img class="menu__logo col-6 col-md-1 col-sm-4 mb-4 " src="../../../assets/img/BmbSinFondo.png" alt="BMB Shoes Logo">
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="../../../index.php">Inicio</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../shop.php#man">Hombre</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../shop.php#woman">Mujer</a>
            <a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../forms/contact.php">Contáctanos</a>

            <?php
                session_start();
                if(!$_SESSION['username']) {
                    echo '<a class="menu__link col-6 col-md-2 col-sm-6 mb-4" href="./../forms/login.php">Iniciar Sesión</a>';
                } else {
                    $username = $_SESSION['username'];
                    echo "<a class='menu__link col-6 col-md-2 col-sm-6 mb-4' href='./userpanel.php'>$username</a>";
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
                echo "<a href='./adminpanel.php' class='submenu__link col-12 col-md-4'>Panel de administración</a>";
            }
            ?>
            <a href="./../shopping-cart.php"
                class="submenu__link col-12 col-md-4">Carrito (<?php echo (empty($_SESSION['shcart'])) ? 0 : count($_SESSION['shcart']); ?>)
            </a>
        </div>
        <div class="ads">
    </header>


    <main class="main-content">
    <!-- Tabla de usuarios registrados -->
    <section class="col-12 row justify-content-center">
        <table class="main-table tmod">
            <thead class="thead">
                <tr class="trow trow-main-header">
                    <th class="thead-main-data" colspan="8">Usuarios registrados</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <tr class="trow trow-head">
                    <!-- Encabezados de la tabla de usuarios -->
                    <th class="thead-data">ID</th>
                    <th class="thead-data">Nombre de usuario</th>
                    <th class="thead-data">Nombre</th>
                    <th class="thead-data">Apellidos</th>
                    <th class="thead-data">Dirección</th>
                    <th class="thead-data">Teléfono</th>
                    <th class="thead-data">Email</th>
                    <th class="thead-data">Acciones</th>
                </tr>
                <?php
                if (!isset($_GET['modify'])) {
                    // Obtener usuarios registrados si no se está modificando un usuario
                    $sql = $db->query("SELECT * FROM user_details");
                    $users_total = 0;

                    while ($row = $sql->fetch_assoc()) { ?>
                        <tr class="trow">
                            <!-- Datos de usuarios -->
                            <td width="4%" class="tdata"><?php echo $row['user_id'] ?></td>
                            <td width="12%" class="tdata"><?php echo $row['username'] ?></td>
                            <td width="12%" class="tdata"><?php echo $row['name'] ?></td>
                            <td width="16%" class="tdata"><?php echo $row['surname'] ?></td>
                            <td width="20%" class="tdata"><?php echo $row['address'] ?></td>
                            <td width="7%" class="tdata"><?php echo $row['tel'] ?></td>
                            <td width="13%" class="tdata"><?php echo $row['email'] ?></td>
                            <td width="10%" class="tdata">
                                <!-- Enlaces para eliminar y modificar usuarios -->
                                <a href="adminpanel.php?deluser=<?php echo $row['user_id'] ?>">Eliminar</a> |
                                <a href="adminpanel.php?modify=<?php echo $row['user_id'] ?>">Modificar</a>
                            </td>
                        </tr>
                <?php
                        $users_total += 1;
                    }
                } else {
                    // Mostrar formulario para modificar usuario
                    $user_id = $_GET['modify'];
                    $sql = $db->query("SELECT * FROM user_details WHERE user_id='$user_id'");
                    $row = $sql->fetch_assoc();
                    ?>
                    <tr class="trow">
                        <!-- Datos del usuario seleccionado para modificar -->
                        <td width="4%" class="tdata"><?php echo $user_id ?></td>
                        <td width="12%" class="tdata"><?php echo $row['username'] ?></td>

                        <form action="" method="POST">
                            <!-- Formulario para modificar usuario -->
                            <td width="12%" class="tdata"><input name="name" class="m-name" width="4%" type="text" value="<?php echo $row['name'] ?>"></td>
                            <td width="16%" class="tdata"><input name="surname" class="m-surname" width="4%" type="text" value="<?php echo $row['surname'] ?>"></td>
                            <td width="20%" class="tdata"><input name="address" class="m-address" width="4%" type="text" value="<?php echo $row['address'] ?>"></td>
                            <td width="7%" class="tdata"><input name="tel" class="m-tel" width="4%" type="text" value="<?php echo $row['tel'] ?>"></td>
                            <td width="13%" class="tdata"><input name="email" class="m-email" width="4%" type="text" value="<?php echo $row['email'] ?>"></td>
                            <td width="10%" class="tdata">
                                <!-- Botón para guardar cambios en el usuario -->
                                <button name="usersave" value="<?php echo $user_id ?>" class="btn btn-primary">Guardar</button>
                            </td>
                        </form>
                    </tr>
                <?php
                }
                ?>
                <!-- Pie de tabla con información adicional -->
                <tfoot class="tfoot">
                    <tr class="trow trow-foot">
                        <?php
                        if (!isset($_GET['modify'])) {
                        ?>
                            <td class="tdata tdata-foot total" colspan="7">Usuarios totales registrados:</td>
                            <td class="tdata tdata-foot" colspan="2"><?php echo $users_total ?></td>
                        <?php } else { ?>
                            <!-- Enlace para volver a la tabla de usuarios -->
                            <td class="tdata tdata-foot m-foot-redirect" colspan="7"><a href="adminpanel.php">Volver a la tabla de usuarios</a></td>
                            <td class="tdata tdata-foot" colspan="2"></td>
                        <?php
                        }
                        ?>
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </section>

    <!-- Tabla de productos -->
    <section class="col-12 row justify-content-center">
        <table class="main-table tmod">
            <thead class="thead">
                <tr class="trow trow-main-header">
                    <th class="thead-main-data" id="Productos" colspan="8">Productos a la venta</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <tr class="trow trow-head">
                    <!-- Encabezados de la tabla de productos -->
                    <th class="thead-data">ID</th>
                    <th class="thead-data">Nombre</th>
                    <th class="thead-data">Precio</th>
                    <th class="thead-data">Descripción</th>
                    <th class="thead-data">Imagen</th>
                    <th class="thead-data">Acciones</th>
                </tr>
                <?php
                if (!isset($_GET['pmodify']) && !isset($_GET['pcreate'])) {
                    // Obtener productos a la venta si no se está modificando o creando un producto
                    $sql = $db->query("SELECT * FROM products");
                    $products_total = 0;

                    while ($row = $sql->fetch_assoc()) { ?>
                        <tr class="trow">
                            <!-- Datos de productos -->
                            <td width="4%" class="tdata"><?php echo $row['id'] ?></td>
                            <td width="10%" class="tdata"><?php echo $row['name'] ?></td>
                            <td width="6%" class="tdata"><?php echo $row['price'] ?>€</td>
                            <td width="45%" class="tdata description-cell"><?php echo $row['description'] ?></td>
                            <td width="25%" class="tdata"><?php echo $row['image'] ?></td>
                            <td width="15%" class="tdata">
                                <!-- Enlaces para eliminar y modificar productos -->
                                <a href="adminpanel.php?delproduct=<?php echo $row['id'] ?>">Eliminar</a> |
                                <a href="adminpanel.php?pmodify=<?php echo $row['id'] ?>">Modificar</a>
                            </td>
                        </tr>
                <?php
                        $products_total += 1;
                    }
                } else if (isset($_GET['pcreate'])) {
                    // Formulario para crear un nuevo producto
                ?>
                    <tr class="trow">
                        <!-- Datos del nuevo producto -->
                        <td width="4%" class="tdata"></td>

                        <form action="" method="POST">
                            <!-- Formulasrio para crear un nuevo producto -->
                            <td width="12%" class="tdata"><input name="name" class="m-name" width="4%" type="text"></td>
                            <td width="16%" class="tdata"><input name="price" class="m-surname" width="4%" type="text"></td>
                            <td width="20%" class="tdata"><input name="description" class="m-address" width="4%" type="text"></td>
                            <td width="7%" class="tdata"><input name="image" class="m-tel" width="4%" type="text"></td>
                            <td width="10%" class="tdata">
                                <!-- Botón para agregar el nuevo producto -->
                                <button name="productcreate" class="btn btn-primary">Añadir producto</button>
                            </td>
                        </form>
                    </tr>
                <?php
                } else {
                    // Mostrar formulario para modificar producto
                    $id = $_GET['pmodify'];
                    $sql = $db->query("SELECT * FROM products WHERE id='$id'");
                    $row = $sql->fetch_assoc();
                    ?>
                    <tr class="trow">
                        <!-- Datos del producto seleccionado para modificar -->
                        <td width="4%" class="tdata"><?php echo $id ?></td>

                        <form action="" method="POST">
                            <!-- Formulario para modificar producto -->
                            <td width="12%" class="tdata"><input name="name" class="m-name" width="4%" type="text" value="<?php echo $row['name'] ?>"></td>
                            <td width="16%" class="tdata"><input name="price" class="m-surname" width="4%" type="text" value="<?php echo $row['price'] ?>"></td>
                            <td width="20%" class="tdata"><input name="description" class="m-address" width="4%" type="text" value="<?php echo $row['description'] ?>"></td>
                            <td width="7%" class="tdata"><input name="image" class="m-tel" width="4%" type="text" value="<?php echo $row['image'] ?>"></td>
                            <td width="10%" class="tdata">
                                <!-- Botón para guardar cambios en el producto -->
                                <button name="productsave" value="<?php echo $id ?>" class="btn btn-primary">Guardar</button>
                            </td>
                        </form>
                    </tr>
                <?php
                }
                ?>
                <!-- Pie de tabla con información adicional -->
                <tfoot class="tfoot">
                    <tr class="trow trow-foot">
                        <?php
                        if (!isset($_GET['pmodify']) && !isset($_GET['pcreate'])) {
                        ?>
                            <td class="tdata tdata-foot total" colspan="4">Productos mostrados:</td>
                            <td class="tdata tdata-foot" colspan="1"><?php echo $products_total ?></td>
                            <!-- Enlace para crear un nuevo producto -->
                            <td class="tdata tdata-foot"><a class="m-foot-redirect" href="adminpanel.php?pcreate">Crear producto</a></td>
                        <?php } else { ?>
                            <!-- Enlace para volver a la tabla de productos -->
                            <td class="tdata tdata-foot m-foot-redirect" colspan="4"><a href="adminpanel.php#Productos">Volver a la tabla de productos</a> | <a href="adminpanel.php?pcreate">Agregar producto<a></td>
                            <td class="tdata tdata-foot" colspan="2"></td>
                        <?php
                        }
                        ?>
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </section>
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

</body>
</html>