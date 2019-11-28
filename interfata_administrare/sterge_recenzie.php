<?php
	require("admincp.php");
	if (isset($_POST['sterge_recenzie']))
	{
		$idraport = $_POST['h_idraport'];
		$idrecenzie = $_POST['h_idrecenzie'];
		require_once('../init.php');
		$sql = "DELETE FROM rapoarte WHERE id_raport = '".$idraport."'";
		$rezultat = mysqli_query($conectare, $sql);
		$sql2 = "DELETE FROM recenzii WHERE id_recenzie = '".$idrecenzie."'";
		$rezultat2 = mysqli_query($conectare, $sql2);
	}
	else
	{
		header('location: admincp.php');
		exit();
	}
?>