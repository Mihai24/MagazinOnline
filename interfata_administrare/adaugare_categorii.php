<?php
	require("admincp.php");
	require_once('../init.php');
	if(isset($_POST['adaugare_categorie']))
	{
		if (empty($_POST['denumire_categorie']))
		{
			header("location: ../interfata_administrare/adaugare_categorii.php");
			exit();
		}
		else{
			$denumirecategorie = mysqli_real_escape_string($conectare, $_POST['denumire_categorie']);
			if (!preg_match("/^[a-zA-Z_ -]*$/", $denumirecategorie))
			{
				header("location: ../interfata_administrare/adaugare_categorii.php");
				exit();
			}
			else{
				$sql = "SELECT * FROM categorii WHERE denumire_categorie ='".$denumirecategorie."'";
				$rezultat = mysqli_query($conectare, $sql);
				if (mysqli_fetch_assoc($rezultat))
				{
					header("location: ../interfata_administrare/adaugare_categorii.php?categorie_folosita");
					exit();
				}
				else
				{
					$sql = "INSERT INTO categorii (denumire_categorie) VALUES ('$denumirecategorie')";
					$rezultat = mysqli_query($conectare, $sql);
					header("location: ../interfata_administrare/vizualizare_categorii.php");
					exit();
				}
			}
		}
	}
?>

<form action = "adaugare_categorii.php" method = "post">
<input type = "text" name = "denumire_categorie">
<button type = "submit" name = "adaugare_categorie">Adauga</button>
</form>