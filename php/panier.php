<?php require_once('header.php'); ?>
<body>
  <?php
    if (isset($_SESSION['alert'])){
        echo "<div class='alert alert-danger' role='alert'>$_SESSION[alert]</div>";
    }
    unset($_SESSION['alert']);
  ?>
  <table class="table" id="articles">
	<thead>
		<tr>
		    <th scope="col">Nom</th>
		    <th scope="col">Prix</th>
            <th scope="col">Quantité</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        //selectionne l'id des articles dans le panier
        $obtention_id_article = $conn->prepare("SELECT * FROM panier WHERE client_id = ?"); 
        $obtention_id_article->execute([$_SESSION['id']]);
        $id_articles = $obtention_id_article->fetchAll();
        foreach ($id_articles as $obtention_id_article ) {
            //utilise les id récupérés pour chercher dans la table "articles" les données de chacuns de ceux-ci
            $obtention_infos_article = $conn->prepare("SELECT * FROM articles WHERE id = ?");
            $obtention_infos_article->execute([$obtention_id_article[0]]);
            $infos_article = $obtention_infos_article->fetchAll();
            foreach ($infos_article as $obtention_infoss_article ) { //affiche une ligne par article avec le nom, le prix et la quantité
                echo "<tr>";
                echo "<th> $obtention_infoss_article[nom]</th>";
		        echo "<th> $obtention_infoss_article[prix_ht] € </th>";
                echo "<th> $obtention_id_article[quantite] </th>";
                echo "</tr>";
            }
        }
    ?>
    </tbody>