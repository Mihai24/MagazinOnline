<?php
	require("admincp.php");
?>
<html>
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
	<div><h3>Grupuri</h3></div>
	<button onclick = "adaugaGrup()">Adauga grup</button>
	<div id = "grupId">
		<form action = "adauga_grupuri.php" method = "post">
			<label for = "grupnou">Nume grup</label>
			<input type = "text" name = "nume_grup">
			<input type = "submit" name = "adauga" value = "Adauga">
		</form>
	</div>
</div>
	<?php
		require("../init.php");
		$sql = "SELECT id_grup, denumire_grup FROM grupuri ORDER BY denumire_grup ASC";
		$rezultat = mysqli_query($conectare, $sql);
		echo '<table class="table"><thead class="thead-light">
		<tr><th>Grup</th><th>Membrii</th><th>Actiune</th></tr></thead>';
		while ($row = mysqli_fetch_array($rezultat))
		{
			$count = 0;
			$sql2 = "SELECT count(*) AS total FROM clienti where grup_id='".$row['id_grup']."'";
			$rezultat2 = mysqli_query($conectare, $sql2);
			$row2 = mysqli_fetch_array($rezultat2);
			echo '<tr><td><a href="selectare_grup.php?id_grup='.$row['id_grup'].'">'.$row['denumire_grup'].'</a></td><td>'.$row2['total'].'</td><td><a href = "sterge_grup.php?id='.$row['id_grup'].'">Sterge</a></td></tr>';
		}
		echo '</table>'
	?>
</body>
</html>