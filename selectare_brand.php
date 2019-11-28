<?php
	require("header.php");
?>
<body>
<br>
<div class = "row">
<?php
	require("filtrare.php");
?>
<div class="col-md-4" >
<table cellpadding = "5">
<?php
	require_once("init.php");
	$categorie = (isset($_GET['id_categorie']) ? $_GET['id_categorie'] : '');
	$brand = (isset($_GET['id_brand']) ? $_GET['id_brand'] : '');
	$sql = "SELECT * FROM produse WHERE categorie_id= '".$categorie."' AND brand_id='".$brand."'";
	$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_array($rezultat))
		{
	?>
	<tr>
		<td>
			<b><a href = "produse.php?id_produs=<?php echo $row['id_produs'];?>"><?php echo $row['denumire_produs'];?></a></b>
			<br><?php echo $row['pret'];?> lei
		</td>
	</tr>
	<?php
		}
	?>
</div>
</div>
</table>
</body>
