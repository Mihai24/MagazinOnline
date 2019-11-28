<?php
	require("admincp.php");
	require_once("../init.php");
	if (isset($_GET['id']))
	{
		$sql = "SELECT produse.id_produs, produse.categorie_id, categorii.id_categorie
		FROM produse
		INNER JOIN categorii ON produse.categorie_id = categorii.id_categorie
		WHERE produse.categorie_id = '".$_GET['id']."'";
		$rezultat = mysqli_query($conectare, $sql);
		$nr = mysqli_num_rows($rezultat);
		if ($nr > 0)
		{
			header("location: vizualizare_categorii.php?comanda_anulata");
			exit();
		}
		else
		{
			$sql2 = "DELETE FROM categorii WHERE id_categorie = '".$_GET['id']."'";
			$rezultat2 = mysqli_query($conectare, $sql2);
			header("location: vizualizare_categorii.php");
			exit();
		}
	}
	else
	{
		header("location: vizualizare_categorii.php");
		exit();
	}
?>