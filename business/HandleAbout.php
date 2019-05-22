<?php
require_once('../persistence/AboutDAO.php');

spl_autoload_register(function ($class)
{include $class.".php";});

$aDAO = new AboutDAO();

if (isset($_GET["action"])) {
    $action = $_GET["action"];


    if ($action == "edit") {

        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $phone = htmlspecialchars($_POST["phone"]);
        $description = htmlspecialchars($_POST["description"]);
        $street = htmlspecialchars($_POST["street"]);
        $city = htmlspecialchars($_POST["city"]);
        $postalCode = htmlspecialchars($_POST["postalCode"]);
        $openingH = htmlspecialchars($_POST["openingH"]);
        $openingD = htmlspecialchars($_POST["openingD"]);


        $aDAO->editCompany($name, $email, $phone, $description, $street, $city, $postalCode, $openingH, $openingD);

        $redirect = new RedirectUser("../presentation/adminDashboard.php");


    }
}
