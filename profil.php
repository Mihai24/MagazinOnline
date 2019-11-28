<?php
	require("header.php");
	if(isset($_SESSION['Id_Client']))
	{	
		require_once("init.php");
		$sql = "SELECT * FROM clienti WHERE id_client='".$_SESSION['Id_Client']."'";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_assoc($rezultat)){
		
?>

<body>
	<br>
	<div class="container bootstrap snippet">
		<div class="row">
			<div class="col-sm-10">
            <h4>Salut, <?php echo $row['nume_prenume']?></h4></div>
		</div><br>
		<div class="row">
        <div class="col-sm-3">
			<ul class="list-group">
				<li class="list-group-item text-muted">Administrare cont</li>
				<li class="list-group-item text-muted">
				<a href = "comenzile_mele.php?id=<?php echo $_SESSION['Id_Client']?>">Comenzile mele</a>
				</li>
				<li class="list-group-item text-muted">
				<a href = "vizualizare_recenzii.php">Recenziile mele</a>
				</li>
				<li class="list-group-item text-muted">
				<a href = "editeaza_profil.php">Date personale</a>
				</li>
			<ul>
		</div>
	<div class="col-sm-9">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#" data-toggle = "tab">Informatii cont</a></li>
			</ul>
		<form id="registrationForm" action = "profil.php?id=<?php echo $row['id_client']?>" method = "post">
		<div class="form-group">
            <div class="col-xs-6">
				<label for="nume_prenume"><b>Nume Prenume: </b></label>
				<span><?php echo $row['nume_prenume']?></span>
			</div>
		</div>
		<div class="form-group">
            <div class="col-xs-6"><label for="email"><b>Email: </b></label>
				<span><?php echo $row['email'];?></span>
			</div>
		</div>
			<div class = "form-group">
				<div class="col-xs-6">
				<label for="email"><b>Telefon: </b></label>
				<span><?php echo $row['telefon'];?></span>
			</div>
		</div>
		<div class = "form-group">
				<div class="col-xs-6">
		<b>Adresa de livrare: </b>
			<?php echo $row['adresa'];?><br>
			</div>
		</div>
	</form>
	</div>
	</div>
	</div>
</body>

<?php
		}
	}
	else
	{
		header("location: autentificare.php");
		exit();
	}	
	require("footer.php");
?>