<?php require_once('header.php'); ?>
<body>
<center> <!-- formulaire de creation -->
        <div class="form_signup form-login">
            <div class="formtitle">Créer un compte</div> 
            <br><br>
            <form action="crea_util.php" name="form" id="form" method="post">
            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom"  placeholder="prenom" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom"  placeholder="nom" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse Mail </label>
                <input type="text" class="form-control" id="email" name="email"  placeholder="email" required>
            </div>
            <div class="form-group">
                <label for="naiss">Date de naissance  </label>
                <input type="text" class="form-control" id="naiss" name="naiss"  placeholder="naiss" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse </label>
                <input type="text" class="form-control" id="adresse" name="adresse"  placeholder="adresse" required>
            </div>
            <div class="form-group">
                <label for="ville">Ville </label>
                <input type="text" class="form-control" id="ville" name="ville"  placeholder="villes" required>
            </div>
            <div class="form-group">
                <label for="parrain">Parrain  </label>
                <input type="text" class="form-control" id="parrain" name="parrain"  placeholder="prenom_du_parrain nom_du_parrain" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer le compte !</button>
            </form>
        </div>
    </center>
</body>