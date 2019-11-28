<?php
	require("header.php");
	require_once("init.php");
	if (isset($_POST['search']))
	{
		if (empty($_POST['cauta_produse']))
		{
			header("location: index.php");
			exit();
		}
		else
		{
			$cauta = mysqli_real_escape_string($conectare, $_POST['cauta_produse']);
			$sql = "SELECT * FROM produse WHERE denumire_produs LIKE '%$cauta%'";
			$rezultat = mysqli_query($conectare, $sql);
			$nr_rezultat = mysqli_num_rows($rezultat);
			if ($nr_rezultat > 0)
			{
				echo 'Au fost gasite '.$nr_rezultat.' rezultate.<br><br>';
				while ($row = mysqli_fetch_assoc($rezultat))
				{
					echo '<tr><td><a href = "produse.php?id_produs='.$row['id_produs'].'">'.$row['denumire_produs'].'</a></td>
					<br><td>'.$row['pret'].'</td></tr> lei<br>';
				}
				echo '</table>';
			}
			else{
				echo 'Nu sunt rezultate.';
			}
		}
	}
	else
	{
		header("location: index.php");
		exit();
	}
?>