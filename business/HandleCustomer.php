<?php
 require_once('../persistence/CustomerDAO.php');
 spl_autoload_register(function ($class)
{include $class.".php";});
$session = new HandleSession();
$cDAO = new CustomerDAO();


if (isset($_GET["action"])) {
    $action = $_GET["action"];

    // SIGN UP USER

    if ($action == "create") {


        $firstName = htmlspecialchars($_POST["firstName"]);
        $lastName = htmlspecialchars($_POST["lastName"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $token = $_POST["token"];
        //$street = htmlspecialchars($_POST[""]);
        //$postalCode = htmlspecialchars($_POST[""]);
        //$country = htmlspecialchars($_POST[""]);

        if ($_SESSION["token"] == $token) {
            if (isset($email)) {
                // Validate e-mail
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo("$email is not a valid email address");
                } else {

                    $cDAO->createCustomer($firstName, $lastName, $email, $password);

                    // Run the function that logs in the user automatically after signing up
                    $cDAO->login($email, $password);

                    // Redirect the user after register & login
                    $redirect = new RedirectUser("../presentation/index.php");
                }
            }
        } else {
            echo "INVALID TOKEN";
        }

    }


    // SIGN IN USER

    if ($action == "login") {
        $email = htmlspecialchars($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Please enter a valid email address!";
        }

        $password = htmlspecialchars($_POST["password"]);
        $statusCode = $cDAO->login($email, $password);

        // Displaying the user status code messages..

        switch ($statusCode) {
            case $statusCode == 1:
                // Redirect the user after logging in
                $redirect = new RedirectUser("../presentation/index.php");
            case  $statusCode == -1;
                echo "Email/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
                break;
            case $statusCode == -2:
                echo "No such Email in the database.<br />
				Please make sure your caps lock key is off and try again.";
                break;

        }
    }

    // LOG OUT USER

    if ($action == "logout") {
        $cDAO->logout();

    }

    // DELETE USER 

    if ($action == "delete") {


            $cDAO->deleteCustomer();
            $redirect = new RedirectUser("../presentation/adminDashboard.php");


    }


    // CREATE BILLING ADDRESS FOR USER

    if ($action == "createBillingAddress") {

        $street = htmlspecialchars($_POST["bStreet"]);
        $code = htmlspecialchars($_POST["bCode"]);
        $postalCode = htmlspecialchars($_POST["bCode"]);
        $city = htmlspecialchars($_POST["bCity"]);
        $country = htmlspecialchars($_POST["bCountry"]);

        $cDAO->createCustomerBillingAddress($code, $city, $street, $postalCode, $country);
        $redirect = new RedirectUser("../presentation/customerDashboard.php");

    }
}

        // REDIRECT USER TO PROVIDING ADDRESS PAGE IF ADDRESS IS NOT SET IN THE SESSION
