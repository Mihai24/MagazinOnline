<?php
	require_once("../init.php");
	if (isset($_POST['adauga']))
	{
		if (empty($_POST['nume_grup']))
		{
			echo "<scrip>alert('Completati campul.')</script>";
			exit();
		}
		else
		{
			if (!preg_match("/^[a-zA-Z_ -]*$/", $nume_grup))
			{
				echo "<scrip>alert('Numele trebuie sa fie compus doar din litere.')</script>";
				exit();
			}
			else{
				$nume_grup = mysqli_real_escape_string($conectare, $_POST['nume_grup']);
				$sql = "INSERT INTO grupuri (denumire_grup) VALUES ('$nume_grup')";
				$rezultat = mysqli_query($conectare, $sql);
				header("location: vizualizare_grupuri.php?succes");
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
