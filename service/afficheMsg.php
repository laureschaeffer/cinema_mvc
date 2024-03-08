<?php
//fichier pour la fonction afficher un message après une interraction
namespace Service;

class Message{

    public function showMessage(){ 
        if(!isset($_SESSION["messages"]) || empty($_SESSION["messages"])) {
    
        } else{
            return $_SESSION["messages"][0]; //affiche le message
            unset($_SESSION["messages"][0]); //puis le supprime pour toujours garder l'index 0 
        } 
    }



}
