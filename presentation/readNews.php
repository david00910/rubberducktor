<!-- Session Handler -->
<?php require_once("../business/HandleSession.php");?>

<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>

<!-- Date access of News -->
<?php require_once("../persistence/NewsDAO.php");?>


<body>

<?php


$nDAO = new NewsDAO();
$getNews = $nDAO->readNews();

foreach ($getNews as $news) { } ?>

<div class="container bg-light shadow p-3 mb-5 bg-white rounded">

    <div class="container">
        <div class="row">
            <div class="col">
                <h5><?php echo $news["newsTitle"] ?></h5>
                <small>Created by <?php echo $news["newsAuthor"] ?>, <?php echo $news["newsDate"] ?></small>
                <p><?php echo $news["newsText"] ?></p>
            </div>
        </div>
    </div>

</div>



</body>
<?php require_once("partials/footer.php"); ?>