<?php require_once('header.php'); ?>
<body>
  <?php
  if (isset($_SESSION['message'])){
	echo "<div class='alert alert-primary' role='alert'>$_SESSION[message]</div>";
  }
  unset($_SESSION['message']);
  $_SESSION['id'] = 2; //test pour envoi dans le panier
  ?>
  <center>
	<br>
	<table class="table" id="articles">
	  <thead>
		<tr>
		  <th scope="col">Nom</th> <!-- défini la forme du tableau -->
		  <th scope="col">Référence</th>
		  <th scope="col">Prix</th>
	<?php if (isset($_SESSION['id'])){ 
			echo "<th scope='col'>Ajouter au panier</th>";
		   } ?>
		</tr>
	  </thead>
	  <tbody>
		<?php
		$data = $conn->query("SELECT * FROM articles")->fetchAll();  /* insère dans une nouvelle colonne pour chaque colonne dans la bdd d'articles */
		foreach ($data as $article) {
		  echo "<tr>";
		  echo "<th> $article[nom]</th>";
		  echo "<th> $article[reference]</th>";
		  echo "<th> $article[prix_ht] € </th>";
		  if (isset($_SESSION['id'])){
			echo "<th><form action='insertion_panier.php' class='panier' method='post'>
			<button name='valpanier' value='$article[id]'>Ajouter</button></form></th>";
		  }
		  echo "</tr>";	
		}
		?>
	  </tbody>
	</table>
  </center>
</body>