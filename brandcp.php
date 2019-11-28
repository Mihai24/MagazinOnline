	<?php
		require_once("../init.php");
		$id = (isset($_GET['id_categorie']) ? $_GET['id_categorie'] : '');
	?>
	<div class="list-group">
	<h3>Brand</h3>
	<form class = "cauta_brand">
		<ul>
		<li><a href = "vizualizare_produse.php?id_categorie=<?php echo $id?>">Toate produsele</a></li>
	<?php
		require_once("../interfata_administrativa/init.php");
		$sql = "SELECT id_brand, denumire_brand FROM brand 
		INNER JOIN produse ON brand.id_brand = produse.brand_id WHERE produse.categorie_id = '".$id."' GROUP BY brand.denumire_brand ASC";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_assoc($rezultat))
		{	
	?>
		<li><a href = "selectare_brand.php?id_categorie=<?php echo $id;?>&id_brand=<?php echo $row['id_brand']?>"><?php echo $row['denumire_brand']?></a></li>
	<?php
		}
	?>
		</ul>
	</form>
	</div>