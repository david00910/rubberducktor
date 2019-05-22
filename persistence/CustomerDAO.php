<?php
spl_autoload_register(function ($class)
{include $class.".php";});


class CustomerDAO
{

    public $message;
    public function __construct()
    {

    }

     // Database insertion for creating a user
    public function createCustomer($firstName, $lastName, $email, $password) {

        try {


         //Saving input into variables coming from the business layer & hashing PW

        $db = new dbCon();
        $firstName = trim(htmlspecialchars($firstName));
        $lastName = trim(htmlspecialchars($lastName));
        $email = trim(htmlspecialchars($email));
        $pass = trim(htmlspecialchars($password));
        $iterations = ['cost' => 15];
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT, $iterations);

        // Data insertion with prepared statements (security) We are only creating an ID for the address table, thus the user can add the rest later.

            $query = $db->dbCon->prepare("INSERT INTO `address` (street, postalCode, country) VALUES 
                (:street, :postalCode, :country)");
            $query->bindParam(':street', $f);
            $query->bindParam(':postalCode', $g);
            $query->bindParam(':country', $h);
            $query->execute();

                $found_address = $db->dbCon->lastInsertId();
                $int = (int)$found_address;
                var_dump($int);

                // Data insertion for the customer table

                    $sql = $db->dbCon->prepare( "INSERT INTO `customer` (firstName, lastName, email, password, addressID) VALUES 
                (:firstName, :lastName, :email, :password, :addressID)");
                    $sql->bindParam(':firstName', $firstName);
                    $sql->bindParam(':lastName', $lastName);
                    $sql->bindParam(':email', $email);
                    $sql->bindParam(':password', $hashed_password);
                    $sql->bindParam(':addressID', $int);
                    $sql->execute();

                    $db->DBClose();

        }
        catch (\PDOException $ex){
            print($ex->getMessage());
            var_dump($ex);
        }


    }

    // Database insertion for creating a user and starting a new session with the data fetched from the DB

    public function login($email, $password) {


        $db = new dbCon();
        $email = trim(htmlspecialchars($email));
        $pass = trim(htmlspecialchars($password));

        $query = $db->dbCon->prepare("SELECT CustomerID, firstName, lastName, email, password, isAdmin, avatar_url, addressID 
        FROM customer WHERE email = '{$email}'  LIMIT 1");
        if($query->execute()) {
            $found_user = $query->fetchAll();
            if (count($found_user) == 1) // Once the password is verified coming from the fetched array all the user data is getting stored in a new session.
            {
                if (password_verify($pass, $found_user[0]['password'])) {
                    $_SESSION['CustomerID'] = $found_user[0]['CustomerID'];
                    $_SESSION['firstName'] = $found_user[0]['firstName'];
                    $_SESSION['lastName'] = $found_user[0]['lastName'];
                    $_SESSION['email'] = $found_user[0]['email'];
                    $_SESSION['isAdmin'] = $found_user[0]['isAdmin'];
                    $_SESSION['avatarImg_url'] = $found_user[0]['avatar_url'];
                    $_SESSION['addressID'] = $found_user[0]['addressID'];
                    $_SESSION['city'] = $found_user[0]['city'];
                    $_SESSION["street"] = $found_user[0]["street"];
                    $_SESSION["postalCode"] = $found_user[0]["postalCode"];
                    $_SESSION["country"] = $found_user[0]["country"];

                    $statusCode = 1; // Status code for authorized user

                    $sql2 = $db->dbCon->prepare("SELECT customer.CustomerID, customer.addressID, address.street, address.postalCode, address.country, postalcode.city 
                                                    FROM customer 
                                                    INNER JOIN address ON customer.addressID = address.addressID 
                                                    INNER JOIN postalcode ON address.postalCode = postalcode.code 
                                                    WHERE customer.CustomerID = '{$_SESSION["CustomerID"]}'");
                    if ($sql2->execute()) {

                        $found_address = $sql2->fetchAll();

                        if (count($found_address) == 1) {
                            $_SESSION["addressID"] = $found_address[0]["addressID"];
                            $_SESSION["street"] = $found_address[0]["street"];
                            $_SESSION["postalCode"] = $found_address[0]["postalCode"];
                            $_SESSION["country"] = $found_address[0]["country"];
                            $_SESSION['city'] = $found_address[0]['city'];
                        }
                    }
                } else {

                    $statusCode = -1; // User could not be authorized due to wrong Email/Password combo.
                }
            } else {

                $statusCode = -2; // No such email exists in the database

                $db->DBClose();
            }

            return $statusCode;
        }
    }


    public function logout() {

    $_SESSION = array();
    // 3. Destroy the session cookie
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    // 4. Destroy the session
    session_destroy();
    session_unset();

    // 5. redirect
    $redirect = new RedirectUser("../presentation/index.php");

    }

    public function deleteCustomer() {

        try {

            $db = new dbCon();
            $query = $db->dbCon->prepare("DELETE FROM customer WHERE CustomerID = '{$_GET["CustomerID"]}'");
            $query->execute();

            $db->DBClose();
        }

        catch (\PDOException $ex) {

            print($ex->getMessage());
            var_dump($ex);


        }
    }

    // Read function of the users for the admin dashboard.
    public function readCustomers() {

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM customer ORDER BY CustomerID");
        $query->execute();
        $getCustomers = $query->fetchAll();
        $db->DBClose();

        return $getCustomers;


    }

    // Database insertion for customer billing addresses and then setting that data into the session.

    public function createCustomerBillingAddress($code, $city, $street, $postalCode, $country)
    {
        if (isset($_SESSION["CustomerID"])) {

            try {

                $db = new dbCon();

                $street = trim(htmlspecialchars($street));
                $postalCode = trim(htmlspecialchars($postalCode));
                $country = trim(htmlspecialchars($country));
                $code = trim(htmlspecialchars($code));
                $city = trim(htmlspecialchars($city));

                $query = $db->dbCon->prepare("INSERT INTO `postalcode` (code, city) VALUES 
                (:code, :city)");
                $query->bindParam(':code', $code);
                $query->bindParam(':city', $city);
                $query->execute();


                // Updating address table within the already existing row. (that was set upon user creation)

                $sql = $db->dbCon->prepare("UPDATE `address` SET street = :street, postalCode = :postalCode, country = :country 
                WHERE addressID = :addressID");
                $sql->bindParam(':street', $street);
                $sql->bindParam(':postalCode', $postalCode);
                $sql->bindParam(':country', $country);
                $sql->bindParam(':addressID', $_SESSION['addressID']);
                $sql->execute();



                if ($sql->execute()) {
                    $_SESSION['city'] = $city;
                    $_SESSION["street"] = $street;
                    $_SESSION["postalCode"] = $postalCode;
                    $_SESSION["country"] = $country;
                }
                $db->DBClose();
            }

            catch (\PDOException $ex) {

                print($ex->getMessage());
                var_dump($ex);


            }

        }



    }




}