<?php
	require("admincp.php");
	require_once("../init.php");
	?>
	<div class = "row">
	<?php
	require("meniu_comenzi.php");
	?>
	<div class ="col-md-8">
	<?php
	$sql = "SELECT * FROM comenzi GROUP BY id_comanda";
	$rezultat = mysqli_query($conectare, $sql);

	while ($row = mysqli_fetch_assoc($rezultat))
	{
		echo '<table class="table table-bordered">
		<tr>
		<th width="10%">Cod comanda</th>
		<th width="25%">Client</th>
		<th width="25%">Produs</th>
		<th width="5%">Buc</th>
		<th width="10%">Total</th>
		<th width="25%">Stare</th>';
		$sql2 = "SELECT clienti.id_client, clienti.nume_prenume, clienti.adresa, clienti.telefon, produse.id_produs, produse.denumire_produs, produse.pret,
	comenzi.id_comanda, comenzi.data_comanda, comenzi.nr_buc, comenzi.produs_id, comenzi.client_id, comenzi.stare_id, stari_comenzi.id_stare, stari_comenzi.denumire_stare
	FROM comenzi
	INNER JOIN clienti ON comenzi.client_id = clienti.id_client
	INNER JOIN produse ON comenzi.produs_id = produse.id_produs
	INNER JOIN stari_comenzi ON comenzi.stare_id = stari_comenzi.id_stare WHERE comenzi.id_comanda = '".$row['id_comanda']."'";
	$rezultat2 = mysqli_query($conectare, $sql2);
	while($row2 = mysqli_fetch_assoc($rezultat2)){
     echo '<tr><td><a href = "comanda.php?nr_comanda='.$row2['id_comanda'].'">'.$row2['id_comanda'].'</a></td>
		<td>'.$row2['nume_prenume'].'</td><td>'.$row2['denumire_produs'].'
		</td><td>'.$row2['nr_buc'].'</td><td>'.$row2['nr_buc']*$row2['pret'].'</td><td>'.$row2['denumire_stare'].'</td></tr>';
	}
	}
?>
</div>
</div>