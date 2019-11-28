<?php
	require("admincp.php");
	require_once("../init.php");
	$grup = (isset($_GET['id_grup']) ? $_GET['id_grup'] : '');
	$sql = "SELECT * FROM clienti, grupuri WHERE grup_id= '".$grup."' AND id_grup = '".$grup."'";
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