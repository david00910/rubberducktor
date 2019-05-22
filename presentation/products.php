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
    
<!-- Image Slider Header with Featured Content -->

    <?php require_once("partials/featured.php"); ?>

<div class="container bg-light shadow p-3 mb-5 bg-white rounded">





        <?php


        $pDAO = new ProductDAO();
        $cartDAO = new cartDAO();
        $getProducts = $pDAO->readProducts();
        $getRecommended = $pDAO->readRecommended(); 
  		$getCount = $pDAO->countProducts(); ?>

    <small>Total products: <?php

        foreach ($getCount as $count) {
            echo $count["count(*)"];
        }

        ?></small>


        <h3 class="h3">Check out our new products!</h3>
    <div class="container d-inline-flex" style="background-color: #e3e7ed">

         <?php foreach ($getRecommended as $recommended) { ?>

             <div class="col-md-3 col-sm-6 mt-5">
                 <div class="product-grid6">
                     <div class="product-image6">
                         <a href="showProduct.php?itemID=<?php echo $recommended['itemID']; ?>">
                             <img class="pic-1" src="<?php echo $recommended['itemImg_url']; ?>">
                         </a>
                     </div>
                     <div class="product-content">
                         <h3 class="title"><a href="<?php $recommended['itemID']; ?>"><?php echo $recommended['itemName']; ?></a></h3>

                         <?php if ($recommended['itemOnSalePrice'] <= 0)

                         {
                             echo "<div class='price' id='original'>".$recommended['itemPrice']." DKK</div>";
                         }
                         else
                         {
                             echo "<div style='text-decoration: line-through'>".$recommended['itemPrice']."</div>";
                         } ?>

                         <div id='onSale' class='h4 bg-info text-light'>
                             <?php if ($recommended['itemOnSalePrice'] > 0)
                             {
                                 echo  "ON SALE! ".$recommended['itemOnSalePrice']. "<span class='text-light'> DKK</span>";
                             }
                             ?></div>


                     </div>
                     <ul class="social">
                         <?php echo " <form method=\"post\" action=\"products.php?action=add&itemID=" . $recommended['itemID']."\">
                    <li class='align-middle'><input class='input-group-text' type=\"text\" name=\"quantity\" value=\"1\" size=\"2\" placeholder='Quantity' /></li>
                    <li class='mt-3'><button class='btn btn-info' type='submit' data-tip=\"Add to Cart\"><i class=\"fa fa-shopping-cart\"></i></button></li>
                    </form>"; ?>
                     </ul>
                 </div>
             </div>

          <?php  } ?>
    </div>
    <div class="row">

        <h3 class="h3 mt-5 mb-5">Choose your own duck! </h3>

           <?php foreach ($getProducts as $getProduct) { ?>




                <div class="col-md-3 col-sm-6 mt-5">
            <div class="product-grid6">
                <div class="product-image6">
                    <a href="showProduct.php?itemID=<?php echo $getProduct['itemID']; ?>">
                        <img class="pic-1" src="<?php echo $getProduct['itemImg_url']; ?>">
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="<?php $getProduct['itemID']; ?>"><?php echo $getProduct['itemName']; ?></a></h3>

                    <?php if ($getProduct['itemOnSalePrice'] <= 0)

                    {
                        echo "<div class='price' id='original'>".$getProduct['itemPrice']." DKK</div>";
                    }
                    else
                        {
                            echo "<div style='text-decoration: line-through'>".$getProduct['itemPrice']."</div>";
                        } ?>

                        <div id='onSale' class='h4 bg-info text-light'>
                            <?php if ($getProduct['itemOnSalePrice'] > 0)
                            {
                                echo  "ON SALE! ".$getProduct['itemOnSalePrice']. "<span class='text-light'> DKK</span>";
                            }
                        ?></div>
                    

                </div>
                <ul class="social">
                    <?php echo " <form method=\"post\" action=\"products.php?action=add&itemID=" . $getProduct['itemID']."\">
                    <li class='align-middle'><input class='input-group-text' type=\"text\" name=\"quantity\" value=\"1\" size=\"2\" placeholder='Quantity' /></li>
                    <li class='mt-3'><button class='btn btn-info' type='submit' data-tip=\"Add to Cart\"><i class=\"fa fa-shopping-cart\"></i></button></li>
                    </form>"; ?>
                </ul>
            </div>
        </div>
        <?php

            }

        ?>


    </div>
</div>



 </body>
 <?php require_once("partials/footer.php"); ?>