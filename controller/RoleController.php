<?php
// fichier qui récupère les fonctions du manager
namespace Controller;
use Model\Connect;
use Model\RoleManager;

class RoleController{
    //liste des roles avec leur film et acteurs
    public function listRole($id){
        $pdo = Connect::seConnecter();
        $roleManager = new RoleManager();

        $roles = $roleManager->listRole($id);

        require "view/film/listeRole.php"; 
    }
}