<?php require_once('header.php'); ?>
<body>
  <?php
    if (isset($_SESSION['alert'])){
        echo "<div class='alert alert-danger' role='alert'>$_SESSION[alert]</div>";
    }
    unset($_SESSION['alert']); 

    if (isset($_SESSION['info_panier'])){
        echo "<div class='alert alert-success' role='alert'>$_SESSION[info_panier]</div>";
    }
    unset($_SESSION['info_panier']);
  ?>
  <table class="table" id="articles">
	<thead>
		<tr>
		    <th scope="col">Nom</th>
		    <th scope="col">Prix</th>
            <th scope="col">Quantité</th>
            <th scope="col">Modifier</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $prix_total = 0;
        $num_article_actuel = 0; //compteur pour les id des articles
        //selectionne l'id des articles dans le panier
        $obtention_id_article = $conn->prepare("SELECT * FROM panier WHERE client_id = ?"); 
        $obtention_id_article->execute([$_SESSION['id']]); //lie le panier avec la session de l'utilisateur
        $id_articles = $obtention_id_article->fetchAll();
        foreach ($id_articles as $obtention_id_article ) {
            //utilise les id récupérés pour chercher dans la table "articles" les données de chacuns de ceux-ci
            $obtention_infos_article = $conn->prepare("SELECT * FROM articles WHERE id = ?");
            $obtention_infos_article->execute([$id_articles[$num_article_actuel]['article_id']]);
            $infos_article = $obtention_infos_article->fetchAll();
            $num_article_actuel +=1;
            foreach ($infos_article as $obtention_infoss_article ) { //affiche une ligne par article avec le nom, le prix et la quantité
                $prix_total+=$obtention_infoss_article['prix_ht']*$obtention_id_article['quantite'];
                echo "<tr>";
                echo "<th> $obtention_infoss_article[nom]</th>";
		        echo "<th> $obtention_infoss_article[prix_ht] € </th>";
                echo "<th> $obtention_id_article[quantite] </th>";                
                echo "<th> <div class='modifier_article_css'>
                        <form action='supression_panier.php' class='panier' method='post'>
                        <button name='id_article' value='$obtention_infoss_article[id]'>Supprimer</button></form>

                        <form action='enlev_quant_panier.php' class='panier' method='post'>
                        <button name='id_article' value='$obtention_infoss_article[id]'>-</button></form>

                        <form action='ajout_quant_panier.php' class='panier' method='post'>
                        <button name='id_article' value='$obtention_infoss_article[id]'>+</button></form>
                        
                        </div>
                        </th>";
                echo "</tr>";
            }
        }
    ?>
    </tbody>
  </table>
  <?php         echo "Le prix total serait de : " .$prix_total. ' euros';?>
</body>