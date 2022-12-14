<?php require_once('header.php'); ?>
<body>
    <center> <!-- formulaire de connection -->
        <div class="form_signup form-login">
            <div class="formtitle">Se connecter</div> 
            <br><br>
            <form action="connection_util.php" name="form" id="form" method="post">
            <div class="form-group">
                <label for="username">Adresse mail</label>
                <input type="text" class="form-control" id="username" name="username"  placeholder="Adresse mail" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
        <div><a href="creation_compte.php">Pas encore de compte ?</a></div>
    </center>
</body>