<?php

class dbCon
{
    private $user = "angletech_dk";
    Private $pass = "gdw6exzk";
    public $dbCon;
    public function __construct(){
        $user = $this->user;
        $pass = $this->pass;
        try {
            $this->dbCon = new PDO('mysql:host=mysql43.unoeuro.com; dbname=angletech_dk_db; charset=utf8', $user, $pass);
            return $this->dbCon;
        } catch (PDOException $err) {
            echo "Error!: " . $err->getMessage() . "<br/>";
            die();
        }}
    public function DBClose(){
        $this->dbCon = null;
    }
}