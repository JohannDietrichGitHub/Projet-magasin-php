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
        <div><a href="modif_profil.php">Besoin de modifier les informations ?</a></div>
        </div>
    <?php } ?>
