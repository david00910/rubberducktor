<!-- Head -->
<?php require_once("header.php"); ?>

<!-- Data access of Products -->
<?php require_once("../persistence/ProductDAO.php"); ?>

<?php
$pDAO = new ProductDAO();
$cartDAO = new cartDAO();
$getFeatured = $pDAO->readFeatured();



?>

<!-- Scripts -->
<?php require_once("scripts.php"); ?>

<header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">

            <div class='carousel-item active' style="background-image: url('https://source.unsplash.com/RCAhiGJsUUE/1920x1080')">
                <div class="carousel-caption d-none d-md-block">
            <?php foreach ($getFeatured as $k => $v) {

        echo "
              <img src='".$getFeatured[$k]["itemImg_url"]."' width='35%' height='350px' alt='comingsoon' >
            <h3 class=\"display-4\">" . $getFeatured[$k]["itemName"] ."</h3>
            <p class='lead'>" . $getFeatured[$k]["itemDescription"] ."</p>

                </div>
            </div>
            
            

            <div class='carousel-item text-center' style=\"background-color: black;\">
            <img src='../includes/images/headerComingSoon.png' width='90%' height='696px' alt='comingsoon' >
                <div class=\"carousel-caption d-none d-md-block\">

        "; } ?>

                </div>
            </div>





            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
    </div>
    </header>