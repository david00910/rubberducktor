<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>

<!-- Data Access of Products -->
<?php require_once('../persistence/ProductDAO.php'); ?>

<!-- Session Handler -->
<?php require_once("../business/HandleSession.php");?>

<!-- Checkout Handler -->
<?php require_once("../business/HandleCheckout.php");?>

<!-- Data Access of Cart -->
<?php require_once('../persistence/CartDAO.php'); ?>


<body>

<form method="POST" action="../business/HandleCheckout.php?action=checkout">

    <div class="container bg-light shadow p-3 mb-5 bg-white rounded">
        <h3 class="mt-3">Checkout</h3>
        <div class="row">


            <div class="col-sm">
            <div class="custom-control custom-checkbox mt-5">
                <input type="checkbox" class="custom-control-input" onclick="checkFunc()" id="defaultUnchecked">
                <label class="custom-control-label" for="defaultUnchecked">The shipping address is the same as my billing address</label>
            </div>


            <div class="col-sm" id="checker">

                <h6 class="mt-4">Shipping address</h6>


                <div class="input-group mb-3 mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Street</span>
                    </div>
                    <input type="text" name="sStreet" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="input-group mb-3 mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Postal code</span>
                    </div>
                    <input type="text" name="sCode" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="input-group mb-3 mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">City</span>
                    </div>
                    <input type="text" name="sCity" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="input-group mb-3 mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Country</span>
                    </div>
                    <input type="text" name="sCountry" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>

            </div>


            <div class="col-sm">

                <div id="paypal-button-container">

                </div>
            </div>
            </div>

            <div class="col-sm">

                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h5 class="mt-3 mb-3">Review Order</h5>
                    </div>
                    <div class="panel-body">

                        <?php $item_total = 0;

                        foreach ($_SESSION["cartItem"] as $item)
                        {
                            if (isset($item["itemOnSalePrice"])) {
                                $item["itemPrice"] = $item["itemOnSalePrice"];
                            }

                            $item_total += ($item["itemPrice"]*$item["itemQuantity"]); $totalPrice = 0;
                            $totalPrice += ($item_total +49);

                            ?>

                        <div class="col-md-12 text-info">
                            <strong><?php echo $item["itemName"]; ?></strong>
                            <div class="pull-right"><span><?php echo $item["itemQuantity"]." unit(s)"; ?></span></div>
                        </div> <?php } ?>

                        <hr>

                        <div class="col-md-12">
                            <strong>Subtotal</strong>
                            <div class="pull-right"><span><?php echo "$item_total"; ?></span><span> DKK</span></div>
                        </div>
                        <div class="col-md-12">
                            <strong>Shipping</strong>
                            <div class="pull-right"><span>+49 DKK</span></div>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <strong style="text-decoration: underline;">Order Total</strong>
                            <div class="pull-right"style="text-decoration: underline;"><span id="amount"><?php echo "$totalPrice"; ?></span><span> DKK</span></div>
                            <hr>
                        </div>


                        <button type="submit" class="btn btn-info btn-lg btn-block">Complete payment</button>

                    </div>

                </div>

            </div>
        </div>
    </div>

</form>
</body>
<?php require_once("partials/footer.php");
