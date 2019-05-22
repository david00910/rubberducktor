<body>
<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Redirect -->
<?php require_once("../business/RedirectUser.php"); ?>

<!-- Order Handler -->
<?php require_once("../business/HandleOrder.php");?>

<!-- Session Handler -->
<?php
require_once("../business/HandleSession.php");?>

<!-- Data Access of Products and Customers and Orders -->
<?php
require_once("../persistence/CustomerDAO.php");
require_once("../persistence/OrderDAO.php");
$cDAO = new CustomerDAO();
$getCustomers = $cDAO->readCustomers();
$pDAO = new ProductDAO();
$getProducts = $pDAO->readProducts();
$oDAO = new OrderDAO();
$getOrders = $oDAO->processOrders();
$getShippingA = $oDAO->getShippingAddresses();
$getLine = $oDAO->getItems();

if (!isset($_SESSION["CustomerID"])) {
    $redirect = new RedirectUser('signup.php');
}
?>

<!-- Page Content -->


<div class="container bg-light shadow p-3 mb-5 bg-white rounded">
    <a href="customerDashboard.php" class="btn btn-sm btn-info"><- Back</a>



    <h4 class="mb-4">Order #<?php echo $_GET["orderID"] ?></h4>


    <div class="container  text-light">
        <div class="row text-left">


            <?php foreach ($getShippingA as $shipA) { }

            foreach ($getOrders as $order) {

                if($order["isCompleted"] == 1) { ?>

                    <div class="container">
                        <div class="alert alert-success text-center"><h3>Your order has been shipped and marked as completed!</h3></div>
                    </div>
                <?php }

                elseif ($order["isCancelled"] == 1) { ?>

                    <div class="container">
                        <div class="alert alert-danger text-center"><h3>Your order has been cancelled, probably on your request. If not, contact us!</h3></div>
                    </div>

                <?php }
            } ?>
            <div class="col-sm bg-primary" style="padding: 6px;">

                <h5>Order details</h5>
                <hr class="bg-light">

                <div class="text-left" style="background: rgba(255, 255, 255, 0.1); padding: 5px;"><strong>Product(s)</strong>

                    <?php foreach ($getLine as $product) { ?>
                        <span class="float-right ml-2"><img src="<?php echo $product["itemImg_url"] ?>" width="50px" height="50px"/></span>
                        <span class="float-right">- <?php echo $product["itemName"]; ?></span><br>
                        <span class="float-right">Quantity: <?php echo $product["OrderQuantity"]; ?></span><br>
                        <hr>


                    <?php } ?>

                    <strong>Total:</strong> <span class="float-right"><?php echo $order["orderPrice"]; ?> DKK </span>
                    <hr>
                </div>



            </div>
            <div class="col-sm bg-info text-light" style="padding: 6px;">

                <h5 class="text-left">Customer details</h5>
                <hr class="bg-light">

                <div class="text-left" style="background: rgba(255, 255, 255, 0.1); padding: 5px;"><strong>Name</strong>
                    <span class="float-right"><?php echo $order["firstName"]." ".$order["lastName"] ?></span><br>
                </div>

                <div class="text-left" style="background: rgba(255, 255, 255, 0.25); padding: 5px;"><strong>Email</strong>
                    <span class="float-right"><?php echo $order["email"] ?></span><br>
                </div>


                <div class="text-left" style="background: rgba(255, 255, 255, 0.1); padding: 5px;"><strong>Billing address</strong>
                    <span class="float-right"><?php echo $order["street"] ?></span><br>
                    <span class="float-right"><?php echo $order["postalCode"] ?></span><br>
                    <span class="float-right"><?php echo $order["city"] ?></span><br>
                    <span class="float-right"><?php echo $order["country"] ?></span><br>
                </div>

                <div class="text-left" style="background: rgba(255, 255, 255, 0.25); padding: 5px;"><strong>Shipping address</strong>

                    <?php if(isset($shipA)) { ?>

                        <span class="float-right"><?php echo $shipA["street"] ?></span><br>
                        <span class="float-right"><?php echo $shipA["postalCode"] ?></span><br>
                        <span class="float-right"><?php echo $order["city"] ?></span><br>
                        <span class="float-right"><?php echo $shipA["country"] ?></span><br>
                    <?php }

                    else
                    {echo "<span class=\"float-right\">Same as billing address</span><br>"; }?>
                </div>

            </div>

        </div>

    </div>

</div>


<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>


</body>
<?php require_once("partials/footer.php"); ?>