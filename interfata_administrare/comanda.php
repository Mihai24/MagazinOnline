<?php
	require("admincp.php");
	require_once("../init.php");
	$id = (isset($_GET['nr_comanda']) ? $_GET['nr_comanda'] : '');
	$sql = "SELECT * FROM comenzi WHERE id_comanda ='".$id."' GROUP BY id_comanda";
	$rezultat1 = mysqli_query($conectare, $sql);
		$total = 0;
		while ($row1 = mysqli_fetch_assoc($rezultat1))
		{
		?>
			<h3>Comanda nr. <?php echo $id;?></h3><br>
			Plasata in <?php echo date('d-m-y H:i',strtotime($row1['data_comanda']));?><br><br>
			<table class="table table-bordered">
				<tr>
					<th width = "50%">Produs</th>
					<th width = "25%">Nr. buc</th>
					<th width = "25%">Total</th>
				</tr>
		<?php
			$sql2 = "SELECT produse.id_produs, produse.denumire_produs, 
					produse.pret, comenzi.data_comanda, comenzi.id_comanda, comenzi.produs_id, comenzi.nr_buc, comenzi.stare_id, stari_comenzi.id_stare, 
					stari_comenzi.denumire_stare
					FROM comenzi 
					INNER JOIN produse ON comenzi.produs_id = produse.id_produs
					INNER JOIN stari_comenzi ON comenzi.stare_id = stari_comenzi.id_stare 
					WHERE id_comanda ='".$id."'";
			$rezultat2 = mysqli_query($conectare, $sql2);
			while($row2 = mysqli_fetch_assoc($rezultat2))
			{
				echo '<tr>
					<td>'.$row2['denumire_produs'].'</td><td>'.$row2['nr_buc'].'</td><td>'.$row2['nr_buc']*$row2['pret'].' lei</td></tr>';
					$total = $total + $row2['nr_buc']*$row2['pret'];
		}
		?>
		</table>
		<?php
		echo 'Total de plata: '.$total.' lei';
?>
<form action = "comanda.php?nr_comanda=<?php echo $id; ?>" method = "post">
<input type = "hidden" name = "id_comanda" value = "<?php echo $row2['id_comanda'];?>"><br>
<input type = "hidden" name = "stare" value = "<?php echo $row2['stare_id'];?>"><br>
<select name = "stare">
		<?php
			$sql3 = "SELECT comenzi.data_comanda, comenzi.id_comanda, comenzi.produs_id, comenzi.nr_buc, comenzi.stare_id, stari_comenzi.id_stare, 
				stari_comenzi.denumire_stare FROM stari_comenzi
				INNER JOIN comenzi ON stari_comenzi.id_stare = comenzi.stare_id
				WHERE comenzi.id_comanda = '".$id."'";
			$rezultat3 = mysqli_query($conectare, $sql3);
			$row3 = mysqli_fetch_array($rezultat3);
			echo $row3['denumire_stare'];
		
		?>
		<option selected disabled hidden><?php echo $row3['denumire_stare'];?></option>
		<?php
			$sql1 = "SELECT id_stare, denumire_stare FROM stari_comenzi WHERE NOT id_stare = '".$row3['id_stare']."' ORDER BY id_stare ASC";
			$rezultat1 = mysqli_query($conectare, $sql1);
				while ($row1 = mysqli_fetch_array($rezultat1))
				{
					echo '<option value ='.$row1['id_stare'].'>'.$row1['denumire_stare'].'</option>';
				}
		?>
</select><br>
<input type = "submit" name = "editeaza" value = "Modifica">
</form>

<?php
		}
	if (isset($_POST['editeaza']))
	{
		$stare = mysqli_real_escape_string($conectare, $_POST['stare']);
		$sql = "UPDATE comenzi SET stare_id = '$stare' WHERE id_comanda = '".$id."'";
		$rezultat = mysqli_query($conectare, $sql);
		header("location: vizualizare_comenzi.php");
		exit();
	}
?>