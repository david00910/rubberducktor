<body onload="initMap()">
<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>


<!-- Session Handler -->
<?php
require_once("../business/HandleSession.php");?>


<!-- Data Access of Products -->
<?php
require_once("../persistence/AboutDAO.php");

$aDAO = new AboutDAO();
$about = $aDAO->readCompany();
?>

<!-- Page Content -->



<div class="container bg-light shadow p-3 mb-5 bg-white rounded">

    <div class="container">

        <h4 class="mb-4">About RubberDucktor</h4>

        <div class="row text-center">
            <?php foreach ($about as $data) {  ?>
            <div class="col-lg bg-primary text-light" style="padding:10px;">

                <h5>How it started and where we are now..</h5>

                <div class="col">

                    <p><?php echo $data["companyDescription"] ?></p>

                </div>

        </div>

            <div class="col-sm-4 bg-info text-light" style="padding:10px;">

                <h5>Where to find us..</h5>

                <div class="col">
                    <div class="title"><?php echo $data["companyName"] ?> ApS</div>
                    <div><?php echo $data["companyStreet"] ?></div>
                    <div><?php echo $data["companyCity"] ?></div>
                    <div><?php echo $data["companyPostal"] ?></div>
                    <div class="title mt-3">Opening hours:</div>
                    <div><?php echo $data["companyOpeningH"] ?></div>
                    <div><?php echo $data["companyOpeningD"] ?></div>
                    <br>
                    <div><?php echo $data["companyEmail"] ?></div>
                    <div><?php echo $data["companyPhone"] ?></div>
                </div>

            </div>
            <?php } ?>
            </div>
</div>
    <div id="map"></div>
</div>





</body>
<?php require_once("partials/footer.php"); ?>
