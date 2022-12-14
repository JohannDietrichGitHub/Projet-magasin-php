<?php



function insertion_articles($conn)
{
  $verification = all_verif($conn);
  if($verification['success']){

    $nouv = isset($_POST['nouv']) ? 1 : 0;

    $promo = !empty($_POST['promotion']) ? $_POST['promotion'] : null;

    $sql = "INSERT INTO articles (nom, reference, prix_ht, taxe, promotion, nouveaute) VALUES (?,?,?,?,?,?)"; //Insertion des donnés
    $conn->prepare($sql)->execute([$_POST['nom'], $_POST['reference'], $_POST['prix'], $_POST['taxe'], $promo, $nouv]);
    $_SESSION['message'] =$_POST['nom']." à bien été ajouté"; //ajout du message de confirmation
    header("location:articles.php");
    exit;
  }
  else {
    $_SESSION['alert']=$verification['message'];
    header("location:ajoutarticle.php");
    exit;

  }
}




function modification_article($conn)
{
  $verification = all_verif($conn,true);
  if($verification['success']){

    $nouv = isset($_POST['nouv']) ? 1 : 0;

    $promo = !empty($_POST['promotion']) ? $_POST['promotion'] : null;

    $sql = "UPDATE articles SET nom=?, reference=?, prix_ht=?, taxe=?, promotion=?, nouveaute=? WHERE id=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$_POST['nom'], $_POST['reference'], $_POST['prix'], $_POST['taxe'], $promo, $nouv, $_POST['id']]);
    $_SESSION['message'] = $_POST['nom']." à bien été modifié !";
    header("location:articles.php");
    exit;
  }
  else {
    $_SESSION['alert']=$verification['message'];
    header("location:modificationarticle.php");
    exit;
  }

}




function all_verif($conn, $isUpdate=false)
{
  $resultat = ['success' => false, 'message' => ''];

    if(isset($_POST['nom'])){   /* vérifie si le formulaire a été envoyé */

        //Défini toutes les variables permettant de vérifier si le formulaire rend des nombres
        $referencenbr = intval($_POST['reference']);
    
        $prix = intval($_POST['prix']);
    
        $taxe = intval($_POST['taxe']);
    
        $stmt = $conn->prepare("SELECT reference FROM articles WHERE reference=:reference");/* cherche dans la BDD si la référence existe déjà */
        $stmt->execute(['reference' => $_POST["reference"]]); 
        $user = $stmt->fetch();
        if (empty($user)){
            $reference = "";
        }
        else { $reference = $user[0]; }
        if ($_POST['nom'] =="" OR $_POST['prix']=="" OR $_POST['taxe']=="" OR $_POST['reference']==""){
            $resultat['message'] = "Veuillez remplir les champs obligatoires";
            exit;
        }

        if (!$isUpdate AND $_POST['reference'] == $reference){
          $resultat['message'] = "Référence déjà existante ";
        }
        else if(strlen($_POST['reference']) == 8 AND is_numeric($_POST['reference']) AND $referencenbr >= 0 ) { /* vérifie la taille de la reference, s'il elle est une nombre et si celle-ci n'est pas négative*/
          if (is_numeric($_POST['prix']) AND $prix > 0  ){ /* vérifie si le prix est un nombre et n'est pas négatif */
            if ($taxe >= 0 AND is_numeric($_POST['taxe'])){ 
              if (empty($_POST['promotion']) OR (!empty($_POST['promotion']) AND is_numeric($_POST['promotion']) AND $_POST['promotion'] >= 0 ) ){
                $resultat['success']=true;
                $resultat['message']='tout est vérifié';
            }
            else {
              $resultat['message']= "la promotion ne peut être qu'un nombre positif";
            }
          }
          else {
            $resultat['message'] = "la taxe ne peut être qu'un nombre positif";
          }
        }
        else {
          $resultat['message'] =  "le prix ne peut être qu'un nombre positif";
        }
      } 
      else {
        $resultat['message'] =  "la référence ne fait pas 8 charactères, n'est pas uniquement des chiffres ou est négatif";
      }   
    }
    return $resultat;
  }

function insert_panier($conn){
    //envoi des données des articles au panier

    if(isset($_POST['valpanier']) AND isset($_SESSION['id'])){
      $id_article = $_POST['valpanier'];
      $id_client = $_SESSION['id'];
      $data_panier = [
        'client_id' => $id_client,
        'article_id' => $id_article,
        'quantite' => 1
      ];
      //et les mets dans les variables pour les retransmettre a la table panier 
      $sql = "INSERT INTO panier (client_id, article_id, quantite) VALUES (:client_id, :article_id, :quantite)"; //Insertion des donnés
      $conn->prepare($sql)->execute($data_panier);
      $_SESSION['info_panier'] = "L'article à bien été inséré dans le panier";
      header("location:panier.php");
      exit;
    }
  }

function suppr_panier($conn){

    $id_article = $_POST['id_article'];

    $sql = "DELETE FROM panier WHERE article_id=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$id_article]);
    $_SESSION['alert'] = "L'article à été supprimé du panier";
    header("location:panier.php");
    exit;
  }

function enlev_quant_panier($conn){
    $id_article = $_POST['id_article'];
    $stmt = $conn->prepare("SELECT quantite FROM panier WHERE article_id=?");
    $stmt->execute([$id_article]); 
    $quantite = $stmt->fetch();
    $quantite_avant = $quantite['quantite'];
    $quantite['quantite'] -= 1;
    if ($quantite['quantite']<=0){
      $_SESSION['alert'] = "La quantité de l'objet ne peut pas être inférieure à 1";
        header("location:panier.php");
        exit;
    }
    else {
        $data = [
            'quantite' => $quantite['quantite'],
            'id' => $id_article
        ];
        $sql = "UPDATE panier SET quantite=:quantite WHERE article_id=:id";
        $stmt= $conn->prepare($sql);
        $stmt->execute($data);
        $_SESSION['alert'] = "La quantité de l'article à baissé de ".$quantite_avant ." à " .$quantite['quantite'];
        header("location:panier.php");
        exit;
    }

  }

function ajout_quant_panier($conn){
    $id_article = $_POST['id_article'];
    $stmt = $conn->prepare("SELECT quantite FROM panier WHERE article_id=?");
    $stmt->execute([$id_article]); 
    $quantite = $stmt->fetch();
    $quantite_avant = $quantite['quantite'];
    $quantite['quantite'] += 1;

    $data = [
        'quantite' => $quantite['quantite'],
        'id' => $id_article
    ];

    $sql = "UPDATE panier SET quantite=:quantite WHERE article_id=:id";
    $stmt= $conn->prepare($sql);
    $stmt->execute($data);
    $_SESSION['info_panier'] = "La quantité de l'article à été augmenté, de ". $quantite_avant . " a " .$quantite['quantite'];
    header("location:panier.php");
    exit;
  }

  function valider_panier($conn){
    $id_utilisateur = $_POST['id_util'];

    $sql = "DELETE FROM panier WHERE client_id=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$id_utilisateur]);
    $_SESSION['info_panier'] = "La commande a été validée !";
    header("location:panier.php");
    exit;
  }

  function connection_uti($conn){
    if(!empty($_POST))  
    {
        $stmt = $conn->prepare("SELECT mot_de_passe FROM clients WHERE email=?");
        $stmt->execute([$_POST["username"]]); 
        $passwd = $stmt->fetch();

        if ($passwd !=null){
            if (/* password_verify( */$_POST["password"]== $passwd['mot_de_passe']){    
                $stmt = $conn->prepare("SELECT * FROM clients WHERE email = :username"); /* permet de chercher la colone"droits" determinant si un utilisateur est administrateur ou non */
                $stmt->execute(['username' => $_POST["username"]]); 
                     $user = $stmt->fetch();
                     $droits = $user['administrateur']; //vérifiie dans la BDD si l'utilisateur a des droits administrateurs
                     $_SESSION['id'] = $user['id'];
                     $_SESSION["username"] = $_POST["username"]; /* Crée les variables de sessions permettant donc de confirmer la connection et plus */
                     $_SESSION["droits"] = $droits;
                     $_SESSION['conn'] = "Bienvenue ".$_SESSION["username"]."!";
                     //creation de logs
                     header("location:articles.php");  
                     exit;
                }  
                else  
                {  
                     echo "Mauvais mot de passe ou nom d'utilisateur";
                }
            }
            else 
                {
                    echo "Nom d'utilisateur inconnu";
                }
        } 
}

function logout(){
    session_destroy();//déconnecte l'utilisateur
    session_start();
    $_SESSION['conn'] = "Vous vous êtes déconnecté(e)";
    header("location: articles.php");
    exit;
}

function infos_util($conn){
    $stmt = $conn->prepare("SELECT * FROM clients WHERE id=?");
    $stmt->execute([$_SESSION['id']]); 
    return $stmt->fetch();
}

function chercher_ville($conn){
    $id_ville = infos_util($conn)['ville_id'];
    $stmt = $conn->prepare("SELECT * FROM villes WHERE id=?");
    $stmt->execute([$id_ville]);
    return $stmt->fetch();
}

function chercher_parrain($conn){
    $id_parrain = infos_util($conn)['parrain_id'];
    $stmt = $conn->prepare("SELECT * FROM clients WHERE id=?");
    $stmt->execute([$id_parrain]);
    $retour = $stmt->fetch();
    if ($retour == 1 OR $retour == NULL){
        return "Pas de parrain";
    }
    else {
        $prenom = $retour['prenom'];
        $nom = $retour['nom'];
        return $nom." ".$prenom;
    }
}






















 // A VERIFIER LE FONCTIONNEMENT COMPLET !!!! TODO
function creer_compte($conn){
    if ($_POST['prenom'] =="" OR $_POST['nom']=="" OR $_POST['email']=="" OR $_POST['naiss']=="" OR $_POST['adresse']=="" OR $_POST['ville']=="" OR $_POST['password']=="" ){
        $resultat['message'] = "Veuillez remplir les champs obligatoires";
        exit;
    }
    else {
        $stmt = $conn->prepare("SELECT * FROM villes WHERE nom=?");   //vérifie si la vlle existe, et si elle n'existe pas, la crée dans la BDD
        $stmt->execute([strtoupper($_POST['ville'])]);
        $info_ville= $stmt->fetch();
        if ($info_ville == NULL) {
            $data_ville =[
                'code_postal' =>00000,
                'nom' =>strtoupper($_POST['ville'])
            ];
            $sql = "INSERT INTO villes (code_postal, nom) VALUES (:code_postal, :nom )"; //Insertion des donnés
            $conn->prepare($sql)->execute($data_ville);
        }
        else{
            $id_de_ville = $info_ville['id'];
        }

        if($_POST['parrain']==""){   //vérifie si le parrain exite, et si c'est le cas, le lie a l'utilisateur
            $id_de_parrain = NULL;
        }
        else {
            $prenomnomparrain = explode(" ",$_POST['parrain']);
            $stmt = $conn->prepare("SELECT * FROM clients WHERE prenom=?");   //vérifie si la vlle existe, et si elle n'existe pas, la crée dans la BDD
            $stmt->execute([ucfirst($prenomnomparrain['0'])]);
            $info_parrain= $stmt->fetchAll();
            if ($info_parrain==NULL){
                $id_de_parrain=NULL;
                $_SESSION['message'] ="le parrain n'est pas valable";
                exit;
            }
            else {
                if ($info_parrain['nom'] == $prenomnomparrain[1]){
                    $id_de_parrain = $info_parrain['id'];
                }
            }
        }

        $data_util = [
            'prenom' =>$_POST['prenom'],
            'nom' =>$_POST['nom'],
            'email' =>$_POST['email'],
            'date_naissance' =>$_POST['naiss'],
            'adresse' =>$_POST['adresse'],
            'ville_id' =>$id_de_ville,
            'parrain_id' =>$id_de_parrain,
            'mot_de_passe' =>password_hash($_POST['password'],PASSWORD_ARGON2ID),
            'administrateur' => NULL
        ];
        $sql = "INSERT INTO clients (prenom, nom, email, date_naissance, adresse, ville_id, parrain_id, mot_de_passe, administrateur) VALUES (:prenom, :nom, :email, :date_naissance, :adresse, :ville_id, :parrain_id, :mot_de_passe, :administrateur)"; //Insertion des donnés
        $conn->prepare($sql)->execute($data_util);
        $_SESSION['info_panier'] = "L'article à bien été inséré dans le panier";
        header("location:panier.php");
        exit;
    }

}