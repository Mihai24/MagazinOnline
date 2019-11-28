<?php
	require_once("init.php");
	if (isset($_POST['trimite_adresa']))
	{
		$id = (isset($_GET['id_client']) ? $_GET['id_client'] : '');
		if (empty($_POST['mf_adresa'])){
			header("location: cos.php?compleati_adresa");
			exit();
		}else{
			$adresa = mysqli_real_escape_string($conectare, $_POST['mf_adresa']);
			$sql = "UPDATE clienti SET adresa = '$adresa' WHERE id_client ='".$id."'";
			$rezultat = mysqli_query($conectare, $sql);
			header("location: cos.php");
			exit();
		}
	}
?>