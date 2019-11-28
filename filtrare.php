	<?php
		require_once("init.php");
		$id = (isset($_GET['id_categorie']) ? $_GET['id_categorie'] : '');
	?>
		<div class ="col-md-2">
			<h3 class = "text-center">Brand</h3><hr size = "1">
	<form class = "cauta_brand">
		<ul>
		<a href = "categorii.php?id_categorie=<?php echo $id?>">Toate produsele</a><br><hr size = "1">
	<?php
		$sql = "SELECT id_brand, denumire_brand FROM brand 
		INNER JOIN produse ON produse.brand_id = brand.id_brand WHERE produse.categorie_id = '".$id."' GROUP BY brand.denumire_brand ASC";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_assoc($rezultat))
		{	
	?>
		<a href = "selectare_brand.php?id_categorie=<?php echo $id;?>&id_brand=<?php echo $row['id_brand']?>"><?php echo $row['denumire_brand']?></a><hr size = "1"><br>
	<?php
		}
	?>
		</ul>
	</div>
	</form>