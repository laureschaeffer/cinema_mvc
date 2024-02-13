<?php

// connexion à la bdd grace a pdo

namespace Model;

abstract class Connect {

    const HOST = "localhost";
    const DB = "cinema_laure";
    const USER = "root" ;
    const PASS = "";

    public static function seConnecter(){
        // try {
        //     return new \PDO(
        //         "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
        // } catch (\PDOException $ex){
        //     return $ex->getMessage();
        // }

        try
            {
	            $mysqlClient = new PDO('mysql:host=localhost;dbname=cinema_laure;charset=utf8', 'root', '');
	            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // pour afficher les erreurs

        }
        catch (Exception $e)
        {
        die('Erreur : ' . $e->getMessage());
        }

    }

}