<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

 <!-- Scripts -->
 <?php require_once("partials/scripts.php"); ?>

 <!-- Data Access of Products -->
 <?php require_once('../persistence/ProductDAO.php'); ?>


<body>

    <div class="container bg-light shadow p-3 mb-5 bg-white rounded">
    
    <h2 class="text-center mt-4">Create a product</h2>

    <form enctype="multipart/form-data" method="POST" action="../business/HandleProduct.php?action=create">

    <div class="input-group mb-3 mt-5">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
        </div>
        <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3 mt-4">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
        </div>
        <textarea type="text" name="description" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></textarea>
    </div>

        <div class="input-group mb-3 mt-4">
    <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Size</label>
    </div>
    <select name="size" class="custom-select" id="inputGroupSelect01">
        <option selected>Choose size...</option>
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
        <input type="text" name="originalPrice" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3 mt-4">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">'On Sale' Price (DKK)</span>
        </div>
        <input type="text" name="onSalePrice" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
                <option value="No" selected>No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>




    <div class="form-group">
                    <input type="submit" class="btnSubmit" name="submit" value="Create product" />
                </div>

    </form>

    </div>




</body>
<?php require_once("partials/footer.php"); ?>