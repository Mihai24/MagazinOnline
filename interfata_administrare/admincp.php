<?php
	session_start();
	if(!(isset($_SESSION['Id_Client']) && $_SESSION['GrupID'] > 1))
	{
		print 'Doar administratorii pot accesa aceasta pagina.';
		exit();
	}
?>

<head>
	<link rel = "stylesheet" type = "text/css" href = "../Styles/bootstrap.min.css">
	<link rel = "stylesheet" type = "text/css" href = "produse.css">
	<script type="text/javascript" src = "../Scripts/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src = "../Scripts/bootstrap.min.js"></script>
	<script type="text/javascript" src = "../Scripts/jquery.js"></script>
	<script type="text/javascript" src = "../Scripts/jquery-ui.js"></script>
	<script type="text/javascript" src = "../Scripts/jquery-ui.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<a class="navbar-brand" href = "admincp.php">Index</a>
				<form action = "cauta_acp.php" method = "post">
					<input type = "text" name = "cauta_acp" placeholder="Cauta...">
					<button type = "submit" name = "search" class="btn btn-outline-success my-2 my-sm-0">Cauta</button>
				</form>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a class="nav-item nav-link" href = "vizualizare_categorii.php">Categorii</a></li>
				<li class="nav-item active"><a class="nav-item nav-link" href = "vizualizare_grupuri.php">Grupuri</a></li>
				<li class="nav-item active"><a class="nav-item nav-link" href = "vizualizare_membrii.php">Membri</a></li>
				<li class="nav-item active"><a class="nav-item nav-link" href = "vizualizare_rapoarte.php">Rapoarte</a></li>
				<li class="nav-item active"><a class="nav-item nav-link" href = "vizualizare_comenzi.php">Comenzi</a></li>
				<li class="nav-item active"><a class="nav-item nav-link" href = "../deconectare.php">Deconectare</a></li>
			</ul>
		</div>
	</nav>
	<br>
</body>
