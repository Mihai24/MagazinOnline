<?php
	require("header.php");
?>
<!DOCTYPE hmtl>
<body>
<h3>Comenzile mele</h3>
	<?php
		if (isset($_SESSION['Id_Client'])){
			require_once("init.php");
			$id = (isset($_GET['id']) ? $_GET['id'] : '');
			$sql = "SELECT * FROM comenzi WHERE client_id ='".$id."' GROUP BY id_comanda";
			$rezultat = mysqli_query($conectare, $sql);
			while ($row = mysqli_fetch_array($rezultat))
			{
				echo "
				<tr>
					<td>
						<a href = 'verifica_comanda.php?id_comanda=".$row['id_comanda']."'>Comanda nr. ".$row['id_comanda']."</a>
						<p>Plasata in ".date('d-m-y H:i',strtotime($row['data_comanda']))."</p>
					</td>
				</tr>";
			}
		}
		else
		{
			header("location: autentificare.php");
			exit();
		}
	?>
</body>
</html>