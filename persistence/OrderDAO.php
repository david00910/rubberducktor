<?php

spl_autoload_register(function ($class)
{include $class.".php";});


class OrderDAO
{
    public $ex;

    public function checkout($code, $city, $street, $postalCode, $country, $totalPrice)
    {
        if (isset($_SESSION["CustomerID"]) && isset($_SESSION["cartItem"])) {
            $last_id = null;


            try {



                $street = trim(htmlspecialchars($street));
                $postalCode = trim(htmlspecialchars($postalCode));
                $country = trim(htmlspecialchars($country));
                $code = trim(htmlspecialchars($code));
                $city = trim(htmlspecialchars($city));

                if (!empty($street) && !empty($code)) {

                    $db = new dbCon();

                    $query = $db->dbCon->prepare("INSERT INTO `postalcode` (code, city) VALUES 
                    (:code, :city)");
                    $query->bindParam(':code', $code);
                    $query->bindParam(':city', $city);
                    $query->execute();


                    $sql = $db->dbCon->prepare("INSERT INTO `address` (street, postalCode, country) 
                    VALUES (:street, :postalCode, :country)");
                    $sql->bindParam(':street', $street);
                    $sql->bindParam(':postalCode', $postalCode);
                    $sql->bindParam(':country', $country);

                    $sql->execute();


                }
                //$last_id = null;

                if (isset($_SESSION["cartItem"])) {

                    if (!empty($street) && !empty($code)) {
                        $last_id = $db->dbCon->lastInsertId();
                    }

                    $db = new dbCon();

                        $createdAt = date('Y-m-d H:i:s');

                        $sql1 = $db->dbCon->prepare("INSERT INTO `order` (customerID, shippingAddress, billingAddress, createdAt, orderPrice) VALUES
                        (:customerID, :shippingAddress, :billingAddress, :createdAt, :orderPrice)");
                        $sql1->bindParam(':customerID', $_SESSION['CustomerID']);
                        $sql1->bindParam(':shippingAddress', $last_id);
                        $sql1->bindParam(':billingAddress', $_SESSION['addressID']);
                        $sql1->bindParam(':createdAt', $createdAt);
                        $sql1->bindParam('orderPrice', $totalPrice);
                        $sql1->execute();



                        $last_id_1 = $db->dbCon->lastInsertId();


                        $query = $db->dbCon->prepare("INSERT INTO `orderline` (orderID, itemID, OrderQuantity) VALUES
                        (:orderID, :itemID, :OrderQuantity)");

                        $query->bindParam('orderID', $last_id_1);
                        foreach ($_SESSION["cartItem"] as $item) {
                            $query->bindParam('itemID', $item['itemID']);
                            $query->bindParam('OrderQuantity', $item['itemQuantity']);
                            $query->execute();
                        }



                        $db->DBClose();

                    }



            }

            catch (\PDOException $ex) {

                print($ex->getMessage());
                var_dump($ex);


            }


        }



    }

    public function readOrders() {


        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM `order`  
                                              INNER JOIN customer ON `order`.CustomerID = customer.CustomerID 
                                              ORDER BY orderID asc ");
        $query->execute();
        $getOrders = $query->fetchAll();
        $db->DBClose();
        return $getOrders;

    }
  
   public function getCompleted() {

        // Selecting from view

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM ShippedOrders ");
        $query->execute();
        $getCompleted = $query->fetchAll();

        return $getCompleted;

    }

    public function getCancelled() {

        // Selecting from view

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM CancelledOrders ");
        $query->execute();
        $getCancelled = $query->fetchAll();

        return $getCancelled;

    }

    public function readOrdersForCustomer() {


        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM `order`  
                                              INNER JOIN customer ON `order`.CustomerID = customer.CustomerID 
                                              WHERE `order`.CustomerID = '{$_SESSION["CustomerID"]}'");
        $query->execute();
        $getOrders = $query->fetchAll();
        $db->DBClose();
        return $getOrders;

    }

    public function processOrders() {


        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM `order`  
                                              INNER JOIN customer ON `order`.CustomerID = customer.CustomerID 
                                              INNER JOIN address ON `order`.billingAddress = address.addressID
                                              INNER JOIN postalcode ON address.postalCode = postalcode.code
                                              WHERE `order`.orderID = '{$_GET["orderID"]}'");
        $query->execute();
        $getOrders = $query->fetchAll();
        $db->DBClose();

        return $getOrders;

    }

    public function getShippingAddresses() {


            $db = new dbCon();
            $query = $db->dbCon->prepare("SELECT * FROM `order`  
                                              INNER JOIN address ON `order`.shippingAddress = address.addressID
                                              INNER JOIN postalcode ON address.postalCode = postalcode.code
                                              WHERE `order`.orderID = '{$_GET["orderID"]}'");
            $query->execute();
            $getShippingA = $query->fetchAll();
            $db->DBClose();


        return $getShippingA;

    }

    public function getItems() {


        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM `orderline`
                                              INNER JOIN `order` on orderline.orderID = `order`.orderID 
                                              INNER JOIN product on orderline.itemID = product.itemID
                                              WHERE `orderline`.orderID = '{$_GET["orderID"]}'");
        $query->execute();
        $getLine = $query->fetchAll();
        $db->DBClose();

        return $getLine;

    }

    public function shipOrder() {
        try {

            $db = new dbCon();
            $sql = $db->dbCon->prepare("UPDATE `order` SET isCompleted = '1' 
                WHERE orderID = '{$_GET["orderID"]}'");
            $sql->execute();
            $db->DBClose();
        }

        catch (\PDOException $ex) {

            print($ex->getMessage());
            var_dump($ex);
        }

    }

    public function cancelOrder() {
        try {

            $db = new dbCon();
            $sql = $db->dbCon->prepare("UPDATE `order` SET isCancelled = '1' 
                WHERE orderID = '{$_GET["orderID"]}'");
            $sql->execute();
            $db->DBClose();
        }

        catch (\PDOException $ex) {

            print($ex->getMessage());
            var_dump($ex);
        }

    }

}