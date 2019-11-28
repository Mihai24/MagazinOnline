<?php
	include_once("header.php");
	if(!isset($_SESSION['Id_Client']))
	{
?>
<head>
	<link rel = "stylesheet" type = "text/css" href = "Styles/autentificare.css">
</head>
<body>
	<div class = "login-form">
				<form action = "autentificaredb.php" method = "POST">
					<h2 class = "text-center">Autentificare</h2>
					<div class = "form-group">
						<input type = "text" name = "email" placeholder = "Email" class = "form-control">
					</div>
					<div class = "form-group">
						<input type = "password" name = "parola" placeholder = "Parola" class = "form-control">
					</div>
					<div class="form-group">
					<input type = "submit" name = "autentificare" class = "btn btn-primary btn-block" value = "Autentificare">
					</div>
				</form>
			<p class="text-center"><a href="inregistrare.php">Inregistrare</a></p>
	</div>
</body>

<?php
	}
	else
	{
		header("location: profil.php?id=".$_SESSION['Id_Client']);
		exit();
	}
	include_once("footer.php");
?>