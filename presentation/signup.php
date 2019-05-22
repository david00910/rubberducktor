<!-- Head -->
    <?php require_once("partials/header.php"); ?>

    <!-- Head -->
    <?php require_once("partials/scripts.php"); ?>

    <!-- Navigation -->
    <?php require_once("partials/main_navigation.php"); ?>

    <!-- Data Access of Customers -->
    <?php require_once('../persistence/CustomerDAO.php');


    ?>

        <!-- SIGN IN-->

<div class="container login-container">
    <div class="row">
        <div class="col-md-6 login-form-1">
            <h3>Sign in</h3>
            <form  method="post" id="target" action="../business/HandleCustomer.php?action=login">
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email *" value="" required />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password *" value="" required />
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" name="submit" value="Sign in" />
                </div>
                
            </form>
        </div>

        <!-- SIGN UP-->

        <div class="col-md-6 login-form-2">
            <h3>Sign up</h3>
            <form method="post" id="target" action="../business/HandleCustomer.php?action=create">
                <div class="form-group">
                    <?php $length = 32;
                    $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length); ?>
                    <input type="hidden"  name="token" value="<?=$_SESSION['token']?>" />
                    <input type="text" class="form-control" name="firstName" placeholder="First name *"  required />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lastName" placeholder="Last name *"  required />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email *"  required/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password *"  required />
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" name="submit" value="Sign up" />
                </div>
                <div class="form-group">
                </div>
            </form>
        </div>
    </div>
</div>
    <?php require_once("partials/footer.php");
   

