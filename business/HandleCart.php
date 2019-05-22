<?php
        require_once('../persistence/CartDAO.php');
        spl_autoload_register(function ($class)
        {include"".$class.".php";});

        $cartController = new CartDAO();

        if(!empty($_GET["action"])) {
        if (isset($_GET['itemID'])){
        $id = $_GET['itemID'];}


        switch($_GET["action"]) {

            //adding items to cart
            case "add":
                $cartController->cartAdd($id, $_POST["quantity"]);
                if(!isset($_SESSION["cartItem"])) {
                    $_SESSION["cartItem"][] = $cartController->newItemArray;
                }
                else {
                    array_push($_SESSION["cartItem"], $cartController->newItemArray);
                }

            break;

        // Increase quantity of the item in the cart by 1
            case "increase":
                if (!empty($_SESSION["cartItem"])) {
                    foreach ($_SESSION["cartItem"] as $index => $item) {
                        if ($id == $item["itemID"]) {
                            $_SESSION["cartItem"][$index]["itemQuantity"]++;
                        }
                    }
                }
            break;
        // Decrease quantity of the item in the cart by 1
            case "decrease":
                if (!empty($_SESSION["cartItem"])) {
                    foreach ($_SESSION["cartItem"] as $index => $item) {
                        if ($id == $item["itemID"]) {
                            if ($_SESSION["cartItem"][$index]["itemQuantity"] > 1) {
                                $_SESSION["cartItem"][$index]["itemQuantity"]--;
                            }
                        }
                    }
                }
            break;

        //Remove item from cart
            case "remove":
                if (!empty($_SESSION["cartItem"])) {
                    foreach ($_SESSION["cartItem"] as $index => $item) {
                        if ($id == $item["itemID"]) {

                            unset($_SESSION["cartItem"][$index]);
                        }
                        if (empty($_SESSION["cartItem"])) {
                            unset($_SESSION["cartItem"]);
                        }

                    }

                }
            break;

        //Empty the entire cart
            case "empty":
                unset($_SESSION["cartItem"]);
            break;
        }
        }
?>