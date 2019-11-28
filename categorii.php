<?php
	require("header.php");
?>

<body>
<br>
<div class = "row">
<?php require("filtrare.php");?>
<div class="col-md-4" >
<table cellpadding = "5">
	<?php
		require_once("init.php");
		$id = (isset($_GET['id_categorie']) ? $_GET['id_categorie'] : '');
		$sql = "SELECT * FROM produse WHERE categorie_id= '".$id."'";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_array($rezultat))
		{
			$sql2 = "SELECT * FROM imagini where produs_id = ".$row['id_produs'];
			$rezultat2 = mysqli_query($conectare, $sql2);
			while ($row2 = mysqli_fetch_assoc($rezultat2))
			{
	?>
	<tr>
		<td>
		<?php
			echo '<img src = "imagini/'.$row2['nume'].'" width = "150" height = "150"><br>';
			}
		?>
			<b><a href = "produse.php?id_produs=<?php echo $row['id_produs'];?>"><?php echo $row['denumire_produs'];?></a></b>
			<br><?php echo $row['pret'];?> lei
		</td>
	</tr>
	<?php
		}
	?>
</table>
</div>
</div>
</body>
<?php
	require("footer.php");
?>