<body>
<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>


<!-- Session Handler -->
<?php
require_once("../business/HandleSession.php");?>

<!-- Data Access of Products -->
<?php
require_once("../persistence/CustomerDAO.php");
require_once("../business/RedirectUser.php");
$cDAO = new CustomerDAO();

if (!isset($_SESSION["CustomerID"])) {
    $redirect = new RedirectUser('signup.php');
}
?>

<!-- Page Content -->


    <div class="container bg-light shadow p-3 mb-5 bg-white rounded">

        <div class="container mt-4">
            <h2 class="font-weight-light">Welcome to your dashboard, <?php echo $_SESSION['firstName']; ?>!</h2>
            <h6 class="text-center mt-4 text-danger">Before proceeding, please provide us with your address!</h6>
        </div>

        <h5 class="text-center mt-4">Main address</h5>

        <form method="POST" action="../business/HandleCustomer.php?action=createBillingAddress">

            <div class="input-group mb-3 mt-5">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Street</span>
                </div>
                <input type="text" name="bStreet" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3 mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Postal code</span>
                </div>
                <input type="text" name="bCode" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3 mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">City</span>
                </div>
                <input type="text" name="bCity" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3 mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Country</span>
                </div>
                <input type="text" name="bCountry" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-secondary" name="submit" value="Submit" />
            </div>

        </form>

    </div>


<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>


</body>
<?php require_once("partials/footer.php"); ?>
