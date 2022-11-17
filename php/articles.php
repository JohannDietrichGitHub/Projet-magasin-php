<?php require_once('header.php'); ?>
<body>
  <?php
  if (isset($_SESSION['message'])){
    echo "<div class='alert alert-primary' role='alert'>$_SESSION[message]</div>";
  }
  unset($_SESSION['message']);
  ?>
  <center>
    <br>
    <table class="table" id="articles">
      <thead>
        <tr>
          <th scope="col">Nom</th> <!-- défini la forme du tableau -->
          <th scope="col">Référence</th>
          <th scope="col">Prix</th>
    <?php /* if (isset($_SESSION['nom'])){ */
            echo "<th scope='col'>Ajouter au panier</th>";
          /* } */?>
        </tr>
      </thead>
      <tbody>
        <?php
        require "connection.php";
        $data = $conn->query("SELECT * FROM articles")->fetchAll();  /* insère dans une nouvelle colonne pour chaque colonne dans la bdd d'articles */
        foreach ($data as $row) {
          echo "<tr>";
          echo "<th> $row[nom]</th>";
          echo "<th> $row[reference]</th>";
          echo "<th> $row[prix_ht] € </th>";
          /* if (isset($_SESSION['nom'])){ */
            echo "<th><form class='panier' method='post'>
            <button name='valpanier' value='$row[id]'>Ajouter</button></form></th>";
          /* } */
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </center>

  <?php //envoi des données des articles au panier

    if(isset($_POST['valpanier'])){
      $stmt = $conn->prepare("SELECT * FROM articles WHERE id=:id"); /* selectionne la ligne avec l'id correspondant*/
      $stmt->execute(['id' => $_POST['valpanier']]); 
      $article = $stmt->fetch();
      //Lis les données trouvée dans la table articles 
      $NomArticle = $article['nom']; 
      $ReferenceArticle =$article['reference'];
      echo $PrixArticle =$article['prix_ht'];
      $data = [
        'nom' => $NomArticle,
        'reference' => $ReferenceArticle,
        'prix_ht' => $PrixArticle,
    ];
      //et les mets dans les variables pour les retransmettre a la table panier 
      $sql = "INSERT INTO panier (nom, reference, prix_ht) VALUES (:nom, :reference, :prix_ht)"; //Insertion des donnés
      $conn->prepare($sql)->execute($data);
      $_SESSION['messagePanier'] =$NomArticle ." à bien été ajouté au panier"; //ajout du message de confirmation
    }

  ?>
</body>