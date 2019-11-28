	<?php
		require_once("../init.php");
	?>
		<div class ="col-md-3">
			<h3 class = "text-center">Comenzi</h3><hr size = "1">
	<form class = "cauta_brand">
		<ul>
		<a href = "vizualizare_comenzi.php">Toate comenzile</a><br><hr size = "1">
	<?php
		$sql = "SELECT id_stare, denumire_stare FROM stari_comenzi ORDER BY id_stare ASC";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_assoc($rezultat))
		{	
	?>
		<a href = "selectare_comenzi.php?id=<?php echo $row['id_stare'];?>">
		<?php echo $row['denumire_stare']?></a><hr size = "1"><br>
	<?php
		}
	?>
		</ul>
	</div>
	</form>