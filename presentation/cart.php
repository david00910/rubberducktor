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

<!-- Cart Handler -->
<?php require_once("../business/HandleCart.php");?>

<!-- Data Access of Cart -->
<?php require_once('../persistence/CartDAO.php'); ?>


<body>

<div class="container bg-light shadow p-3 mb-5 bg-white rounded">
    <div id="shopping-cart">
<h4 class="mb-5">My Cart <br></h4>
<?php
//Reset total cost to do recalc
if(isset($_SESSION["cartItem"])){
    $item_total = 0;
?>

<div class="container text-center">

    <table class="table" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th><strong>Image</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Code</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Price</strong></th>
                <th><strong>Action</strong></th>
            </tr>
    <?php

        foreach ($_SESSION["cartItem"] as $item){

            if (isset($item["itemOnSalePrice"])) {
                $item["itemPrice"] = $item["itemOnSalePrice"];
            }


            ?>
                    <tr>
                        <td><img class=\"pic-1\" width="80" height="80" src="<?php echo $item['itemImg_url']?>"></td>
                        <td><strong><?php echo $item["itemName"]; ?></strong></td>
                        <td><?php echo $item["itemID"]; ?></td>
                        <td><a class='text-info' href="cart.php?action=decrease&itemID=<?php echo $item["itemID"]; ?>"><span class="btn btn-sm btn-outline-dark mr-2">-</span></a><?php echo $item["itemQuantity"]; ?><a class='text-info' href="cart.php?action=increase&itemID=<?php echo $item["itemID"]; ?>"><span class="btn btn-sm btn-outline-dark ml-2">+</span></a></td>
                        <td><?php
                            echo $item["itemPrice"]." DKK";
                         ?></td>
                        <td><a href="cart.php?action=remove&itemID=<?php echo $item["itemID"]; ?>" class="removeBtn"><i class="material-icons">
                        remove_shopping_cart
                        </i></a></td>
                    </tr>
            <?php

            $item_total += ($item["itemPrice"]*$item["itemQuantity"]);
        }
            ?>


            <td class='text-info mb-5' colspan="5" align=right><strong>Total:</strong> <?php echo $item_total." DKK"; ?></td>

        </tbody>

    </table>

</div>
<div class="container text-right">
<a id="emptyBtn" class="btn btn-danger mt-3 mb-3" href="cart.php?action=empty">Empty Cart</a>
<a id="emptyBtn" class="btn btn-info mt-3 mb-3" href="checkout.php">Go to checkout</a>
</div>
</div>


</body>
<?php require_once("partials/footer.php");}
else
    {
        echo "<h6 class='text-center'>Your cart is empty. <br/> <a href='products.php'>Visit the shop :)</a></h6>";
    }

    var_dump($_SESSION["cartItem"]);
    ?>