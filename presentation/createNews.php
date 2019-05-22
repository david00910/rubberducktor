<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>

<!-- Product Handler -->
<?php require_once("../business/HandleNews.php");?>

<body>

<div class="container bg-light shadow p-3 mb-5 bg-white rounded">


    <h2 class="text-center mt-4">Creating news</h2>



    <form enctype="multipart/form-data" method="POST" action="../business/HandleNews.php?action=create">

        <div class="input-group mb-3 mt-5">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
            </div>
            <input type="text" name="title"   class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Preview</span>
            </div>
            <input type="text" name="preview" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>


        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Text</span>
            </div>
            <input type="text" name="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Author</span>
            </div>
            <input type="text" name="author" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-lg btn-info" name="submit" value="Create news" />
        </div>

    </form>

</div>




</body>
<?php require_once("partials/footer.php"); ?>