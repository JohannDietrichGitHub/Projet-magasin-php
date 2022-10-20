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
  <?php
  if (isset($_SESSION['message'])){
    echo "<div class='alert alert-primary' role='alert'>$_SESSION[message]</div>";
  }
  ?>
  <center>
    <br>
    <table class="table" id="articles">
      <thead>
        <tr>
          <th scope="col">Nom</th>
          <th scope="col">Référence</th>
          <th scope="col">Prix</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require "connection.php";
        $data = $conn->query("SELECT * FROM articles")->fetchAll();
        foreach ($data as $row) {
          echo "<tr>";
          echo "<th> $row[nom]</th>";
          echo "<th> $row[reference]</th>";
          echo "<th> $row[prix_ht]</th>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </center>
</body>