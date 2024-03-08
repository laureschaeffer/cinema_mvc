<?php
//fichier pour la fonction afficher un message après une interraction
namespace Service;

abstract class Message{

    public static function showMessage(){ 
        if(isset($_SESSION["messages"]) || !empty($_SESSION["messages"])) {
            echo $_SESSION["messages"]; //affiche le message
            unset($_SESSION["messages"]); //puis le supprime pour toujours garder l'index 0 
    
        } 
    }



}
