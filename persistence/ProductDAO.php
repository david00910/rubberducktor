<?php

spl_autoload_register(function ($class)
{include $class.".php";});

class ProductDAO {

    public function __construct()
    {

    }

    public function readProducts() {

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM product ORDER BY itemOnSalePrice desc");
        $query->execute();
        $getProducts = $query->fetchAll();

        return $getProducts;
    }

    public function readRecommended() {

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM product ORDER BY itemIssueDate desc LIMIT 3");
        $query->execute();
        $getProducts = $query->fetchAll();

        return $getProducts;
    }
  
  public function readFeatured() {

        $db = new dbCon();
        $query = 'CALL SelectFeaturedProducts()';
        $sql = $db->dbCon->prepare($query);
        $sql->execute();
        $getFeatured = $sql->fetchAll();

        return $getFeatured;

    }

    public function countProducts() {

        $db = new dbCon();
        $query = 'CALL TotalProducts()';
        $sql = $db->dbCon->prepare($query);
        $sql->execute();
        $getCount = $sql->fetchAll();

        return $getCount;

    }

    public function getSale() {

        // Selecting from view

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM OnSaleProducts ");
        $query->execute();
        $getSale = $query->fetchAll();

        return $getSale;

    }

    public function readProductForShow() {

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM product WHERE itemID = '{$_GET["itemID"]}'");
        $query->execute();
        $getProduct = $query->fetchAll();

        return $getProduct;
    }

  

    public function readProductForEdit() {

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM product WHERE itemID = '{$_GET["itemID"]}'");
        $query->execute();
        $getProducts = $query->fetchAll();

        return $getProducts;
    }

    public function createProduct($name, $description, $size, $onSalePrice, $price, $image, $isFeatured) {
        try {


            $db = new dbCon();
            $name = trim(htmlspecialchars($name));
            $issueDate = date('Y-m-d H:i:s');
            $description = trim(htmlspecialchars($description));
            $size = trim(htmlspecialchars($size));
            $price = trim(htmlspecialchars($price));
            $onSalePrice = trim(htmlspecialchars($onSalePrice));
            $image = '../includes/images/'.$image["name"];
            $isFeatured = trim(htmlspecialchars($isFeatured));

    
            $sql = $db->dbCon->prepare( "INSERT INTO `product` (itemName, itemIssueDate, itemDescription, itemOnSalePrice, itemPrice, itemSize, itemImg_url, isFeatured) VALUES 
            (:itemName, :itemIssueDate, :itemDescription, :itemOnSalePrice, :itemPrice, :itemSize, :itemImg_url, :isFeatured)");
            
            $sql->bindParam(':itemName', $name);
            $sql->bindParam(':itemIssueDate', $issueDate);
            $sql->bindParam(':itemDescription', $description);
            $sql->bindParam(':itemPrice', $price);
            $sql->bindParam(':itemSize', $size);
            $sql->bindParam(':itemOnSalePrice', $onSalePrice);
            $sql->bindParam(':itemImg_url', $image);
            $sql->bindParam(':isFeatured', $isFeatured);


            $sql->execute();
            
            $db->DBClose();
    
            }
            catch (\PDOException $ex){
                print($ex->getMessage());
                var_dump($ex);
            }
        }

    public function editProduct($name, $description, $size, $onSalePrice, $price, $image, $isFeatured) {
        try {


            $db = new dbCon();
            $name = trim(htmlspecialchars($name));
            $description = trim(htmlspecialchars($description));
            $size = trim(htmlspecialchars($size));
            $price = trim(htmlspecialchars($price));
            $onSalePrice = trim(htmlspecialchars($onSalePrice));
            $image = '../includes/images/'.$image["name"];
            $isFeatured = trim(htmlspecialchars($isFeatured));


            if ($image !== '../includes/images/') {

                $sql = $db->dbCon->prepare("UPDATE `product`  SET itemName = :itemName, itemDescription = :itemDescription, itemOnSalePrice = :itemOnSalePrice, itemPrice = :itemPrice, itemSize = :itemSize, itemImg_url = :itemImg_url, isFeatured = :isFeatured  
            WHERE itemID = '{$_GET["itemID"]}'");

                $sql->bindParam(':itemName', $name);
                $sql->bindParam(':itemDescription', $description);
                $sql->bindParam(':itemPrice', $price);
                $sql->bindParam(':itemSize', $size);
                $sql->bindParam(':itemOnSalePrice', $onSalePrice);
                $sql->bindParam(':itemImg_url', $image);
                $sql->bindParam(':isFeatured', $isFeatured);
                $sql->execute();
                var_dump($sql);
                $db->DBClose();
            }
            else {

                $sql = $db->dbCon->prepare("UPDATE `product`  SET itemName = :itemName, itemDescription = :itemDescription, itemOnSalePrice = :itemOnSalePrice, itemPrice = :itemPrice, itemSize = :itemSize, isFeatured = :isFeatured  
            WHERE itemID = '{$_GET["itemID"]}'");

                $sql->bindParam(':itemName', $name);
                $sql->bindParam(':itemDescription', $description);
                $sql->bindParam(':itemPrice', $price);
                $sql->bindParam(':itemSize', $size);
                $sql->bindParam(':itemOnSalePrice', $onSalePrice);
                $sql->bindParam(':isFeatured', $isFeatured);
                $sql->execute();
                $db->DBClose();

            }

        }
        catch (\PDOException $ex){
            print($ex->getMessage());
            var_dump($ex);
        }
    }
  
   public function deleteProduct() {

        try {

            $db = new dbCon();
            $query = $db->dbCon->prepare("DELETE FROM product WHERE itemID = '{$_GET["itemID"]}'");
            $query->execute();

            $db->DBClose();
        }

        catch (\PDOException $ex) {

            print($ex->getMessage());
            var_dump($ex);


        }
    }

    public function uploadFile() {



        if(($_FILES['image']['type']=="image/jpeg" ||
                $_FILES['image']['type']=="image/pjpeg" ||
                $_FILES['image']['type']=="image/png" ||
                $_FILES['image']['type']=="image/jpg")&& (
                $_FILES['image']['size']< 30000000
            )){
            if ($_FILES['image']['error']>0){
                echo "Error: ". $_FILES['image']['error'];
            }else{
                echo "Name: ".$_FILES['image']['name']."<br>";
                echo "Type: ".$_FILES['image']['type']."<br>";
                echo "Size: ".($_FILES['image']['size']/1024)."<br>";
                echo "Tmp_name: ".$_FILES['image']['tmp_name']."<br>";
                if (file_exists("../includes/images/".$_FILES['image']['name'])){
                    echo "can't upload: ". $_FILES['image']['name']. " Exists";
                }else{
                    move_uploaded_file($_FILES['image']['tmp_name'],
                        "../includes/images/".$_FILES['image']['name']);
                    echo "stored in: ../includes/images/".$_FILES['image']['name'];

                }
            }
        }
    }
 }
    



?>