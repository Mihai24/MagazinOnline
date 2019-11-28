<?php
	if (isset($_POST['comanda_plasata']))
	{
		require_once("init.php");
		$nr_comanda = rand(1000, 9999);
		if(isset($_COOKIE["shopping_cart"]))
		{
			$total = 0;
			$cookie_data = stripslashes($_COOKIE['shopping_cart']);
			$cart_data = json_decode($cookie_data, true);
			foreach($cart_data as $keys => $values)
			{
				$idprodus = $values["item_id"];
				$cantitate = $values["item_quantity"];
				$pret = number_format($values["item_quantity"] * $values["item_price"], 2);
				$idclient = $_POST['h_id'];
				$numeclient = $_POST['h_numeprenume'];
				$telefon = $_POST['h_telefon'];
				$mail = $_POST['h_email'];
				$adresa = $_POST['h_adresa'];
				$sql = "INSERT INTO comenzi (id_comanda, produs_id, nr_buc, client_id) 
				VALUES ('$nr_comanda', '$idprodus', '$cantitate', '$idclient')";
				$rezultat = mysqli_query($conectare, $sql);
				
			}
		}
		setcookie("shopping_cart", "", time() - 3600);
		if ($sql){
			$to = $mail;
			$subject = "Comanda a fost confirmata";
			$mesaj = 'Comanda cu nr '.$nr_comanda.' a fost confirmata.';
			$headers = "From: apvfreg@gmail.com \r\n";
			mail($to, $subject, $mesaj, $headers);
		}
		header("location: cos.php");
		exit();
	}
	else
	{
		header("location: cos.php");
		exit();
	}
?>