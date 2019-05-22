<?php require_once('../persistence/CustomerDAO.php'); ?>
<?php require_once('../business/HandleSession.php'); ?>
<?php require_once('header.php'); ?>
<?php $user = new CustomerDAO();
$session = new HandleSession();?>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow navbar sticky-top" class="navigation">
  <div class="container-fluid">
    <a class="navbar-brand" href="../presentation/index.php">RubberDucktor</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto mr-4">
        <li class="nav-item">
          <a class="nav-link" href="../presentation/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../presentation/products.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../presentation/aboutUs.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../presentation/contactUs.php">Contact</a>
        </li>
        
        

      </ul>

        <div style="height: 3rem; background-color: rgba(0,0,0,0.2); width: 1px;"></div>

  <?php if (isset($_SESSION['CustomerID']) && isset($_SESSION['isAdmin'])) {

    $user = $_SESSION["firstName"];
    $admin = $user." <p class='text-danger'>Admin</p>";



        if ($_SESSION['isAdmin'] == 1) {

            echo "<br><div style=\"padding-left:20px;\" class=\"btn-group ml-4\">
    
    <button type=\"button\" class=\"btn btn-light dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
    
    <span><i style='vertical-align: middle;' class=\"material-icons\">
tag_faces
</i> Welcome, " . $admin . "
    </span></button>
    <div class=\"dropdown-menu dropdown-menu-right\">
      <button class=\"dropdown-item\" type=\"button\"><a href=\"../presentation/adminDashboard.php\">Admin Dashboard</a></button>
      <button class=\"dropdown-item\" type=\"button\"><a href=\"../presentation/customerDashboard.php\">My Profile</a></button>
      
      <hr>
      <button class=\"dropdown-item\" type=\"button\"><a href=\"../business/HandleCustomer.php?action=logout\">Logout</a></button>
    </div>
      </div><span class='ml-3'><a class='btn btn-info' href='../presentation/cart.php'><i class=\"material-icons align-middle\">
    shopping_cart
    </i>
    </a></span>";
            }


  elseif ($_SESSION['isAdmin'] == 0) {
    echo "<br><div style=\"padding-left:20px;\" class=\"btn-group\">
    <button type=\"button\" class=\"btn btn-light dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
    <span><i style='vertical-align: middle;' class=\"material-icons\">
tag_faces
</i> Welcome, ". $user."
 
    </span></button>
    <div class=\"dropdown-menu dropdown-menu-right\">
      <button class=\"dropdown-item\" type=\"button\"><a href=\"../presentation/customerDashboard.php\">My Profile</a></button>
      
      <hr>
      <button class=\"dropdown-item\" type=\"button\"><a href=\"../business/HandleCustomer.php?action=logout\">Logout</a></button>
    </div>
  </div>
  </div><span class='ml-3'><a class='btn btn-info' href='../presentation/cart.php'><i class=\"material-icons align-middle\">
    shopping_cart
    </i>
    </a></span>";
  }

  } else {
      echo "<span class='ml-4'><a href=\"../presentation/signup.php\"><i style='vertical-align: middle;'class=\"material-icons\">
https
</i> Sign in</a></span>";
  }
  ?>

  
    </div>
  </div>
</nav>

