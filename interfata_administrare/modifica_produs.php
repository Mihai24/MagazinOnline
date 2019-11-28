<?php
	require("admincp.php");
	require_once("../init.php");
	$id = (isset($_GET['id_produs']) ? $_GET['id_produs'] : '');
		$sql = "SELECT produse.id_produs, produse.denumire_produs, produse.pret, produse.descriere, produse.nrbuc, produse.categorie_id, produse.brand_id, 
		categorii.id_categorie, categorii.denumire_categorie, brand.id_brand, brand.denumire_brand
		FROM produse
		INNER JOIN categorii ON produse.categorie_id = categorii.id_categorie
		INNER JOIN brand ON produse.brand_id = brand.id_brand WHERE produse.id_produs = '".$id."'";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_assoc($rezultat)){
?>
	<form action = "modifica_produs.php?id_produs=<?php echo $id; ?>" method = "post" style = "padding-left: 10px">
		<label>Denumire Produs</label><br>
		<input type = "text" name = "numeprodus" value = "<?php echo $row['denumire_produs'];?>"><br><br>
		<label>Pret</label><br>
		<input type = "text" name = "pret" value = "<?php echo $row['pret'];?>"><br><br>
		<label>Cantitate</label><br>
		<input type = "text" name = "nrbuc" value = "<?php echo $row['nrbuc'];?>"><br><br>
		<label>Descriere</label><br>
		<input type = "text" name = "descriere" value = "<?php echo $row['descriere'];?>"><br><br>
		<label>Categorie</label><br>
		<select name = "categorie">
		<option selected disabled hidden><?php echo $row['denumire_categorie']; ?></option>
		<?php
			$sql1 = "SELECT id_categorie, denumire_categorie FROM categorii WHERE NOT id_categorie = '".$row['id_categorie']."' ORDER BY denumire_categorie ASC";
			$rezultat1 = mysqli_query($conectare, $sql1);
			while ($row1 = mysqli_fetch_array($rezultat1))
			{
				echo '<option value ='.$row1['id_categorie'].'>'.$row1['denumire_categorie'].'</option>';
			}
		?>
		</select><br><br
		<label>Brand</label><br>
		<select name = "brand">
			<option selected disabled hidden><?php echo $row['denumire_brand']; ?></option>
			<?php
				$sql2 = "SELECT id_brand, denumire_brand FROM brand WHERE NOT id_brand = '".$row['id_brand']."' ORDER BY denumire_brand ASC";
				$rezultat2 = mysqli_query($conectare, $sql2);
				while ($row2 = mysqli_fetch_array($rezultat2))
				{
					echo '<option value ='.$row2['id_brand'].'>'.$row2['denumire_brand'].'</option>';
				}
			?>
		</select><br><br>
		<input class = "btn btn-primary" type = "submit" name = "editeaza" value = "Salveaza">
	</form>
<?php
	}
	if (isset($_POST['editeaza']))
	{
		if (empty($_POST['numeprodus']) || empty($_POST['pret']) || empty($_POST['nrbuc']) || empty($_POST['descriere']))
		{
			header("location: modifica_produs.php?id_produs=".$id);
			exit();
		}
		else
		{
			$denumireprodus = mysqli_real_escape_string($conectare, $_POST['numeprodus']);
			$pret = mysqli_real_escape_string($conectare, $_POST['pret']);
			$cantitate = mysqli_real_escape_string($conectare, $_POST['nrbuc']);
			$descriere = mysqli_real_escape_string($conectare, $_POST['descriere']);
			$categorie = mysqli_real_escape_string($conectare, $_POST['categorie']);
			$brand = mysqli_real_escape_string($conectare, $_POST['brand']);
			if (!is_numeric($pret))
			{
				header("location: modifica_produs.php?id_produs=".$id);
				exit();
			}
			else
			{
				if (!is_numeric($cantitate))
				{
					header("location: modifica_produs.php?id_produs=".$id);
					exit();
				}
				else
					{
						if ($categorie && $brand)
						{
						$sql = "UPDATE produse SET denumire_produs = '$denumireprodus' , 
						pret = '$pret', descriere = '$descriere', categorie_id = '$categorie', brand_id = '$brand', nrbuc = '$cantitate'
						WHERE id_produs = '".$id."'";
						}
						else
						{
							$sql = "UPDATE produse SET denumire_produs = '$denumireprodus' , 
						pret = '$pret', descriere = '$descriere', nrbuc = '$cantitate'
						WHERE id_produs = '".$id."'";
						}
						$rezultat = mysqli_query($conectare, $sql);
						header("location: modifica_produs.php?id_produs=".$id);
						exit();
					}
				}
		}
			
	}
?>