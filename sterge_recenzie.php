<?php
	
	require_once("init.php");
	if (isset($_POST['sterge_recenzie'])){
		$idrecenzie = $_POST['h_idrecenzie'];
		$idprodus = $_POST['h_idprodus'];
		$sql = "DELETE FROM recenzii WHERE id_recenzie = '".$idrecenzie."'";
		$rezultat = mysqli_query($conectare, $sql);
		header("location: produse.php?id_produs=".$idprodus);
		exit();
	}
	else{
		header("location: produse.php?id_produs=".$idprodus);
		exit();
	}	
?>