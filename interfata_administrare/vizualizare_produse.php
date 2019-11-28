<?php
	require("admincp.php");
?>
<body>
<br><br>
<div class = "row">
<?php
	
	require("brandcp.php");
	require_once("../init.php");
	$id = (isset($_GET['id_categorie']) ? $_GET['id_categorie'] : '');
	$sql = "SELECT * FROM produse WHERE categorie_id = '".$id."'ORDER BY denumire_produs";
	$rezultat = mysqli_query($conectare, $sql);
?>
	<div class="col-md-4" >
	<?php
	while ($row = mysqli_fetch_array($rezultat)){
		echo '<div>
		<div class="producttitle"><a href = "pagina_produse.php?id_produs='.$row['id_produs'].'">'.$row['denumire_produs'].'</a></div><div class="pricetext">'.$row['pret'].'</div>
		<div class="pull-right"><a href="pagina_produse.php?id_produs='.$row['id_produs'].'" class="btn btn-primary btn-sm" role="button">Modifica</a></div>
		</div>';
	}
?>
</div>
</div>
</body>