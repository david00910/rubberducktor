<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>
<?php

$nDAO = new NewsDAO();
$getNews = $nDAO->readNewsForEdit();
?>



<body>

<div class="container bg-light shadow p-3 mb-5 bg-white rounded">

    <?php foreach ($getNews as $item) { } ?>

    <h2 class="text-center mt-4">Editing news #<?php echo $_GET["id"].": ".$item["newsTitle"] ?></h2>



    <form enctype="multipart/form-data" method="POST" action="../business/HandleNews.php?action=edit&id=<?php echo $_GET["id"]?>">

        <div class="input-group mb-3 mt-5">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
            </div>
            <input type="text" name="title" value="<?php echo $item["newsTitle"] ?>"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Preview</span>
            </div>
            <input type="text" name="preview" value="<?php echo $item["newsPreview"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>


        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Text</span>
            </div>
            <input type="text" name="text" value="<?php echo $item["newsText"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Author</span>
            </div>
            <input type="text" name="author" value="<?php echo $item["newsAuthor"] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-lg btn-info" name="submit" value="Edit news" />
        </div>

    </form>

</div>




</body>
<?php require_once("partials/footer.php"); ?>