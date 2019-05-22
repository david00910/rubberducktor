<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>

<!-- Product Handler -->
<?php require_once("../business/HandleAbout.php");?>

<!-- Data Access of Products -->
<?php require_once('../persistence/AboutDAO.php');
$aDAO = new AboutDAO();
$about = $aDAO->readCompany();
?>



<body>

<div class="container bg-light shadow p-3 mb-5 bg-white rounded">

    <?php foreach ($about as $item) { } ?>

    <h2 class="text-center mt-4">Editing company #<?php echo $_GET["id"].": ".$item["companyName"] ?></h2>



    <form enctype="multipart/form-data" method="POST" action="../business/HandleAbout.php?action=edit&id=<?php echo $_GET["id"]?>">

        <div class="input-group mb-3 mt-5">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
            </div>
            <input type="text" name="name" value="<?php echo $item["companyName"] ?>"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-5">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
            </div>
            <input type="text" name="email" value="<?php echo $item["companyEmail"] ?>"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-5">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Phone</span>
            </div>
            <input type="text" name="phone" value="<?php echo $item["companyPhone"] ?>"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
            </div>
            <input type="text" name="description" value="<?php echo $item["companyDescription"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>


        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Street</span>
            </div>
            <input type="text" name="street" value="<?php echo $item["companyStreet"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">City</span>
            </div>
            <input type="text" name="city" value="<?php echo $item["companyCity"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Postal code</span>
            </div>
            <input type="text" name="postalCode" value="<?php echo $item["companyPostal"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Opening hours</span>
            </div>
            <input type="text" name="openingH" value="<?php echo $item["companyOpeningH"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Opening days</span>
            </div>
            <input type="text" name="openingD" value="<?php echo $item["companyOpeningD"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>





        <div class="form-group">
            <input type="submit" class="btn btn-lg btn-info" name="submit" value="Edit details" />
        </div>

    </form>

</div>




</body>
<?php require_once("partials/footer.php"); ?>