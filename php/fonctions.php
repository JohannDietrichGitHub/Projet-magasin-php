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
  }
  else {
    $_SESSION['alert']=$verification['message'];
  }
  header("location:articles.php");

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
      header("location:panier.php");
      exit;
    }
  }
