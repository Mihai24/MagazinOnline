<?php
	require_once("../init.php");
	if (isset($_POST['adauga']))
	{
		if (empty($_POST['nume_categorie']))
		{
			echo "<scrip>alert('Completati campul.')</script>";
			exit();
		}
		else
		{
			if (!preg_match("/^[a-zA-Z_ -]*$/", $nume_categorie))
			{
				echo "<scrip>alert('Numele trebuie sa fie compus doar din litere.')</script>";
				exit();
			}
			else{
				$nume_categorie = mysqli_real_escape_string($conectare, $_POST['nume_categorie']);
				$sql = "INSERT INTO categorii (denumire_categorie) VALUES ('$nume_categorie')";
				$rezultat = mysqli_query($conectare, $sql);
				header("location: vizualizare_categorii.php?succes");
				exit();
			}
		}
	}
	else
	{
		header("location: vizualizare_grupuri.php");
		exit();
	}
?>
