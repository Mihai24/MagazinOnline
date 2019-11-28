<?php
	require_once("init.php");
	if (isset($_POST['adauga_recenzie']))
	{
		$idclient = $_POST['h_idclient'];
		$idprodus = $_POST['h_idprodus'];
		$recenzie = mysqli_real_escape_string($conectare, $_POST['recenzie']);
		$sql = "INSERT INTO recenzii (recenzie, idprodus, idclient) VALUES ('$recenzie','$idprodus', '$idclient')";
		$rezultat = mysqli_query($conectare, $sql);
		header("location: produse.php?id_produs=".$idprodus);
		exit();
	}
	else{
		header("location: produse.php?id_produs=".$idprodus);
		exit();
	}

?>