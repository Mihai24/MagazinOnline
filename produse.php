<?php
require("header.php");
?>

<?php
require("init.php");
if(isset($_POST["adauga_cos"]))
{
	if(isset($_COOKIE["shopping_cart"]))
	{
		$cookie_data = stripslashes($_COOKIE['shopping_cart']);
		$cart_data = json_decode($cookie_data, true);
	}
	else
	{
		$cart_data = array();
	}
	$item_id_list = array_column($cart_data, 'item_id');
	if(in_array($_POST["h_id"], $item_id_list))
	{
		foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]["item_id"] == $_POST["h_id"])
			{
				$cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["cantitate"];
			}
		}
	}
	else
	{
	  $item_array = array(
	   'item_id'   => $_POST["h_id"],
	   'item_name'   => $_POST["h_denumire"],
	   'item_price'  => $_POST["h_pret"],
	   'item_quantity'  => $_POST["cantitate"]);
		$cart_data[] = $item_array;
	}
	$item_data = json_encode($cart_data);
	setcookie('shopping_cart', $item_data, time() + (86400 * 30));
}
	$id = (isset($_GET['id_produs']) ? $_GET['id_produs'] : '');
	$sql = "SELECT produse.id_produs, produse.denumire_produs, produse.nrbuc, produse.pret, produse.descriere,
	imagini.nume, imagini.produs_id
	FROM produse 
	JOIN imagini ON produse.id_produs = imagini.produs_id
	WHERE id_produs ='".$id."'";
	$rezultat = mysqli_query($conectare, $sql);
	if ($rezultat){
		if(mysqli_num_rows($rezultat) > 0)
		{
			while ($row = mysqli_fetch_assoc($rezultat))
			{
?>
				<div class="container-fluid">
					<div class="content-wrapper">	
						<div class="item-container">
								<form action = "produse.php?id_produs=<?php echo $row['id_produs']?>" method = "post">
									<div class="col-md-7">
										<div class="product-title"><h3><?php echo $row['denumire_produs']; ?></h3></div><br><br>
										<img src = "imagini/<?php echo $row['nume']?>" width = "250" height = "250"><br>
										<b>Descriere</b>
										<div class="product-desc"><?php echo $row['descriere']; ?></div>
										<hr>
										<div class="product-price">Pret <?php echo $row['pret']; ?> lei</div>
										<hr>
										<input type = "hidden" name = "cantitate" value = "1">
										<input type = "hidden" name = "h_id" value ="<?php echo $row['id_produs']?>">
										<input type = "hidden" name = "h_denumire" value ="<?php echo $row['denumire_produs']?>">
										<input type = "hidden" name = "h_pret" value ="<?php echo $row['pret']?>">
										<?php
											if ($row['nrbuc'])
											{
												echo '<div class="btn-group cart">
												<input type = "submit" class="btn btn-success" name = "adauga_cos" value = "Adauga" style = "margin-top:5px;">
												</div>';
												if (isset($_POST['adauga_cos']))
												{
													$row['nrbuc'] = $row['nrbuc'] - $_POST["cantitate"];
													$sql2 = "UPDATE produse set nrbuc = '".$row['nrbuc']."' WHERE id_produs = '".$id."'";
													$rezultat2 = mysqli_query($conectare, $sql2);
												}
											}
											else
											{
												echo '<p>Stoc epuizat<p>';
											}
										?>
									</div>
								</form>
							</div>
					</div>
					<h3>Recenzii</h3>
				<?php
				
					$sql2 = "SELECT clienti.id_client, clienti.nume_prenume, recenzii.id_recenzie, recenzii.idclient, recenzii.idprodus, recenzii.recenzie
							FROM recenzii 
							JOIN clienti ON recenzii.idclient = clienti.id_client
							WHERE recenzii.idprodus ='".$id."' ORDER BY id_recenzie DESC";
					$rezultat2 = mysqli_query($conectare, $sql2);
					$num = mysqli_num_rows($rezultat2);
					if (isset($_SESSION['Id_Client']))
					{
						
						echo '<form action = "adauga_recenzie.php" method = "post">
							<textarea rows = "3" cols = "100" name = "recenzie"></textarea><br>
							<input type = "hidden" name = "h_idclient" value = "'.$_SESSION['Id_Client'].'">
							<input type = "hidden" name = "h_idprodus" value = "'.$id.'">
							<input type = "submit" name = "adauga_recenzie" class = "btn btn-primary" value = "Trimite"></form><hr size = "1">';
					}
					else
					{
						echo 'Pentru a scrie recenzii trebuie sa fiti <a href = "autentificare.php">autentificat</a>.';
					}
					if ($num === 0)
					{
						echo 'Nu exista recenzii pentru acest produs.<br><br>';
					}
					while ($row2 = mysqli_fetch_array($rezultat2))
					{
						echo '<div>
						<b>'.$row2['nume_prenume'].'</b><br><br>'.$row2['recenzie'].'<br><br></div>';
						if (isset($_SESSION['Id_Client']))
						{
							if ($_SESSION['GrupID'] > 1)
							{
								echo '<form action = "sterge_recenzie.php" method = "post">
								<input type = "hidden" name = "h_idrecenzie" value = "'.$row2['id_recenzie'].'">
								<input type = "hidden" name = "h_idprodus" value = "'.$id.'">
								<input type = "submit" value = "Sterge" class = "btn btn-danger" name = "sterge_recenzie"></form><hr size = "1">';
							}else{
								if ($_SESSION['Id_Client'] != $row2['idclient'])
								{
									echo '
									<form action = "raport_recenzie.php" method = "post">
									<input type = "hidden" name = "h_idclient" value = "'.$_SESSION['Id_Client'].'">
									<input type = "hidden" name = "h_idrecenzie" value = "'.$row2['id_recenzie'].'">
									<input type = "hidden" name = "h_idprodus" value = "'.$id.'">
									<input type = "submit" name = "raport_recenzie" class = "btn btn-primary" value = "Raporteaza"></form><hr size = "1">';
								}
							}
						}
					}
				?>
			</div>
<?php
			}
		}
	}
?>
