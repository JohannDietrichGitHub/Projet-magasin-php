<?php
session_start();
  include_once "connection.php";
  include_once "fonctions.php";

  if(!empty($_POST)){   /* vérifie si le formulaire a été envoyé */
    enlev_quant_panier($conn);
  }
?>