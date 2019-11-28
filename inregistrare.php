<?php
	require_once("header.php");
	if(!isset($_SESSION['Id_Client']))
	{
?>
<head>
	<link rel = "stylesheet" type = "text/css" href = "Styles/inregistrare.css">
</head>
<body>		
	<div class="login-form">
		<form action = "inregistraredb.php" method = "post">
			<h2 class = "text-center">Inregistrare</h2>
		<!--Mesaj daca nu sunt completate toate campurile-->
		
		<?php
			if (isset($_GET['completati_campurile']))
			{
				$mesaj = $_GET['completati_campurile'];
				$mesaj = "Completati toate campurile";
		?>
		<div class = "alert alert-danger text-center"><?php echo $mesaj ?></div>
		<?php
			}
		?>
		
		<!--Mesaj daca numele si prenumele contine cifre sau caractere speciale-->
		
		<?php
			if (isset($_GET['camp_invalid']))
			{
				$mesaj = $_GET['camp_invalid'];
				$mesaj = "Numele trebuie format doar din litere";
		?>
		<div class = "alert alert-danger text-center"><?php echo $mesaj ?></div>
		<?php
			}
		?>
		
		<!--Mesaj daca adresa de email este invalida-->
		
		<?php
			if (isset($_GET['email_invalid']))
			{
				$mesaj = $_GET['email_invalid'];
				$mesaj = "Adresa de email nu este valida";
		?>
		<div class = "alert alert-danger text-center"><?php echo $mesaj ?></div>
		<?php
			}
		?>
		
		<!--Mesaj daca adresa de email este inregistrata deja-->
		
		<?php
			if (isset($_GET['emailfolosit']))
			{
				$mesaj = $_GET['emailfolosit'];
				$mesaj = "Adresa de email este folosita";
		?>
		<div class = "alert alert-danger text-center"><?php echo $mesaj ?></div>
		<?php
			}
		?>
		
		<!--Mesaj daca cele doua parole nu sunt identice-->
		
		<?php
			if (isset($_GET['parolainvalida']))
			{
				$mesaj = $_GET['parolainvalida'];
				$mesaj = "Parola nu se potriveste";
		?>
		<div class = "alert alert-danger text-center"><?php echo $mesaj ?></div>
		<?php
			}
		?>
				<div class="form-group">
						<input type = "text" class="form-control" name = "numeprenume" placeholder = "NumePrenume">
				</div>
				<div class="form-group">
						<input type = "text" class="form-control" name = "email" placeholder = "Email">
				</div>
				<div class="form-group">
						<input type = "text" class="form-control" name = "telefon" placeholder = "Telefon">
				</div>
				<div class="form-group">
						<input type = "password" class="form-control" name = "parola"  placeholder = "Parola">
				</div>
				<div class="form-group">
						<input type = "password" class="form-control" name = "parolarep"  placeholder = "Confirmati parola">
				</div>
				<div class="form-group">
					<input type = "submit" name = "inregistrare" class="btn btn-primary btn-block" value = "Inregistrare">
				</div>
				<div class="form-group form-check">
					<input  type = "checkbox" class="pull-left checkbox-inline" name = "acceptare-conditii" required>
					<span>Sunt de acord cu <a href = "termeni-conditii.php">Termenii si Conditiile</a></span>
				</div>
			</form>
			<p class="text-center"><a href="autentificare.php">Autentificare</a></p>
		</div>
</body>

<?php
	}
	else
	{
		header("location: profil.php?id=".$_SESSION['Id_Client']);
		exit();
	}
	require_once("footer.php");
?>