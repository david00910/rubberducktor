<?php
require_once('../persistence/NewsDAO.php');

spl_autoload_register(function ($class)
{include $class.".php";});

$nDAO = new NewsDAO();

if (isset($_GET["action"])) {
    $action = $_GET["action"];

    if ($action == "create") {

        $nTitle = htmlspecialchars($_POST["title"]);
        $nPreview = htmlspecialchars($_POST["preview"]);
        $nText = htmlspecialchars($_POST["text"]);
        $nAuthor = htmlspecialchars($_POST["author"]);


        $nDAO->createNews($nTitle, $nPreview, $nText, $nAuthor);
        var_dump($nDAO);

        $redirect = new RedirectUser("../presentation/adminDashboard.php");


    }

    if ($action == "edit") {

        $nTitle = htmlspecialchars($_POST["title"]);
        $nPreview = htmlspecialchars($_POST["preview"]);
        $nText = htmlspecialchars($_POST["text"]);
        $nAuthor = htmlspecialchars($_POST["author"]);


        $nDAO->editNews($nTitle, $nPreview, $nText, $nAuthor);

        $redirect = new RedirectUser("../presentation/adminDashboard.php");


    }

    if ($action == "delete") {

        $nDAO->deleteNews();
        $redirect = new RedirectUser("../presentation/adminDashboard.php");

    }
}
