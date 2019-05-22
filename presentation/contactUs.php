<!-- Session Handler -->
<?php
require_once("../business/HandleSession.php");?>
<body onload="contactCap()">
<!-- Head -->
<?php require_once("partials/header.php"); ?>

<!-- Navigation -->
<?php require_once("partials/main_navigation.php"); ?>




<!-- Email Handler -->
<?php
require_once("../business/HandleEmail.php");

if(!empty($_GET['message'])) {

$message = $_GET['message'];

echo "<div class=\"alert alert-warning text-center\" role=\"alert\">"
.$message.
"</div>"; }

?>

<!-- Data Access of Products -->
<?php
require_once("../persistence/AboutDAO.php");
require_once("../business/RedirectUser.php");
$aDAO = new AboutDAO();
$address = $aDAO->readCompany();

?>

<!-- Page Content -->

<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>


<div class="container bg-light shadow p-3 mb-5 bg-white rounded">

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Write us, <?php echo $_SESSION['firstName']; ?>!
                    </div>
                    <div class="card-body">
                        <form method="POST" id="contactUs" action="../business/HandleEmail.php?action=contact">
                            <div class="form-group">
                                <label for="name">Full name</label>
                                <input type="text"  name="fullname" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Your email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="subject">Your subject</label>
                                <input type="text"  name="subject" class="form-control" id="subject" aria-describedby="emailHelp" placeholder="Enter subject" required>
                                <small id="subjectHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="message">Your message</label>
                                <textarea class="form-control"  name="message" id="message" rows="6" required></textarea>
                            </div>
							
                           <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                            <div class="mx-auto">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary text-right">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                    <div class="card-body">
                        <?php foreach ($address as $data) { ?>


                            <p><?php echo $data["companyStreet"] ?></p>
                            <p><?php echo $data["companyPostal"].", ".$data["companyCity"] ?></p>
                            <p><?php echo $data["companyEmail"] ?></p>
                            <p><?php echo $data["companyPhone"] ?></p>

                       <?php } ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->
<?php require_once("partials/scripts.php"); ?>

</body>
<?php require_once("partials/footer.php"); ?>
