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
	while ($row = mysqli_fetch_assoc($rezultat))
	{
		echo '<div class="col-md-7" style = "padding-left: 10px"><div class="col-xs-6"><label><b>Denumire produs</b></label><br><span>'.$row['denumire_produs'].
		'</span></div><br><div class="col-xs-6"><label><b>Cantitate</b></label><br>'.$row['nrbuc'].' bucati</div><br>
		<div class="col-xs-6"><label><b>Brand</b></label><br>'.$row['denumire_brand'].'</div><br>';
	}
	echo '<form action = "modifica_produs.php?id_produs='.$id.'" method = "POST">
		<input type = "hidden" name = "idprodus" value = "'.$row['id_produs'].'">
		<input type = "hidden" name = "pret" value = "'.$row['pret'].'">
		<input type = "hidden" name = "descriere" value = "'.$row['descriere'].'">
		<input type = "hidden" name = "nrbuc" value = "'.$row['nrbuc'].'">
		<input type = "hidden" name = "idcategorie" value = "'.$row['id_categorie'].'">
		<input type = "hidden" name = "idbrand" value = "'.$row['id_brand'].'">
		<input type = "submit" name = "modifica_produs" value = "Editeaza" class = "btn btn-primary">
		</form>';
?>