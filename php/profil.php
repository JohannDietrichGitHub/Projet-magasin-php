<?php require_once('header.php'); ?>
<body>    
    <?php if (!isset($_SESSION['id'])){?>
        <div class='presentation'><h2> Veuillez vous connecter pour accéder au panier</h2></div>
    <?php } else {?>
        <div class='presentation'>
            <h3> Mon profil : <?php if ($_SESSION['droits']==1) {echo "Administrateur";} ?> </h3> 
        <ul>
            <?php 
            echo "<li> Prenom : " .infos_util($conn)['prenom']."</li>";
            echo "<li> Nom : " .infos_util($conn)['nom']."</li>" ;
            echo "<li> Adresse Mail : " .infos_util($conn)['email']."</li>" ;
            echo "<li> Date de naissance : " .infos_util($conn)['date_naissance']."</li>" ;
            echo "<li> Adresse : ".infos_util($conn)['adresse']." ".chercher_ville($conn)['code_postal']."</li>"; 
            echo "<li> Ville : " .chercher_ville($conn)['nom']."</li>";
            echo "<li> Parain : ".chercher_parrain($conn)."</li>"; 
            ?>
        </ul>
    <?php 
    $stmt = $conn->prepare("SELECT * FROM commandes WHERE client_id=?");
    $stmt->execute([$_SESSION['id']]);
    $infos_commandes = $stmt->fetchAll();
    echo "<h2> Historique :</h2> 
    <table>
        <thead>
            <tr>
                <th><center>nom d'article</center></th>
                <th><center> prix de l'article</center></th>
                <th><center>Quantités achetées</center></th>
            </tr>
        </thead>
        <tbody>";
        $compteur = 1;
    foreach ($infos_commandes as $commande){
        $stmt = $conn->prepare("SELECT * FROM articles_commandes WHERE id_commande=? AND client_id=?");
        $stmt->execute([$commande['id_commande'], $_SESSION['id']]);
        echo "<tr><th colspan='3'><center>commande n°".$compteur."</center></th></tr>";
        echo "<tr>";
        $infos_articles = $stmt->fetchAll();
        foreach ($infos_articles as $article){
            echo "<th><center>".$article['article']."</center></th>";
            echo "<th><center>".$article['prix_total']."€ </center></th>";
            echo "<th><center>".$article['quantite']."</center></th></tr>";
        }
        $compteur = $compteur+1;
        echo "</tr>";
    }

} ?>
