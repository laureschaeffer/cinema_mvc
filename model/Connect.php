<?php

// connexion à la bdd grace a pdo

namespace Model;

abstract class Connect {

    const HOST = "localhost"; 
    const DB = "cinema_laure";
    const USER = "root" ;
    const PASS = "";

    public static function seConnecter(){
        try {
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
                die;
        } catch (\PDOException $ex){
            return $ex->getMessage();
        }

        // catch (Exception $e)
        // {
        // die('Erreur : ' . $e->getMessage());
        // }

    }

}