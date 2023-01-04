<?php require_once('header.php'); ?>
<body>
  <?php if (isset($_SESSION["droits"]) AND  $_SESSION["droits"]==1){ ?>
<center>
  <br><br>
    <label>Sélectionnez un article à supprimer</label>
  <br>
  <form class="tablemod" method="POST">
    <select name="select" class="form-select" aria-label="Default select example">
      <option selected>Articles </option>
      <?php
       require "connection.php";
       $data = $conn->query("SELECT * FROM articles")->fetchAll();
       foreach ($data as $row)  /* crée une ligne pour chaque article, avec le nom de l'article a chaque fois */
       {
         echo "<option value=$row[id]> $row[nom] </option>";
       }
      ?>
    </select>
    <br><br><button type="submit" class="btn btn-primary">Supprimer</button>
  </form>
</center>


  <?php
  include "connection.php";
  if(isset($_POST['select'])){     /* Récupère l'ID du post sélectionné */
    $stmt = $conn->prepare("SELECT nom FROM articles WHERE id=?"); /* selectionne la ligne avec l'id correspondant et la delete */
    $stmt->execute([$_POST['select']]); 
    $user = $stmt->fetch();
    $_SESSION['message'] =$user[0] ." à bien été supprimé"; 

    $sql = 'DELETE FROM articles WHERE id=:id';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $_POST['select'],]);


    header("location:articles.php"); 

  }
  ;} else { echo "<div class='presentation'><h2> Vous n'avez pas le droit d'être sur cette page</h2></div>";}?>
  
</body>