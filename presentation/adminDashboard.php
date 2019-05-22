<body>
<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Redirect -->
<?php require_once("../business/RedirectUser.php"); ?>
  
<!-- Product Handler -->
<?php require_once("../business/HandleProduct.php"); ?>
  
  <!-- Company Handler -->
<?php require_once("../business/HandleAbout.php"); ?>
  
    <!-- News Handler -->
<?php require_once("../business/HandleNews.php"); ?>
  
      <!-- Customer Handler -->
<?php require_once("../business/HandleCustomer.php"); ?>

<!-- Session Handler -->
<?php
require_once("../business/HandleSession.php");?>
<?php if (!isset($_SESSION["CustomerID"]) || $_SESSION["isAdmin"] == 0)  {
        $redirect = new RedirectUser("index.php");
    } ?>

<!-- Data Access of Products and Customers and Orders -->
<?php
require_once("../persistence/CustomerDAO.php");
$cDAO = new CustomerDAO();
$getCustomers = $cDAO->readCustomers();
$pDAO = new ProductDAO();
$getProducts = $pDAO->readProducts();
$oDAO = new OrderDAO();
$getOrders = $oDAO->readOrders();
$getShipped = $oDAO->getCompleted();
$getCancelled = $oDAO->getCancelled();
$aDAO = new AboutDAO();
$about = $aDAO->readCompany();
$nDAO= new NewsDAO();
$getNews = $nDAO->readNews();

if (!isset($_SESSION["CustomerID"])) {
    $redirect = new RedirectUser('signup.php');
}
?>

<!-- Page Content -->


<div class="container bg-light shadow p-3 mb-5 bg-white rounded">

    <div class="container mb-4 mt-4">
        <h2 class="font-weight-light">Yo, <?php echo $_SESSION['firstName']; ?>!</h2>
        <h5 class="font-weight-light">This is the admin dashboard, where you can create, edit, delete and view all existing products, users and orders.</h5>
    </div>

    <!-- NAVIGATION -->

    <div class="col-sm float-left mb-4">
        <nav class="nav-sidebar">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="#tab1" data-toggle="tab">Users</a></li>
                <li class="list-group-item"><a href="#tab2" data-toggle="tab">Products</a></li>
                <li class="list-group-item"><a href="#tab3" data-toggle="tab">Orders</a></li>
                <li class="list-group-item"><a href="#tab4" data-toggle="tab">News</a></li>
                <li class="list-group-item"><a href="#tab5" data-toggle="tab">Company details</a></li>

            </ul>
        </nav>
    </div>

    <!-- TABS -->

    <div class="tab-content">

        <!-- USERS -->

        <div class="tab-pane active text-style" id="tab1">
            <h2 class="mb-4">Users</h2>

            <table id="users" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($getCustomers as $getCustomer) { echo "<tr>
                    <td>".$getCustomer['customerID']."</td>
                    <td>".$getCustomer['firstName']."</td>
                    <td>".$getCustomer['lastName']."</td>
                    <td>".$getCustomer['email']."</td>
                    <td>
                  
                    <a class='text-danger' data-href=\"adminDashboard.php?action=delete&CustomerID=" . $getCustomer['customerID'] . "\" data-toggle=\"modal\" data-target=\"#confirm-delete\" href='#'>Delete</a>
                    </td>
                </tr>"; } ?>

                </tbody>
            </table>


        </div>

        <!-- PRODUCTS -->

        <div class="tab-pane text-style" id="tab2">
            <h2>Products</h2>
            <div class="btn"><a href="createProduct.php">Create a new product</a></div>

            <table id="users" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Issue date</th>
                    <th>Price</th>
                    <th>On sale price</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($getProducts as $getProduct) { echo "<tr>
                    <td>".$getProduct['itemID']."</td>
                    <td>".$getProduct['itemName']."</td>
                    <td>".$getProduct['itemIssueDate']."</td>
                    <td>".$getProduct['itemPrice']."</td>
                    <td>".$getProduct['itemOnSalePrice']."</td>
                    <td>".$getProduct['itemSize']."</td>
                    <td>
                    <a class='text-primary'  href=\"editProduct.php?itemID=" . $getProduct['itemID'] . "\">Edit</a>
                    <span>|</span>
                    <a class='text-danger' data-href=\"adminDashboard.php?action=deleteProduct&itemID=" . $getProduct['itemID'] . "\" data-toggle=\"modal\" data-target=\"#confirm-delete\">Delete</a>
                    </td>
                </tr>"; } ?>

                </tbody>
            </table>



        </div>

        <!-- ORDERS -->

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
                    <a class='text-primary' href=\"processOrders.php?orderID=" . $getOrder['orderID'] . "\">View</a>
                    </td>
                </tr>";
                } else {

                    echo "<tr>
                    
                    <td>" . $getOrder['orderID'] . "</td>
                    <td>" . $getOrder['firstName'] . " " . $getOrder['lastName'] . "</td>
                    <td>" . $getOrder['createdAt'] . "</td>
                    <td>" . $getOrder['orderPrice'] . " DKK</td>
                    <td>
                    <a class='text-info' href=\"processOrders.php?orderID=" . $getOrder['orderID'] . "\">Handle</a>
                    </td>
                </tr>";

                }
                } ?>

                </tbody>
            </table>

            <table id="users" class="table table-striped table-bordered">
                <h3>Shipped</h3>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer ID</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($getShipped as $shipped) {

                    echo "<tr class='bg-success'>
                    
                    <td>" . $shipped['orderID'] . "</td>
                    <td>" . $shipped['CustomerID'] . "</td>
                    <td>
                    <small class='text-light'>Order has been completed</small>
                    <a class='text-light' href=\"processOrders.php?orderID=" . $shipped['orderID'] . "\">View</a>
                    </td>
                </tr>";


                } ?>

                </tbody>
            </table>

            <table id="users" class="table table-striped table-bordered">
                <h3>Cancelled</h3>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer ID</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($getCancelled as $shipped) {

                    echo "<tr class='bg-danger'>
                    
                    <td>" . $shipped['orderID'] . "</td>
                    <td>" . $shipped['CustomerID'] . "</td>
                    <td>
                    <small class='text-light'>Order has been cancelled</small>
                    <a class='text-dark' href=\"processOrders.php?orderID=" . $shipped['orderID'] . "\">View</a>
                    </td>
                </tr>";


                } ?>

                </tbody>
            </table>
            </div>

        <!-- NEWS -->

        <div class="tab-pane text-style" id="tab4">
            <h2>Products</h2>
            <div class="btn"><a href="createNews.php">Create news</a></div>

            <table id="users" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created at</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($getNews as $news) { echo "<tr>
                    <td>".$news['id']."</td>
                    <td>".$news['newsTitle']."</td>
                    <td>".$news['newsDate']."</td>
                    <td>".$news['newsAuthor']."</td>
                    <td>
                    <a class='text-primary'  href=\"editNews.php?id=" . $news['id'] . "\">Edit</a>
                    <span>|</span>
                    <a class='text-danger' data-href=\"adminDashboard.php?action=delete&id=" . $news['id'] . "\" data-toggle=\"modal\" data-target=\"#confirm-delete\">Delete</a>
                    </td>
                </tr>"; } ?>

                </tbody>
            </table>


        </div>

        <!-- Company details -->

        <div class="tab-pane text-style" id="tab5">
            <h2>Company details</h2>


            <div class="row text-center mt-4">
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

                        <a class='btn btn-md btn-light mt-4'  href="editAboutUs.php?id=<?php echo $data['id'] ?>">Edit company details</a>



                    </div>


                <?php } ?>


            </div>


        </div>



</div>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>

                <div class="modal-body">
                    <p>You are about to delete this item, this procedure is irreversible.</p>
                    <p>Are you sure?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No, cancel</button>
                    <a class="btn btn-danger btn-ok">Yes, delete</a>
                </div>
            </div>
        </div>
    </div>

        <hr>
        <h5 class="font-weight-light text-center">Admin: <?php echo $_SESSION['firstName']." ".$_SESSION['lastName']; ?></h5>
        <a href="../business/HandleCustomer.php?action=logout"><p class="text-center">Logout</p></a>
        <p class="text-center"><?php echo date("Y/m/d h:i") ?></p>
    </div>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>


</body>
<?php require_once("partials/footer.php"); ?>