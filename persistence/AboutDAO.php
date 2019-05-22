<?php

spl_autoload_register(function ($class)
{include $class.".php";});

class AboutDAO {

    public function __construct()
    {

    }

    public function readCompany() {

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM company");
        $query->execute();
        $getAbout = $query->fetchAll();

        return $getAbout;
    }

    public function editCompany($name, $email, $phone, $description, $street, $city, $postalCode, $openingH, $openingD) {

        try {


            $db = new dbCon();
            $name = trim(htmlspecialchars($_POST["name"]));
            $email = trim(htmlspecialchars($_POST["email"]));
            $phone = trim(htmlspecialchars($_POST["phone"]));
            $description = trim(htmlspecialchars($_POST["description"]));
            $street = trim(htmlspecialchars($_POST["street"]));
            $city = trim(htmlspecialchars($_POST["city"]));
            $postalCode = trim(htmlspecialchars($_POST["postalCode"]));
            $openingH = trim(htmlspecialchars($_POST["openingH"]));
            $openingD = trim(htmlspecialchars($_POST["openingD"]));



                $sql = $db->dbCon->prepare("UPDATE `company`  SET companyName = :companyName,
                                                 companyEmail = :companyEmail,
                                                  companyPhone = :companyPhone,
                                                   companyDescription = :companyDescription,
                                                     companyStreet = :companyStreet,
                                                      companyCity = :companyCity,
                                                       companyPostal = :companyPostal, 
                                                       companyOpeningH = :companyOpeningH,
                                                       companyOpeningD = :companyOpeningD
            WHERE id = '{$_GET["id"]}'");

                $sql->bindParam(':companyName', $name);
                $sql->bindParam(':companyEmail', $email);
                $sql->bindParam(':companyPhone', $phone);
                $sql->bindParam(':companyDescription', $description);
                $sql->bindParam(':companyStreet', $street);
                $sql->bindParam(':companyCity', $city);
                $sql->bindParam(':companyPostal', $postalCode);
                $sql->bindParam(':companyOpeningH', $openingH);
                $sql->bindParam(':companyOpeningD', $openingD);
                $sql->execute();
                $db->DBClose();



        }
        catch (\PDOException $ex){
            print($ex->getMessage());
            var_dump($ex);
        }
    }

}




?>