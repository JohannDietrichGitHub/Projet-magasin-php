<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="http://localhost:3000/php/accueil.php"">Accueil</a>
        <a class="nav-item nav-link active" href="http://localhost:3000/php/articles.php"">Articles</a>
        <?php if (isset($_SESSION["droits"]) AND  $_SESSION["droits"]==1){?>
        <a class="nav-item nav-link active" href="http://localhost:3000/php/ajoutarticle.php"">Ajouter un article</a>
        <a class="nav-item nav-link active" href="http://localhost:3000/php/supressionarticle.php""> Supprimer un article</a>
        <a class="nav-item nav-link active" href="http://localhost:3000/php/modificationarticle.php"">Modifier un article</a>
        <?php ;} ?>
        <a class="nav-item nav-link active" href="http://localhost:3000/php/panier.php"">Panier</a>
        <?php if (!isset($_SESSION['id'])){?>
        <a class="nav-item nav-link active" href="http://localhost:3000/php/login.php"">Se connecter</a>
        <?php ;} else { ?>
        <a class="nav-item nav-link active" href="http://localhost:3000/php/logout.php"">Se déconnecter</a>
        <?php ;} ?>
        </div>
    </div>
    </nav>