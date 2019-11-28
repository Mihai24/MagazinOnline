<?php
	require("admincp.php");
?>

<h1>Rezultate cautare</h1>

<?php
	require_once("../init.php");
	if (isset($_POST['search']))
	{
		$cauta = mysqli_real_escape_string($conectare, $_POST['cauta_acp']);
		$sql = "SELECT * FROM clienti WHERE nume_prenume LIKE '%$cauta%' OR email LIKE '%$cauta%' OR telefon LIKE '%$cauta%'";
		$rezultat = mysqli_query($conectare, $sql);
		$nr_rezultat = mysqli_num_rows($rezultat);
		if ($nr_rezultat > 0)
		{
			echo 'Au fost gasite '.$nr_rezultat.' rezultate.<br><br>';
			echo '<table class="table"><thead class="thead-light">
			<tr><th>Nume Prenume</th><th>Email</th><th>Telefon</th></tr></thead';
			while ($row = mysqli_fetch_assoc($rezultat))
			{
				echo '<tr><td><a href = "vizualizare_profil.php?id='.$row['id_client'].'">'.$row['nume_prenume'].'</a></td></td><td>
				'.$row['email'].'</td><td>'.$row['telefon'].'</td></tr>';
			}
			echo '</table>';
		}
		else{
			echo 'Nu sunt rezultate.';
		}
	}
	else
	{
		header("location: admincp.php");
		exit();
	}
?>