<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>

<!-- Data Access of Products -->
<?php require_once('../persistence/ProductDAO.php'); ?>

<!-- Data Access of Cart -->
<?php require_once('../persistence/CartDAO.php'); ?>

<!-- Cart Handler -->
<?php require_once("../business/HandleCart.php");?>

<!-- Session Handler -->
<?php require_once("../business/HandleSession.php");?>


<body>




        <?php


        $pDAO = new ProductDAO();
        $cartDAO = new cartDAO();
        $getProduct = $pDAO->readProductForShow();

        foreach ($getProduct as $product) { } ?>

        <div class="container bg-light shadow p-3 mb-5 bg-white rounded">

                <div class="row">
                    <div class="col-sm-7 item-photo">
                        <img width="50%" src="<?php echo $product["itemImg_url"] ?>" />
                    </div>
                    <div class="col-sm-5">

                        <h3><?php echo $product["itemName"] ?></h3>
                        <h5 style="color:#337ab7"><?php echo $product["itemDescription"] ?></h5>

                        <?php if ($product["isFeatured"] == 1) {

                            echo "<h3 class='bg-info text-light text-center'>FEATURED</h3>";

                        } ?>

                        <h6 class="title-attr" style="margin-top:15px;" ><small>PRICE</small></h6>
                        <?php if ($product['itemOnSalePrice'] <= 0)

                        {
                            echo "<div class='price' id='original'>".$product['itemPrice']." DKK</div>";
                        }
                        else
                        {
                            echo "<div style='text-decoration: line-through'>".$product['itemPrice']." DKK</div>";
                        } ?>

                            <div id='onSale' class='h6 text-info'>
                                <?php if ($product['itemOnSalePrice'] > 0)
                                {
                                    echo  "New: ".$product['itemOnSalePrice']. "<span class='text-info'> DKK</span>";
                                }
                                ?>
                            </div>


                                <h6 class="" style="margin-top:15px;" ><small>SIZE</small></h6>

                                    <div class="text-info text-center"><?php echo $product["itemSize"] ?></div>

                                <hr>
                                    <?php echo " <form method=\"post\" action=\"showProduct.php?action=add&itemID=" . $product['itemID']."\">
                                    <input class='input-group-text' type=\"text\" name=\"quantity\" value=\"1\" size=\"2\" placeholder='Quantity' />
                                    <br><button class='btn btn-info btn-block btn-lg' type='submit' data-tip=\"Add to Cart\"><i class=\"fa fa-shopping-cart\"></i></button>
                                    </form>"; ?>


                        </div>

                    </div>

                </div>
        </div>



</body>
<?php require_once("partials/footer.php"); ?>