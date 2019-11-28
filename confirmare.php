<?php
	require("header.php");
?>
<!DOCTYPE html>
<body>
   <h3>Detalii comanda</h3>
   <table class="table table-bordered">
    <tr>
     <th width="40%">Nume Produs</th>
     <th width="10%">Cantitate</th>
     <th width="20%">Pret</th>
     <th width="20%">Total</th>
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
     <td><?php echo $values["item_price"]; ?> lei</td>
     <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?> lei</td>
    </tr>
   <?php 
     $total = $total + ($values["item_quantity"] * $values["item_price"]);
    }
   ?>
    <tr>
     <td colspan="3" align="right">Total</td>
     <td align="left"><?php echo number_format($total, 2); ?> lei</td>
    </tr>
   <?php
   }
   ?>
   </table>
   </div>
  </div>
    <br>
	<?php
	if(isset($_SESSION['Id_Client']))
	{	
		require_once("init.php");
		$sql = "SELECT * FROM clienti WHERE id_client='".$_SESSION['Id_Client']."'";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_assoc($rezultat)){
		
	?>
	<form action = "plaseaza_comanda.php" method = "post">
		<div class="form-row">
		<div class="form-group col-md-6">
		<h4>Detalii client</h4>
			<label for = "numeprenume">Nume Prenume:</label><?php echo $row['nume_prenume'];?><br>
			<label for = "telefon">Telefon:</label><?php echo $row['telefon'];?>
		</div>
		</div>
		<h4>Adresa livrare</h4>
		<?php echo $row['nume_prenume'];?>
		<?php echo $row['telefon'];?><br>
		<?php echo $row['adresa'];?><br>
		<input type = "hidden" name = "h_id" value = "<?php echo $row['id_client'];?>">
		<input type = "hidden" name = "h_email" value = "<?php echo $row['email'];?>">
		<input type = "submit" name = "comanda_plasata" value = "Confirma">
	</form>
	<?php
		}
	}
	?>
</body>
</html>