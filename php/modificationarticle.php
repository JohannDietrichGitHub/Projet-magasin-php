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
  <center>
  <br><br>
    <label>Sélectionnez un article a modifier</label>
  <br>
  <form class="tablemod" method="POST">
    <select name="select" class="form-select" aria-label="Default select example">
      <option selected>Articles </option>
      <?php
       require "connection.php";
       $data = $conn->query("SELECT * FROM articles")->fetchAll();
       foreach ($data as $row) 
       {
         echo "<option> $row[nom] </option>";
       }
      ?>
    </select>
    <br><br><button type="submit" class="btn btn-primary">Selectionner</button>
  </form>
  <?php 


  if (isset($_POST['select'])) 
  {
    echo "Article choisi : ".$_POST['select'];
    $nom = $row['nom']; /* Dernier article et pas article choisi */
    $reference = $row['reference'];
    $prix = $row['prix_ht'];
    $nouv = $row['nouveaute'];
  }
  ?>

    <br><br><br><br><br>
    <label>Modifier l'article</label>
    <br><br>
    <form class="table" method="POST">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom"  placeholder="Entrez le nom de l'article" value="<?php echo $nom ?>" required> 
      </div>
      <div class="form-group">
        <label for="reference">Reference</label>
        <input type="text" class="form-control" name="reference" id="reference"  placeholder="Entrez la référence" required>
      </div>
      <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" name="prix" id="prix" placeholder="Entrez le prix" required>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="nouv" id="nouv">
        <label class="form-check-label" for="nouv">Nouveauté ?</label>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
  </center>
</body>