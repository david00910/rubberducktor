<?php
require_once('../persistence/OrderDAO.php');
spl_autoload_register(function ($class)
{include"".$class.".php";});
$orderController = new OrderDAO();

if (isset($_GET["action"])) {
    $action = $_GET["action"];


    // COMPLETE THE ORDER (ADMIN)

    if ($action == "ship") {

        $orderController->shipOrder();

    }

    // CANCEL THE ORDER (ADMIN)

    if ($action == "cancel") {

        $orderController->cancelOrder();

    }
}
?>