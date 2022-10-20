<?php
// Initialize the session
session_start();
$_SESSION['message'] ="";

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
  <center>
    <br>
    <label>Ajouter un article</label>
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
    echo $_POST['promotion'];
    $stmt = $conn->prepare("SELECT reference FROM articles WHERE reference=:reference");
    $stmt->execute(['reference' => $_POST["reference"]]); 
    $user = $stmt->fetch();
    if (empty($user)){
        $reference = "";
    }
    else { $reference = $user[0]; }

    $promo = intval($_POST['promotion']);

    if ($_POST['reference'] == $reference){
      echo "Référence déjà exitante !";
    }
    else {
      if (isset($_POST['nouv'])){
        $sql = "INSERT INTO articles (nom, reference, prix_ht, taxe, promotion, nouveaute) VALUES (?,?,?,?,?,?)";
        $conn->prepare($sql)->execute([$_POST['nom'], $_POST['reference'], $_POST['prix'], $_POST['taxe'], $promo, 1]);
        $_SESSION['message'] =$_POST['nom']." à bien été ajouté";

        header("location:articles.php");

      }
      else {
        $sql = "INSERT INTO articles (nom, reference, prix_ht, taxe, promotion, nouveaute) VALUES (?,?,?,?,?,?)";
        $conn->prepare($sql)->execute([$_POST['nom'], $_POST['reference'], $_POST['prix'], $_POST['taxe'], $promo, 0]);
        $_SESSION['message'] =$_POST['nom']." à bien été ajouté";

        header("location:articles.php"); 

      }
    }
  }
  ?>
</body>