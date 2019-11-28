<?php
	require("header.php");
	require_once("init.php");
	if (isset($_SESSION['Id_Client']))
	{
		$sql = "SELECT clienti.id_client, clienti.nume_prenume, recenzii.id_recenzie, recenzii.idclient, recenzii.idprodus, recenzii.recenzie, produse.id_produs, produse.denumire_produs
				FROM recenzii 
				JOIN clienti ON recenzii.idclient = clienti.id_client
				JOIN produse ON recenzii.idprodus = produse.id_produs
				WHERE recenzii.idclient = '".$_SESSION['Id_Client']."'";
		$rezultat = mysqli_query($conectare, $sql);
		$num = mysqli_num_rows($rezultat);
		if ($num === 0)
			echo 'Nu ai scris recenzii.';
		while ($row = mysqli_fetch_assoc($rezultat))
		{
			echo '<div><a href="produse.php?id_produs='.$row['idprodus'].'">'.$row['denumire_produs'].'</a></div>
				Scris de: '.$row['nume_prenume'].'<br>
				<div>Recenzie:  '.$row['recenzie'].'</div><br>';
		}
	}
	else
	{
		header("location: autentificare.php");
		exit();
	}
	
?>