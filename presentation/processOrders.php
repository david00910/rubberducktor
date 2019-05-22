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
<?php if (!isset($_SESSION["CustomerID"]) || $_SESSION["isAdmin"] == 0)  {
    $redirect = new RedirectUser("index.php");
} ?>

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
    <a href="adminDashboard.php" class="btn btn-sm btn-info"><- Back</a>



    <h4 class="mb-4">Order #<?php echo $_GET["orderID"] ?></h4>


    <div class="container  text-light">
        <div class="row text-left">


                <?php foreach ($getShippingA as $shipA) { }

                foreach ($getOrders as $order) {

                    if($order["isCompleted"] == 1) { ?>

                        <div class="container">
                            <div class="alert alert-success text-center"><h3>This order has been shipped, you can not edit it anymore!</h3></div>
                        </div>
                    <?php }

                    elseif ($order["isCancelled"] == 1) { ?>

                        <div class="container">
                            <div class="alert alert-danger text-center"><h3>This order has been cancelled, you can not edit it anymore!</h3></div>
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
                <?php if ($order["isCompleted"] == 1 || $order["isCancelled"] == 1) { ?>
                    <a href="" class="btn btn-light btn-block disabled">Ship</a>
                    <a href="" class="btn btn-danger btn-block disabled">Cancel</a>
                <?php }
                else {?>

                    <a data-href="processOrders.php?action=ship&orderID=<?php echo $_GET["orderID"]; ?>" data-toggle="modal" data-target="#confirm-delete"  class="btn btn-light btn-block text-dark">Ship</a>
                    <a data-href="processOrders.php?action=cancel&orderID=<?php echo $_GET["orderID"]; ?>" data-toggle="modal" data-target="#confirm-delete"  class="btn btn-danger btn-block">Cancel</a>

                <?php }?>



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

    <hr>
    <h5 class="font-weight-light text-center">Admin: <?php echo $_SESSION['firstName']." ".$_SESSION['lastName']; ?></h5>
    <a href="../business/HandleCustomer.php?action=logout"><p class="text-center">Logout</p></a>
    <p class="text-center"><?php echo date("Y/m/d h:i") ?></p>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
            </div>

            <div class="modal-body">
                <p>Are you sure?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a class="btn btn-warning btn-ok">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>


</body>
<?php require_once("partials/footer.php"); ?>