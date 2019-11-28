<?php
	require("header.php");
	require_once('init.php');
	if(isset($_GET["action"]))
	{
		if($_GET["action"] == "delete")
		{
			$cookie_data = stripslashes($_COOKIE['shopping_cart']);
			$cart_data = json_decode($cookie_data, true);
			foreach($cart_data as $keys => $values)
			{
				if($cart_data[$keys]['item_id'] == $_GET["id"])
				{
					$sql = "SELECT id_produs, nrbuc from produse WHERE id_produs = '".$_GET["id"]."'";
					$rezultat = mysqli_query($conectare, $sql);
					$row = mysqli_fetch_assoc($rezultat);
					unset($cart_data[$keys]);
					$item_data = json_encode($cart_data);
					setcookie("shopping_cart", $item_data, time() + (86400 * 30));
					header("location: cos.php");
				}
			}
		}

	}
?>
<!DOCTYPE html>

   <h3>Detalii comanda</h3>
   <div class="table-responsive">
   <table class="table table-bordered">
    <tr>
     <th width="40%">Nume Produs</th>
     <th width="10%">Cantitate</th>
     <th width="20%">Pret</th>
     <th width="15%">Total</th>
     <th width="5%">Actiune</th>
    </tr>
   <?php
   if(isset($_COOKIE["shopping_cart"]))
   {
	   $total = 0;
	   $cookie_data = stripslashes($_COOKIE['shopping_cart']);
	   $cart_data = json_decode($cookie_data, true);
	   foreach($cart_data as $keys => $values)
    {
   ?>
    <tr>
     <td><?php echo $values["item_name"]; ?></td>
     <td><?php echo $values["item_quantity"]; ?></td>
     <td><?php echo $values["item_price"]; ?></td>
     <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
     <td><a href="cos.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Sterge</span></a></td>
    </tr>
   <?php 
     $total = $total + ($values["item_quantity"] * $values["item_price"]);
	 if (isset($_GET['action']) == "delete")
	 {
		$row['nrbuc'] = $row['nrbuc'] + $values["item_quantity"];
		$sql2 = "UPDATE produse SET nrbuc ='".$row['nrbuc']."' WHERE id_produs ='".$_GET["id"]."'";
		$rezultat2 = mysqli_query($conectare, $sql2);
	 }
    }
   ?>
    <tr>
     <td colspan="3" align="right">Total</td>
     <td align="right"><?php echo number_format($total, 2); ?> lei</td>
     <td></td>
    </tr>
   <?php
   }
   else
   {
    echo '
    <tr>
     <td colspan="5" align="center">Nu sunt produse in cos</td>
    </tr>
    ';
   }
   ?>
   </table>
   </div>
  </div>
  <?php
	require_once('init.php');
	if (isset($_SESSION['Id_Client']))
	{
		$sql = "select * from clienti where id_client ='".$_SESSION['Id_Client']."' AND adresa IS NULL";
		$rezultat = mysqli_query($conectare, $sql);
		if (mysqli_fetch_array($rezultat)){
			echo 'Pentru a trimite comanda trebuie sa completati adresa de livrare.
			<form action = "modifica_adresa.php?id_client='.$_SESSION['Id_Client'].'" method = "post">
			<label for = "adresa">Adresa livrare:</label>
			<input type = "text" name = "mf_adresa"><br>
			<input type = "submit" name = "trimite_adresa" value = "Salveaza">';
		}
		else{
			if ($total == 0){
			echo 'Cosul este gol';}
			else{
			echo '<div align="right">
			<a href="confirmare.php"><b>Confirma</b></a>
			</div>';
			}
		}
		
	}
	else{
		echo 'Pentru a trimite comanda trebuie sa va <a href = "autentificare.php">autentificati</a>.';
	}
  ?>
  <br>
 </body>
</html>