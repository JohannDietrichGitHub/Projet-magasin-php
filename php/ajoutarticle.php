<?php
// Initialize the session
session_start();

?>
<head> 		
    <meta charset="utf-8" /> <!--encodage en utf8-->
	<title>Contact</title>
    <link rel="stylesheet" href="..\css\css.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="..\JS\js.js"></script>
</head>

<header>
  <?php
    require_once ('navbar.php');
  ?>
</header>

<body>
  <?php
    if (isset($_SESSION['alert'])){
      echo "<div class='alert alert-danger' role='alert'>$_SESSION[alert]</div>";
    }
    unset($_SESSION['alert']);
  ?>
  <center>
    <br>
    <label>Ajouter un article</label> <!-- formulaire pour ajouter un article -->
    <br><br> 
    <form class="table" method="POST">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom"  placeholder="Entrez le nom de l'article" required>
      </div>
      <div class="form-group">
        <label for="reference">Reference</label>
        <input type="text" class="form-control" name="reference" id="reference"  placeholder="Entrez la référence" required>
      </div>
      <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" name="prix" id="prix" placeholder="Entrez le prix" required>
      </div>
      <div class="form-group">
        <label for="taxe">Taxe</label>
        <input type="text" class="form-control" name="taxe" id="taxe" placeholder="Entrez la taxe (20 de base)" value=20 required>
      </div>
      <div class="form-group">
        <label for="promotion">promotion</label>
        <input type="text" class="form-control" name="promotion" id="promotion" placeholder="Entrez la promotion (si il y en a une)">
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="nouv" id="nouv">
        <label class="form-check-label" for="nouv">Nouveauté ?</label>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
  </center>




  <?php
  include "connection.php";



  if(isset($_POST['nom'])){   /* vérifie si le formulaire a été envoyé */

    //Défini toutes les variables permettant de vérifier si le formulaire rend des nombres
    $referencenbr = intval($_POST['reference']);

    $prix = intval($_POST['prix']);

    $taxe = intval($_POST['taxe']);

    $promo=null;       

    $stmt = $conn->prepare("SELECT reference FROM articles WHERE reference=:reference");/* cherche dans la BDD si la référence existe déjà */
    $stmt->execute(['reference' => $_POST["reference"]]); 
    $user = $stmt->fetch();
    if (empty($user)){
        $reference = "";
    }
    else { $reference = $user[0]; }

    if (isset($_POST['promotion'])){
      if (is_numeric($_POST['promotion']) OR empty($_POST['promotion'])){
        $promo = intval($_POST['promotion']); //converti automatiquement le string vide en 0
      }
      else {
        $promo="pasunnombre";
      }
    }

    if(isset($_POST['nouv'])){
      $nouv = 1;
    }
    else { 
      $nouv = 0;
    }

    if ($_POST['reference'] == $reference){
      $_SESSION['alert'] = "Référence déjà existante ";
    }
    else if(strlen($_POST['reference']) == 8 AND is_numeric($_POST['reference']) AND $referencenbr >= 0 ) { /* vérifie la taille de la reference, s'il elle est une nombre et si celle-ci n'est pas négative*/
      if (is_numeric($_POST['prix']) AND $prix > 0  ){ /* vérifie si le prix est un nombre et n'est pas négatif */
        if ($taxe >= 0 AND is_numeric($_POST['taxe'])){ 
          if ($promo >= 0 AND is_numeric($promo)){
            $sql = "INSERT INTO articles (nom, reference, prix_ht, taxe, promotion, nouveaute) VALUES (?,?,?,?,?,?)"; //Insertion des donnés
            $conn->prepare($sql)->execute([$_POST['nom'], $_POST['reference'], $_POST['prix'], $_POST['taxe'], $promo, 1]);
            $_SESSION['message'] =$_POST['nom']." à bien été ajouté"; //ajout du message de confirmation

            header("location:articles.php");
          }
          else {
            $_SESSION['alert'] = "la promotion ne peut être qu'un nombre positif";
            header("location:ajoutarticle.php");
          }
        }
        else {
          $_SESSION['alert'] = "la taxe ne peut être qu'un nombre positif";
          header("location:ajoutarticle.php");
        }
      }
      else {
        $_SESSION['alert'] =  "le prix ne peut être qu'un nombre positif";
        header("location:ajoutarticle.php");
      }
    } 
    else {
      $_SESSION['alert'] =  "la référence ne fait pas 8 charactères, n'est pas uniquement des chiffres ou est négatif";
      header("location:ajoutarticle.php");
    }   
  }
  ?>
</body>