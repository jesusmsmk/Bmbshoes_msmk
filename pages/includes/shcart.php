<?php

// Definir constantes para cifrado

define("Cod", "AES-128-ECB");
define("Key", 'Bmbshoes@');

// Consultar la base de datos para obtener toda la información de productos
$sql = $db->query("SELECT * FROM products");
$result = $sql->fetch_all(MYSQLI_ASSOC);
$row = $sql->fetch_assoc();

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Descifrar los datos del formulario que han sido recibidos
    $id = openssl_decrypt($_POST['id'], Cod, Key);
    $name = openssl_decrypt($_POST['name'], Cod, Key);
    $price = openssl_decrypt($_POST['price'], Cod, Key);
    $quantity = openssl_decrypt($_POST['quantity'], Cod, Key);

    // Verificar si ha sido usado el botón del formulario
    if (isset($_POST['btnaction'])) {
        
        switch ($_POST['btnaction']) {
            
            case 'Add':
                // Verificar que los datos son válidos y por lo tanto no han sido manipulados por ningun usuario
                if (is_numeric($id) && is_string($name) && is_numeric($price) && is_numeric($quantity)) {
                    // Verificar si la sesión del carrito no está establecida para agregar el primer elemento y crear la sesión
                    if (!isset($_SESSION['shcart'])) {
                        // Crea el primer 
                        $item = array(
                            'id' => $id,
                            'name' => $name,
                            'price' => $price,
                            'quantity' => $quantity
                        );
                        $_SESSION['shcart'][0] = $item;
                        echo "<div id='successPopup'>Artículo agregado al carrito</div>";
                    } else {
                        // Verificar si el artículo ya está en el carrito
                        $itemExists = false;
                        foreach ($_SESSION['shcart'] as $existingItem) {
                            if ($existingItem['id'] == $id) {
                                $itemExists = true;
                                break;
                            }
                        }
                        // Agregar artículos al carrito
                        if ($itemExists) {
                            echo "<div id='errorPopup'>Solo se puede seleccionar un artículo igual por cliente</div>";
                        } else {
                            $items_quantity = count($_SESSION['shcart']);
                            $item = array(
                                'id' => $id,
                                'name' => $name,
                                'price' => $price,
                                'quantity' => $quantity
                            );
                            $_SESSION['shcart'][$items_quantity] = $item;
                            echo "<div id='successPopup'>Artículo agregado al carrito</div>";
                        }
                    }
                }
                break;

            case 'Delete':
                // Verificar que el ID del artículo es numérico y por lo tanto no ha sido modificado
                if (is_numeric(openssl_decrypt($_POST['id'], Cod, Key))) {
                    // Iterar sobre los elementos del carrito y eliminar el artículo
                    foreach ($_SESSION['shcart'] as $in => $item) {
                        $id = openssl_decrypt($_POST['id'], Cod, Key);
                        if ($item['id'] === $id) {
                            unset($_SESSION['shcart'][$in]);
                            echo "<div id='successPopup'>Artículo eliminado del carrito</div>";
                        }
                    }
                } else {
                    echo "<div id='errorPopup'>No se puede eliminar con éxito</div>";
                }
                break;
        }
    }
}
