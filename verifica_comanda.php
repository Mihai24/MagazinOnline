<?php
	require("header.php");
	require_once("init.php");
	$id = (isset($_GET['id_comanda']) ? $_GET['id_comanda'] : '');
	$sql = "SELECT * FROM comenzi WHERE id_comanda ='".$id."' GROUP BY id_comanda";
	$rezultat = mysqli_query($conectare, $sql);
	if (isset($_SESSION['Id_Client']))
	{
		$total = 0;
		while ($row = mysqli_fetch_assoc($rezultat))
		{
		?>
			<h3>Comanda nr. <?php echo $id;?></h3><br>
			Plasata in <?php echo date('d-m-y H:i',strtotime($row['data_comanda']));?><br><br>
			<table class="table table-bordered">
				<tr>
					<th width = "50%">Produs</th>
					<th width = "25%">Nr. buc</th>
					<th width = "25%">Total</th>
				</tr>
		<?php
			$sql2 = "SELECT produse.id_produs, produse.denumire_produs, 
					produse.pret, comenzi.data_comanda, comenzi.id_comanda, comenzi.produs_id, comenzi.nr_buc
					FROM comenzi JOIN produse ON comenzi.produs_id = produse.id_produs 
					WHERE id_comanda ='".$id."'";
			$rezultat2 = mysqli_query($conectare, $sql2);
			while($row2 = mysqli_fetch_assoc($rezultat2))
			{
				echo '<tr>
					<td>'.$row2['denumire_produs'].'</td><td>'.$row2['nr_buc'].'</td><td>'.$row2['nr_buc']*$row2['pret'].' lei</td></tr>';
					$total = $total + $row2['nr_buc']*$row2['pret'];
			}
		}
		?>
		</table>
		<?php
		echo 'Total de plata: '.$total.' lei'; 
	}
	else
	{
		header("location: autentificare.php");
		exit();
	}
?>