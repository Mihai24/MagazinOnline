<?php
		require("admincp.php");
		require_once("../init.php");
		$sql = "SELECT rapoarte.id_raport, rapoarte.client_id, clienti.nume_prenume, clienti.id_client 
		FROM rapoarte 
		INNER JOIN clienti ON clienti.id_client = rapoarte.client_id";
		$rezultat = mysqli_query($conectare, $sql);
		$nr_rapoarte = mysqli_num_rows($rezultat);
		if ($nr_rapoarte)
		{
			echo 'Au fost raportate urmatoarele recenzii: <br><br>';
			while ($row = mysqli_fetch_assoc($rezultat))
			{
				$sql2 = "SELECT rapoarte.id_raport, rapoarte.recenzie_id, recenzii.id_recenzie, recenzii.recenzie, recenzii.idprodus,
				recenzii.idclient, produse.id_produs, produse.denumire_produs, clienti.id_client, clienti.nume_prenume
				FROM rapoarte 
				INNER JOIN recenzii ON rapoarte.recenzie_id = recenzii.id_recenzie
				INNER JOIN produse ON recenzii.idprodus = produse.id_produs
				INNER JOIN clienti ON recenzii.idclient = clienti.id_client
				WHERE rapoarte.id_raport = '".$row['id_raport']."'";
				$rezultat2 = mysqli_query($conectare, $sql2);
				while ($row2 = mysqli_fetch_assoc($rezultat2))
				{
					echo 'Produs: '.$row2['denumire_produs'].'
					<br>Recenzie scrisa de: '.$row2['nume_prenume'].'<br>
					Recenzie: '.$row2['recenzie'].'<br>Raportat de catre: '.$row['nume_prenume'].'<br>
					<form action = "sterge_recenzie.php" method = "post">
					<input type = "hidden" name = "h_idrecenzie" value = "'.$row2['id_recenzie'].'">
					<input type = "hidden" name = "h_idraport" value = "'.$row['id_raport'].'">
					<input type = "submit" name = "sterge_recenzie" value = "Sterge recenzie">
					</form>
					<form action = "sterge_raport.php" method = "post">
					<input type = "hidden" name = "h_idraport" value = "'.$row['id_raport'].'">
					<input type = "submit" name = "sterge_raport" value = "Sterge raport">
					</form>';
				}
			}
		}
	?>