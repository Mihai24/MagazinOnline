<?php

	if (isset($_GET['cod']))
	{
		require_once("init.php");
		$validare = $_GET['cod'];
		$sql = "SELECT cod_verificare, verificat FROM clienti WHERE verificat = 0 AND cod_verificare ='".$validare."' LIMIT 1";
		$rezultat = mysqli_query($conectare, $sql);
		if (mysqli_num_rows($rezultat) == 1){
			$sql2 = "UPDATE clienti SET verificat = 1 WHERE cod_verificare ='".$validare."' LIMIT 1";
			$modifica = mysqli_query($conectare, $sql2);
			header("location: autentificare.php");
			exit();
		}
		else{
			header("location: autentificare.php");
			exit();
		}
	}

?>