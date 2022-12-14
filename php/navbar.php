    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="http://localhost:3000/php/accueil.php">Accueil</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <a class="nav-item nav-link active" href="http://localhost:3000/php/articles.php"">Articles</a>
      </li>
      <li class="nav-item">
        <a class="nav-item nav-link active" href="http://localhost:3000/php/panier.php"">Panier</a>
      </li>
      <?php if (isset($_SESSION["droits"]) AND  $_SESSION["droits"]==1){ ?>
      <li class="nav-item">
        <a class="nav-item nav-link active" href="http://localhost:3000/php/ajoutarticle.php"">Ajouter un article</a>
      </li>
      <li class="nav-item">
            <a class="nav-item nav-link active" href="http://localhost:3000/php/supressionarticle.php""> Supprimer un article</a>
      </li>
      <li class="nav-item">
        <a class="nav-item nav-link active" href="http://localhost:3000/php/modificationarticle.php"">Modifier un article</a>
      </li>
      <?php ;} ?>
    </ul>
    <?php if (!isset($_SESSION['id'])){?>
    <span class="navbar-text">
        <a class="nav-item nav-link active" href="http://localhost:3000/php/login.php"">Se connecter</a>
    </span>
    <?php ;} else { ?>
    <span class="navbar-text">
        <a class="nav-item nav-link active" href="http://localhost:3000/php/profil.php"">Profil</a>
    </span>
    <span class="navbar-text"> 
        <a class="nav-item nav-link active" href="http://localhost:3000/php/logout.php"">Se déconnecter</a>
    </span>
    <?php ;} ?>
  </div>
</nav>