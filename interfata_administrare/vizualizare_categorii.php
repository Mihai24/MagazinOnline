<?php
	require("admincp.php");
?>
<head>
	<script>
		function adaugaGrup() {
		  var x = document.getElementById("grupId");
		  if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
	</script>
</head>
<body>
<div>
	<div><h3>Categorii</h3></div>
	<button onclick = "adaugaGrup()">Adauga categorie</button>
	<div id = "grupId">
		<form action = "adauga_categorie.php" method = "post">
			<label for = "categorie_noua">Nume categorie</label>
			<input type = "text" name = "nume_categorie">
			<input type = "submit" name = "adauga" value = "Adauga">
		</form>
	</div>
</div>
<?php
	require_once("../init.php");
	$sql = "SELECT * FROM categorii ORDER BY denumire_categorie";
	$rezultat = mysqli_query($conectare, $sql);
	echo '<table class="table"><thead class="thead-light">
		<tr><th class = "text-center">Categorie</th><th class = "text-center">Numar produse</th><th class = "text-center">Actiune</th></tr></thead>';
	while ($row = mysqli_fetch_array($rezultat)){
		$count = 0;
		$sql2 = "SELECT count(*) AS total FROM produse where categorie_id='".$row['id_categorie']."'";
		$rezultat2 = mysqli_query($conectare, $sql2);
		$row2 = mysqli_fetch_array($rezultat2);
		echo '<tr><td class = "text-center"><a href="vizualizare_produse.php?id_categorie='.$row['id_categorie'].'">'.$row['denumire_categorie'].'</a>
		</td><td class = "text-center">'.$row2['total'].'</td><td class = "text-center"><a class = "btn btn-danger"href = "sterge_categorie.php?id='.$row['id_categorie'].'">Sterge</a></td></tr>';
	}
	echo '</table>';
?>
</body>
