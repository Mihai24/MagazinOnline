<?php
	require("admincp.php");
	if (isset($_POST['sterge_raport']))
	{
		$idraport = $_POST['h_idraport'];
		require_once('../init.php');
		$sql = "DELETE FROM rapoarte WHERE id_raport = '".$idraport."'";
		$rezultat = mysqli_query($conectare, $sql);
	}
	else
	{
		header('location: admincp.php');
		exit();
	}
?>