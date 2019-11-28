<?php
	require("admincp.php");
	require_once("../init.php");
	if (isset($_POST['adauga_produs']))
	{
		if (empty($_POST['denumireprodus']) || empty($_POST['pret']) || empty($_POST['cantitate']) || empty($_POST['descriere'])){
			header("location: adaugare_produse.php?campuri_goale");
			exit();
		}
		else
		{
			$denumireprodus = mysqli_real_escape_string($conectare, $_POST['denumireprodus']);
			$pret = mysqli_real_escape_string($conectare, $_POST['pret']);
			$cantitate = mysqli_real_escape_string($conectare, $_POST['cantitate']);
			$descriere = mysqli_real_escape_string($conectare, $_POST['descriere']);
			$categorie = mysqli_real_escape_string($conectare, $_POST['categorie']);
			$brand = mysqli_real_escape_string($conectare, $_POST['brand']);
			if (!is_numeric($pret))
			{
				header("location: adaugare_produse.php?pret_invalid");
				exit();
			}
			else
			{
				if (!is_numeric($cantitate))
				{
					header("location: adaugare_produse.php?cantitate_invalid");
					exit();
				}
				else{
					$sql = "SELECT * FROM produse WHERE denumire_produs = '".$denumireprodus."'";
					$rezultat = mysqli_query($conectare, $sql);
					if (mysqli_fetch_assoc($rezultat))
					{
						header("location: adaugare_produse.php?produsul_exista");
						exit();
					}else
					{
						$sql = "INSERT INTO produse (denumire_produs, pret, descriere, categorie_id, brand_id, nrbuc) 
						VALUES ('$denumireprodus', '$pret', '$descriere', '$categorie', '$brand', '$cantitate')";
						$rezultat = mysqli_query($conectare, $sql);
						header("location: adaugare_produse.php?succes");
						exit();
					}
				}
			}
		}
	}
?>

<form action = "adaugare_produse.php" method = "POST">
	<label>
	<input type = "text" name = "denumireprodus"><br>
	<input type = "text" name = "pret"><br>
	<input type = "text" name = "cantitate"><br>
	<textarea rows = "4" cols = "50" name = "descriere"></textarea><br>
	<select name = "categorie">
	<option selected disabled hidden>Selecteaza categoria</option>
	<?php
		$sql = "SELECT id_categorie, denumire_categorie FROM categorii ORDER BY denumire_categorie ASC";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_array($rezultat))
		{
			echo '<option value ='.$row['id_categorie'].'>'.$row['denumire_categorie'].'</option>';
		}
	?>
	</select><br>
	<select name = "brand">
	<option selected disabled hidden>Selecteaza brand</option>
	<?php
		$sql = "SELECT id_brand, denumire_brand FROM brand ORDER BY denumire_brand ASC";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_array($rezultat))
		{
			echo '<option value ='.$row['id_brand'].'>'.$row['denumire_brand'].'</option>';
		}
	?>
	</select><br>
	<button type = "submit" name = "adauga_produs">Adauga</button>
</form>