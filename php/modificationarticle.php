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
  <br><br>
    <label>Sélectionnez un article à modifier</label>
  <br>
  <form class="tablemod" method="POST">
    <select name="select" class="form-select" aria-label="Default select example">
      <option selected>Articles </option>
      <?php
       require "connection.php";
       $data = $conn->query("SELECT * FROM articles")->fetchAll();
       foreach ($data as $row) 
       {
         echo "<option value=$row[id]> $row[nom] </option>";
       }
      ?>
    </select>
    <br><br><button type="submit" class="btn btn-primary">Selectionner</button>
  </form>
  <?php 

/* Récuperer données de l'article selectionné pour l'intégrer dans le formulaire */
  if (isset($_POST['select'])) 
  { 
    $idactuelle = $_POST['select'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id=:id");
    $stmt->execute(['id' => $idactuelle]); 
    $user = $stmt->fetch();
    
    $nom = $user['nom'];
    $reference = $user['reference'];
    $prix = $user ['prix_ht'];
    $taxe = $user['taxe'];
    $promo = $user["promotion"];
    $nouv = $user['nouveaute'];
  }
  else 
  {
    $nom = "";
    $reference = "";
    $prix = "";
    $taxe = "";
    $promo = "";
    $nouv = "";
  }

  if ($nom != ""){
  ?>

    <br><br>
    <label>Modifier l'article</label>  
    <br><br>
    <form class="table" method="POST">
    <div class="form-group">
        <input type="text" class="form-control" name="id" id="id"   value="<?php echo $idactuelle ?>" readonly="readonly" hidden required> 
      </div>
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom"  placeholder="Entrez le nom de l'article" value="<?php echo $nom ?>" required> 
      </div>
      <div class="form-group">
        <label for="reference">Reference</label>
        <input type="text" class="form-control" name="reference" id="reference"  placeholder="Entrez la référence" value="<?php echo $reference ?>" required>
      </div>
      <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" name="prix" id="prix" placeholder="Entrez le prix" value="<?php echo $prix ?>" required>
      </div>
      <div class="form-group">
        <label for="taxe">Taxe</label>
        <input type="text" class="form-control" name="taxe" id="taxe" placeholder="Entrez la taxe (20 de base)" value="<?php echo $taxe ?>"  required>
      </div>
      <div class="form-group">
        <label for="promotion">promotion</label>
        <input type="text" class="form-control" name="promotion" id="promotion" placeholder="Entrez la valeur de la promotion en %" value="<?php echo $promo ?>" >
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="nouv" id="nouv" <?php echo ($nouv==1 ? 'checked' : '') ?>>
        <label class="form-check-label" for="nouv">Nouveauté ?</label>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <?php } 
    
    // Modification de l'article dans la base de donnée
  if(isset($_POST['nom'])){
 //Défini toutes les variables permettant de vérifier si le formulaire rend des nombres
 $referencenbr = intval($_POST['reference']);

 $prix = intval($_POST['prix']);

 $taxe = intval($_POST['taxe']);

 $promo=null;       

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


 if(strlen($_POST['reference']) == 8 AND is_numeric($_POST['reference']) AND $referencenbr >= 0 ) { /* vérifie la taille de la reference, s'il elle est une nombre et si celle-ci n'est pas négative*/
   if (is_numeric($_POST['prix']) AND $prix > 0  ){ /* vérifie si le prix est un nombre et n'est pas négatif */
     if ($taxe >= 0 AND is_numeric($_POST['taxe'])){ 
       if ($promo >= 0 AND is_numeric($promo)){
          $sql = "UPDATE articles SET nom=?, reference=?, prix_ht=?, taxe=?, promotion=?, nouveaute=? WHERE id=?";
          $stmt= $conn->prepare($sql);
          $stmt->execute([$_POST['nom'], $_POST['reference'], $_POST['prix'], $_POST['taxe'], $promo, $nouv, $_POST['id']]);

          $_SESSION['message'] = $_POST['nom']." à bien été modifié !";

          header("location:articles.php"); 
          }
            else {
              $_SESSION['alert'] = "la promotion ne peut être qu'un nombre positif";
              header("location:modificationarticle.php");
            }
          }
        else {
        $_SESSION['alert'] = "la taxe ne peut être qu'un nombre positif";
        header("location:modificationarticle.php");
        }
      }
    else {
    $_SESSION['alert'] =  "le prix ne peut être qu'un nombre positif";
    header("location:modificationarticle.php");
    }
  } 
  else {
  $_SESSION['alert'] =  "la référence ne fait pas 8 charactères, n'est pas uniquement des chiffres ou est négatif";
  header("location:modificationarticle.php");
  }   
}
    ?>
  </center>
</body>