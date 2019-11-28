<?php
	require("admincp.php");
	require_once("../init.php");
	if (isset($_GET['id']))
	{
		$id = mysqli_real_escape_string($_GET['id']);
		$sql = "SELECT clienti.id_client, clienti.grup_id, grupuri.id_grup
		FROM clienti 
		INNER JOIN grupuri ON clienti.grup_id = grupuri.id_grup
		WHERE clienti.grup_id = '".$_GET['id']."'";
		$rezultat = mysqli_query($conectare, $sql);
		$nr = mysqli_num_rows($rezultat);
		if ($nr > 0)
		{
			header("location: vizualizare_grupuri.php?comanda_anulata");
			exit();
		}
		else
		{
			$sql2 = "DELETE FROM grupuri WHERE id_grup = '".$_GET['id']."'";
			$rezultat2 = mysqli_query($conectare, $sql2);
			header("location: vizualizare_grupuri.php");
			exit();
		}
	}
	else
	{
		header("location: vizualizare_grupuri.php");
		exit();
	}
?>