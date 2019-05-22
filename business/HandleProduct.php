<?php
 require_once('../persistence/ProductDAO.php');

 spl_autoload_register(function ($class)
{include $class.".php";});

$pDAO = new ProductDAO();

if (isset($_GET["action"])) {
    $action = $_GET["action"];

    if ($action == "create") {

        $name = htmlspecialchars($_POST["name"]);
        $description = htmlspecialchars($_POST["description"]);
        $size = htmlspecialchars($_POST["size"]);
        $onSalePrice = htmlspecialchars($_POST["onSalePrice"]);
        $price = htmlspecialchars($_POST["originalPrice"]);
        $image = $_FILES["image"];
        $isFeatured = htmlspecialchars($_POST["isFeatured"]);

        if($isFeatured == "No") {
            $isFeatured = 0;
        }

        elseif ($isFeatured == "Yes") {
            $isFeatured = 1;
        }

        $pDAO->uploadFile();
        $pDAO->createProduct($name, $description, $size, $onSalePrice, $price, $image, $isFeatured);

        $redirect = new RedirectUser("../presentation/adminDashboard.php");


    }

    if ($action == "edit") {

        $name = htmlspecialchars($_POST["name"]);
        $description = htmlspecialchars($_POST["description"]);
        $size = htmlspecialchars($_POST["size"]);
        $onSalePrice = htmlspecialchars($_POST["onSalePrice"]);
        $price = htmlspecialchars($_POST["originalPrice"]);
        $image = $_FILES["image"];
        $isFeatured = htmlspecialchars($_POST["isFeatured"]);

        if($isFeatured == "No") {
            $isFeatured = 0;
        }

        elseif ($isFeatured == "Yes") {
            $isFeatured = 1;
        }

        $pDAO->uploadFile();
        $pDAO->editProduct($name, $description, $size, $onSalePrice, $price, $image, $isFeatured);

        $redirect = new RedirectUser("../presentation/adminDashboard.php");


    }
  
  if ($action == "deleteProduct") {

        $pDAO->deleteProduct();
        $redirect = new RedirectUser("../presentation/adminDashboard.php");

    }
}
