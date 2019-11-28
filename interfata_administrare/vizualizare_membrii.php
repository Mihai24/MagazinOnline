<?php
	require("admincp.php");
?>
<html>
<body>
	<div><h3>Membrii</h3></div>
<?php
	require_once("../init.php");
	$sql = "SELECT * FROM clienti, grupuri WHERE clienti.grup_id = grupuri.id_grup";
	$rezultat = mysqli_query($conectare, $sql);
	echo '<table class="table"><thead class="thead-light">
	<tr><th>Nume Prenume</th><th>Email</th><th>Grup</th></tr></thead';
	while ($row = mysqli_fetch_array($rezultat))
	{
		echo '<tr><td><a href = "vizualizare_profil.php?id='.$row['id_client'].'">'.$row['nume_prenume'].'</a></td><td>'.$row['email'].'</td>
		<td>'.$row['denumire_grup'].'</td></tr>';
	}
	echo '</table>';
?>
</body>
</html>