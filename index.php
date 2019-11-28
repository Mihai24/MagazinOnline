<!DOCTYPE html>
<?php
	require ("header.php");
?>
<body>
	<br>
		<h3 class = "text-center">Selecteaza o categorie pentru a ajunge la sectiunea dorita</h3>
	<br>
	<div class = "container">
		<ul>
		<?php
			require_once("init.php");
			$sql = "SELECT id_categorie, denumire_categorie FROM categorii";
			$rezultat = mysqli_query($conectare, $sql);
			print '<ul class = "ul_index_dispaly">';
			while ($row = mysqli_fetch_array($rezultat))
			{
				print '<li class ="li_index_display"><a href = "categorii.php?id_categorie='.$row['id_categorie'].'">'.$row['denumire_categorie'].'</a></li>';
			}
			print '</ul>';
		?>
		</ul>
	</div>
</body>
<?php
	require ("footer.php");
?>
</html>