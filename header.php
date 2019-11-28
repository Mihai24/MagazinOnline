<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel = "stylesheet" type = "text/css" href = "Styles/bootstrap.min.css">
	<link rel = "stylesheet" type = "text/css" href = "Styles/produse.css">
	<link rel = "stylesheet" type = "text/css" href = "Styles/index.css">
	<link rel = "stylesheet" type = "text/css" href = "Styles/navbar.css">
	<link rel = "stylesheet" type = "text/css" href = "Styles/footer.css">
	<script type="text/javascript" src = "Scripts/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src = "Scripts/bootstrap.min.js"></script>
	<script type="text/javascript" src = "Scripts/jquery.js"></script>
	<script type="text/javascript" src = "Scripts/jquery-ui.js"></script>
	<script type="text/javascript" src = "Scripts/jquery-ui.min.js"></script>
</head>
	<div class = "navbar navbar-expand-lg navbar-light"  style="background-color: #e3f2fd;">
				<a class = "navbar-brand" href = "index.php">WATF SHOP</a>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<form class="mx-2 my-auto d-inline" action = "cauta_produse.php" method = "post">
									<div class="input-group">
									<input class="form-control" type = "text" name = "cauta_produse" placeholder="Cauta..."  autocomplete="off" autofocus="autofocus" type="text">
									<span class="input-group-append">
									<input class="btn btn-outline-secondary" type = "submit" name = "search" value = "Cauta">
									</span>
									</div>
									</form>
						<?php
							if (isset($_SESSION['Id_Client'])){
								if ($_SESSION['GrupID'] > 1)
								{
									echo '
									<ul class = "navbar-nav ml-auto">
									<li class="nav-item"><a class="nav-link" href = "profil.php?id='.$_SESSION['Id_Client'].'" class="dropdown-item">Profil</a>
									<li class="nav-item"><a class="nav-link" href = "interfata_administrare\admincp.php" class="dropdown-item">AdminCP</a>
									<li class="nav-item"><a class="nav-link" href = "deconectare.php" class="dropdown-item" name = "deconectare">Deconectare</a>
									<li class="nav-item"><a class="nav-link" href = "cos.php" class = "btn">Cosul meu</a></li></ul>
									</ul>';
								}
								else
								{
									echo '
									<ul class = "navbar-nav ml-auto">
									<li class="nav-item"><a class="nav-link" href = "profil.php?id='.$_SESSION['Id_Client'].'" class = "btn">Profil</a></li>
									<li class="nav-item"><a class="nav-link" href = "deconectare.php" class = "btn" name = "deconectare">Deconectare</a></li>
									<li class="nav-item"><a class="nav-link" href = "cos.php" class = "btn">Cosul meu</a></li></ul>';
								}
							}
							else
							{
								echo '
								<ul class = "navbar-nav ml-auto">
								<li class="nav-item"><a class="nav-link" href = "autentificare.php" class = "btn">Autentificare</a></li>
								<li class="nav-item"><a class="nav-link" href = "inregistrare.php" class = "btn">Inregistrare</a></li>
								<li class="nav-item"><a class="nav-link" href = "cos.php" class = "btn">Cosul meu</a></li></ul>';
							}
						?>
			</div>
	</div>
</div>