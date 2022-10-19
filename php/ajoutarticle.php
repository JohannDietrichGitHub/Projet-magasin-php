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
    <label>Ajouter un article</label>
    <form class="table">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom"  placeholder="Entrez le nom de l'article">
      </div>
      <div class="form-group">
        <label for="reference">Reference</label>
        <input type="text" class="form-control" id="reference" placeholder="Entrez la référence">
      </div>
      <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" id="prix" placeholder="Entrez le prix">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </center>
</body>
<!-- <center>
    <label>Sign up </label>
    <br><br><br>
    <form action="authentification.php" name="form" id="form" method="post">   
    <p>
        <label for="username">username:</label>
        <input type="text" name="username" id="username" required>
    </p>    
    <p>
        <label for="mail">adresse mail:</label>
        <input type="text" name="mail" id="mail" required>
    </p>   
    <p>
        <label for="password">password:</label>
        <input type="password" name="password" id="password" required>
    </p>
    <p>
        <label for="confpassword">confirm password:</label>
        <input type="password" name="confpassword" id="confpassword" required>
    </p>
    <p>
        <input type="submit" value="S'enregistrer">
    </p>
    <div><a href="login.php">Déja un compte ?</a></div>
</center> 









if(isset($_POST['username'])){   /* vérifie si le formulaire a été envoyé */

    $stmt = $conn->prepare("SELECT username FROM users WHERE username=:username");
    $stmt->execute(['username' => $_POST["username"]]); 
    $user = $stmt->fetch();
    if (empty($user)){
        $usernamebdd = "";
    }
    else { $usernamebdd = $user[0]; }


    $stmt = $conn->prepare("SELECT mail FROM users WHERE mail=:mail");
    $stmt->execute(['mail' => $_POST["mail"]]); 
    $user = $stmt->fetch();
    if (empty($user)){
        $mailbdd = "";
    }
    else { $mailbdd = $user[0]; }

    if($_POST['password']== $_POST['confpassword']){ /* vérifie si les mots de passes sont les memes */
        if ($_POST['username']== $usernamebdd || $_POST['mail']== $mailbdd) {  /* vérifie si le nom d'utilisateur ou l'adresse mail ne sont pas déja utilisés */
            echo "nom d'utilisateur ou adresse mail déja utilisés";
        }
        else {
            $mdphash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, mail, password) VALUES (?,?,?)";
            $conn->prepare($sql)->execute([$_POST['username'], $_POST['mail'], $mdphash]);
            header("location:login.php");  
        }
    }
    else {
        echo "mots de passes pas identiques";
    }
}
-->