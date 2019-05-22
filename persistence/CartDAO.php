<?php

spl_autoload_register(function ($class)
{include $class.".php";});

class CartDAO
{

    public $newItemArray;
    /*public function existingCart($existingItems)
    {
        if (!empty($existingItems)) {
            $this->itemArray["cartItem"] = $existingItems;
        }
    }*/
    public function cartAdd($id, $quantity)
    {
        $db = new dbCon();
        if (!empty($quantity)) {
            $sql = $db->dbCon->prepare("SELECT * FROM product WHERE itemID = " . $id);
            $sql->execute();
            $productById = $sql->fetchAll();

            if (!empty($productById[0]["itemOnSalePrice"]) && $productById[0]["itemOnSalePrice"] !== 0) {

                $this->newItemArray = array(
                    'itemName' => $productById[0]["itemName"],
                    'itemID' => $productById[0]["itemID"],
                    'itemQuantity' => $_POST["quantity"],
                    'itemImg_url' => $productById[0]["itemImg_url"],
                    'itemOnSalePrice' => $productById[0]["itemOnSalePrice"]
                );
            }
            else {

                $this->newItemArray = array(
                    'itemName' => $productById[0]["itemName"],
                    'itemID' => $productById[0]["itemID"],
                    'itemQuantity' => $_POST["quantity"],
                    'itemPrice' => $productById[0]["itemPrice"],
                    'itemImg_url' => $productById[0]["itemImg_url"]
                );


            }


        }
        $db->DBClose();
    }

}
