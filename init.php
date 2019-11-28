<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "magazinit";

$conectare = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conectare){
	die("Conectarea la baza de date nu a fost posibila. Eroare: ".mysqli_connect_error());
}
?>