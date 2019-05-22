<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>

<!-- Product Handler -->
<?php require_once("../business/HandleProduct.php");?>

<!-- Data Access of Products -->
<?php require_once('../persistence/ProductDAO.php');
$pDAO = new ProductDAO();
$getProducts = $pDAO->readProductForEdit();
?>



<body>

<div class="container bg-light shadow p-3 mb-5 bg-white rounded">

    <?php foreach ($getProducts as $item) { } ?>

    <h2 class="text-center mt-4">Editing product #<?php echo $_GET["itemID"].": ".$item["itemName"] ?></h2>



    <form enctype="multipart/form-data" method="POST" action="../business/HandleProduct.php?action=edit&itemID=<?php echo $_GET["itemID"]?>">

        <div class="input-group mb-3 mt-5">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
            </div>
            <input type="text" name="name" value="<?php echo $item["itemName"] ?>"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
            </div>
            <input type="text" name="description" value="<?php echo $item["itemDescription"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Size</label>
            </div>
            <select name="size" class="custom-select" id="inputGroupSelect01">
                <option selected><?php echo $item["itemSize"] ?></option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="ExXxtra Large">ExXxtra Large</option>
            </select>
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Price (DKK)</span>
            </div>
            <input type="text" name="originalPrice" value="<?php echo $item["itemPrice"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">'On Sale' Price (DKK)</span>
            </div>
            <input type="text" name="onSalePrice" value="<?php echo $item["itemOnSalePrice"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>


        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Image</span>
            </div>
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Featured item?</label>
            </div>
            <select name="isFeatured" class="custom-select" id="inputGroupSelect01">
                <option value="No" selected><?php if($item["isFeatured"] == 0) { echo "No"; } elseif ($item["isFeatured"] == 1) { echo "Yes"; } ?></option>
                <?php if($item["isFeatured"] == 0)
                { echo "<option value=\"Yes\">Yes</option>"; }
                elseif ($item["isFeatured"] == 1)
                { echo "<option value=\"No\">No</option>"; } ?>

            </select>
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-lg btn-info" name="submit" value="Edit product" />
        </div>

    </form>

</div>




</body>
<?php require_once("partials/footer.php"); ?>