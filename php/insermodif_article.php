<?php       
session_start();

require_once "connection.php";
require_once "fonctions.php";
    // Modification de l'article dans la base de donnée
if(!empty($_POST)){
  modification_article($conn);
}
    ?>