<?php

spl_autoload_register(function ($class)
{include $class.".php";});

class NewsDAO {

    public function __construct()
    {

    }

    public function readNews() {

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM news ORDER BY newsDate desc");
        $query->execute();
        $getNews = $query->fetchAll();

        return $getNews;
    }

    public function readNewsForEdit() {

        $db = new dbCon();
        $query = $db->dbCon->prepare("SELECT * FROM news WHERE id = '{$_GET["id"]}'");
        $query->execute();
        $getNews = $query->fetchAll();

        return $getNews;
    }

    public function createNews($nTitle, $nPreview, $nText, $nAuthor) {

        try {


            $db = new dbCon();
            $nTitle = trim(htmlspecialchars($_POST["title"]));
            $nPreview = trim(htmlspecialchars($_POST["preview"]));
            $nText = trim(htmlspecialchars($_POST["text"]));
            $nAuthor = trim(htmlspecialchars($_POST["author"]));
            $nDate = date('Y-m-d H:i:s');




            $sql = $db->dbCon->prepare("INSERT INTO `news` (newsTitle, newsPreview, newsText, newsAuthor,
                                                  newsDate) VALUES (:newsTitle, :newsPreview, :newsText, :newsAuthor, :newsDate)");

            $sql->bindParam(':newsTitle', $nTitle);
            $sql->bindParam(':newsPreview', $nPreview);
            $sql->bindParam(':newsText', $nText);
            $sql->bindParam(':newsAuthor', $nAuthor);
            $sql->bindParam(':newsDate', $nDate);
            $sql->execute();
            $db->DBClose();



        }
        catch (\PDOException $ex){
            print($ex->getMessage());
            var_dump($ex);
        }
    }


    public function editNews($nTitle, $nPreview, $nText, $nAuthor) {

        try {


            $db = new dbCon();
            $nTitle = trim(htmlspecialchars($_POST["title"]));
            $nPreview = trim(htmlspecialchars($_POST["preview"]));
            $nText = trim(htmlspecialchars($_POST["text"]));
            $nAuthor = trim(htmlspecialchars($_POST["author"]));





            $sql = $db->dbCon->prepare("UPDATE `news`  SET newsTitle = :newsTitle,
                                                 newsPreview = :newsPreview,
                                                  newsText = :newsText,
                                                   newsAuthor = :newsAuthor
            WHERE id = '{$_GET["id"]}'");

            $sql->bindParam(':newsTitle', $nTitle);
            $sql->bindParam(':newsPreview', $nPreview);
            $sql->bindParam(':newsText', $nText);
            $sql->bindParam(':newsAuthor', $nAuthor);
            $sql->execute();
            $db->DBClose();



        }
        catch (\PDOException $ex){
            print($ex->getMessage());
            var_dump($ex);
        }
    }

    public function deleteNews() {

        try {

            $db = new dbCon();
            $query = $db->dbCon->prepare("DELETE FROM news WHERE id = '{$_GET["id"]}'");
            $query->execute();

            $db->DBClose();
        }

        catch (\PDOException $ex) {

            print($ex->getMessage());
            var_dump($ex);


        }
    }

}




?>