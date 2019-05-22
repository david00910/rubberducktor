<?php
require_once('../persistence/OrderDAO.php');
spl_autoload_register(function ($class)
{include"".$class.".php";});
$session = new HandleSession();
$orderController = new OrderDAO();
require_once('HandleInvoice.php');

if(!empty($_GET["action"])) {

    if (isset($_POST["sStreet"]) && isset($_POST["sCode"])) {

        $street = htmlspecialchars($_POST["sStreet"]);
        $code = htmlspecialchars($_POST["sCode"]);
        $postalCode = htmlspecialchars($_POST["sCode"]);
        $city = htmlspecialchars($_POST["sCity"]);
        $country = htmlspecialchars($_POST["sCountry"]);

    }

    $item_total = 0;
    $totalPrice = 0;

    foreach ($_SESSION["cartItem"] as $item) {

        if (isset($item["itemOnSalePrice"])) {
            $item["itemPrice"] = $item["itemOnSalePrice"];
        }


        $item_total += ($item["itemQuantity"]*$item["itemPrice"]);
        $totalPrice = ($item_total +49);

    }



    $orderController->checkout($code, $city, $street, $postalCode, $country, $totalPrice);
    createInvoice();

    unset($_SESSION["cartItem"]);

    $message = "We have placed your order. <br> Check your inbox for the invoice! <br> Thank you for choosing RubberDucktor! :)";
    $redirect = new RedirectUser("../presentation/index.php?message=$message");


}
?>