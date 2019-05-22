<body>
    <!-- Head -->
    <?php require_once("partials/header.php"); ?>

    <!-- Data access of Products -->
    <?php require_once("../persistence/ProductDAO.php"); ?>

    <!-- Scripts -->
    <?php require_once("partials/scripts.php"); ?>

    <!-- Data Access of Cart -->
    <?php require_once('../persistence/CartDAO.php'); ?>

    <!-- Data Access of News -->
    <?php require_once('../persistence/NewsDAO.php'); ?>

    <!-- Session Handler -->
    <?php require_once("../business/HandleSession.php");?>

    <!-- Cart Handler -->
    <?php require_once("../business/HandleCart.php");?>



<!-- Navigation -->
    <?php require_once("partials/main_navigation.php");

    if(!empty($_GET['message'])) {

        $message = $_GET['message'];

        echo "<div class=\"alert alert-success text-center\" role=\"alert\">"
            .$message.
        "</div>";


    } ?>

    <!-- Image Slider Header with Vertically Centered Content -->

    <?php require_once("partials/featured.php"); ?>
    <?php
    $pDAO = new ProductDAO();
    $cDAO = new CartDAO();
    $nDAO = new NewsDAO();
    $getNews = $nDAO->readNews();
    $getFeatured = $pDAO->readFeatured();
  	$getRecommended = $pDAO->getSale();

    ?>

    <!-- Page Content -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="font-weight-light">Welcome to Rubberducktor!</h2>
            <h4>We hope you find what you are looking for! Let's start by checking out our <strong class="text-danger">DAILY SPECIAL</strong> and <strong class="text-warning">SEASONALLY FEATURED</strong> ducks!</h4>
            <div class="row">

            <?php  foreach ($getFeatured as $getProduct) { ?>


            <div class="col-md-3 col-sm-6 mt-5 ">
                <div class="product-grid6">
                    <div class="product-image6">
                        <a href="<?php $getProduct['itemID']; ?>">
                            <img class="pic-1"  src="<?php echo $getProduct['itemImg_url'];  ?>">
                        </a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="<?php $getProduct['itemID']; ?>"><?php echo $getProduct['itemName']; ?></a></h3>

                        <?php if ($getProduct['itemOnSalePrice'] <= 0)

                        {
                            echo "<div class='price' id='original'>".$getProduct['itemPrice']." DKK</div> <br>
                                 <div class='h4 bg-danger text-light'>DAILY SPECIAL</div>";
                        }
                        else
                        {
                            echo "<div style='text-decoration: line-through'>".$getProduct['itemPrice']." DKK</div>";
                        } ?>

                        <div id='onSale' class='h4 bg-info text-light'>
                            <?php if ($getProduct['itemOnSalePrice'] > 0)
                            {
                                echo  "ON SALE! ".$getProduct['itemOnSalePrice']. "<span class='text-light'> DKK</span> <br>
                                      <div class='h4 bg-warning text-light'>SEASONALLY FEATURED</div>";
                            }
                            ?></div>


                    </div>
                    <ul class="social">
                        <li><a href="showProduct.php?itemID=<?php echo $getProduct['itemID']; ?>" >View</a></li>

                    </ul>
                </div>
            </div>
            <?php

            }


        ?>

            </div>
          
          <h3 class="h3">Check out our on sale products!</h3>
            <div class="container" style="background-color: #e3e7ed">
                <div class="row">

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
            </div>
          
        </div>
    </section>

    <section class="container">
        <hr>

        <div class="row">

            <div class="col-lg">
                <h4 class="bg-info text-light" style="padding:10px;">News feed</h4>

                <?php foreach ($getNews as $news) { ?>
                <div class="card">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $news["newsTitle"] ?></h5>
                            <p class="card-text"><?php echo $news["newsPreview"] ?></p>
                            <small>Created by <?php echo $news["newsAuthor"] ?>, <?php echo $news["newsDate"] ?></small>
                        </div>
                    <a href="readNews.php?id=<?php echo $news['id']; ?>" class="btn btn-sm text-info">Read More</a>

                </div>
                <?php } ?>

            </div>

        </div>

    </section>




</body>
<?php require_once("partials/footer.php");

