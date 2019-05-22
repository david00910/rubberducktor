<body>
<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Redirect -->
<?php require_once("../business/RedirectUser.php"); ?>

<!-- Session Handler -->
<?php
require_once("../business/HandleSession.php");?>
<?php if (!isset($_SESSION["CustomerID"]))  {
    $redirect = new RedirectUser("signup.php");
} ?>

<!-- Data Access of Products -->
<?php
require_once("../persistence/CustomerDAO.php");
require_once("../business/RedirectUser.php");
$cDAO = new CustomerDAO();
$getCustomers = $cDAO->readCustomers();
$pDAO = new ProductDAO();
$getProducts = $pDAO->readProducts();
$oDAO = new OrderDAO();
$getOrders = $oDAO->readOrdersForCustomer();

if (!isset($_SESSION["CustomerID"])) {
    $redirect = new RedirectUser('signup.php');
}

if (isset($_SESSION["CustomerID"])) {

    if (!isset($_SESSION["street"])) {
        $redirect = new RedirectUser('provideAddress.php');
    }
}

?>

<!-- Page Content -->

<div class="container bg-light shadow p-3 mb-5 bg-white rounded mt-4">
    <div class="row">
        <div class="col-md-2 col-sm-4 sidebar1">



            <br>
            <div class="left-navigation">
                <ul class="list">
                    <h5><strong>Hi, <?php echo $_SESSION['firstName'] ?>!</strong></h5>
                    <li class=><a class="text-light" href="#tab1" data-toggle="tab">Dashboard</a></li>

                    <li><a class="text-light" href="#tab3" data-toggle="tab">Orders</a></li>

                    <br>
                    <hr class="bg-light">

                    <li><a class="text-light" href="../business/HandleCustomer.php?action=logout">Logout</a></li>
                </ul>

                <br>

            </div>
        </div>
        <div class="tab-content ml-5">

            <!-- DASHBOARD -->

            <div class="tab-pane active text-style" id="tab1">
                <h2 class="mb-4">Dashboard</h2>


                    <h4><?php echo $_SESSION['firstName']." ".$_SESSION['lastName']; ?></h4>
                    <small><cite title="<?php echo $_SESSION['postalCode'].", ".$_SESSION['country']; ?>"><?php echo $_SESSION['postalCode'].", ".$_SESSION['country']; ?><i class="glyphicon glyphicon-map-marker">
                            </i></cite></small>
                    <p>
                        <span><?php echo $_SESSION['email']; ?></span>
                        <br />
                        <span><?php echo $_SESSION['gender']; ?></span>
                    </p>

            </div>


            <div class="tab-pane text-style" id="tab3">
                <h2>Orders</h2>

                <table id="users" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ordered by</th>
                        <th>Date</th>
                        <th>Total price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php foreach ($getOrders as $getOrder) { if ($getOrder["isCompleted"] == 1 || $getOrder["isCancelled"] == 1) {

                        echo "<tr class='bg-warning'>
                    
                    <td>" . $getOrder['orderID'] . "</td>
                    <td>" . $getOrder['firstName'] . " " . $getOrder['lastName'] . "</td>
                    <td>" . $getOrder['createdAt'] . "</td>
                    <td>" . $getOrder['orderPrice'] . " DKK</td>
                    <td>
                    <small class='text-dark'>Order has been processed</small>
                    <a class='text-primary' href=\"viewOrder.php?orderID=" . $getOrder['orderID'] . "\">View</a>
                    </td>
                </tr>";
                    } else {

                        echo "<tr>
                    
                    <td>" . $getOrder['orderID'] . "</td>
                    <td>" . $getOrder['firstName'] . " " . $getOrder['lastName'] . "</td>
                    <td>" . $getOrder['createdAt'] . "</td>
                    <td>" . $getOrder['orderPrice'] . " DKK</td>
                    <td>
                    <a class='text-info' href=\"viewOrder.php?orderID=" . $getOrder['orderID'] . "\">View</a>
                    </td>
                </tr>";

                    }
                    } ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>



<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>

</body>
<?php require_once("partials/footer.php"); ?>