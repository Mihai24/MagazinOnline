<?php
	
	require_once('init.php');
	if (isset($_POST['raport_recenzie']))
	{
		$idrecenzie = $_POST['h_idrecenzie'];
		$idclient = $_POST['h_idclient'];
		$idprodus = $_POST['h_idprodus'];
		$sql = "INSERT INTO rapoarte (recenzie_id, client_id) values ('$idrecenzie', '$idclient')";
		$rezultat = mysqli_query($conectare, $sql);
		header("location: produse.php?id_produs=".$idprodus);
		exit();
	}
	else
	{
		header("location: produse.php?id_produs=".$idprodus);
		exit();
	}

?>