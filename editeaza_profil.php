<?php
	require("header.php");
	if(isset($_SESSION['Id_Client']))
	{	
		require_once("init.php");
		$sql = "SELECT * FROM clienti WHERE id_client='".$_SESSION['Id_Client']."'";
		$rezultat = mysqli_query($conectare, $sql);
		while ($row = mysqli_fetch_assoc($rezultat)){
?>
	<br><br>
	<form action = "editeaza_profil.php" method = "post">
		<label>Nume Prenume</label>
		<div class = "form-group">
		<input type = "text" name = "mod_nume" value = "<?php echo $row['nume_prenume'];?>">
		</div>
		<label>Email</label>
		<div class = "form-group">
		<input type = "text" name = "mod_email" value = "<?php echo $row['email'];?>">
		</div>
		<label>Telefon</label>
		<div class = "form-group">
		<input type = "number" name = "mod_telefon" value = "<?php echo $row['telefon'];?>">
		</div>
		<label>Adresa</label>
		<div class = "form-group">
		<input type = "text" name = "mod_adresa" value = "<?php echo $row['adresa'];?>">
		</div>
		<div class = "form-group">
		<input type = "submit" name = "editeaza" value = "Modifica">
		</div>
	</form>
	<?php
		}
			if(isset($_POST['editeaza']))
			{
				if (empty($_POST['mod_nume']) || empty($_POST['mod_email']) || empty($_POST['mod_telefon']) || empty($_POST['mod_adresa']))
				{
					header("location: editeaza_profil.php?invalid");
					exit();
				}
				else
				{
					$nume = mysqli_real_escape_string($conectare, $_POST['mod_nume']);
					$email = mysqli_real_escape_string($conectare, $_POST['mod_email']);
					$telefon = mysqli_real_escape_string($conectare, $_POST['mod_telefon']);
					$adresa = mysqli_real_escape_string($conectare, $_POST['mod_adresa']);
					if (!preg_match("/^[a-zA-Z_ -]*$/", $nume)){
						header("location: editeaza_profil.php?camp_invalid");
						exit();
					}
					else
					{
						if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
							header("location: editeaza_profil?email_invalid");
							exit();
						}
						else
						{
							$sql = "UPDATE clienti SET nume_prenume = '$nume', email = '$email', telefon = '$telefon', adresa = '$adresa' WHERE
							id_client = '".$_SESSION['Id_Client']."'";
							$rezultat = mysqli_query($conectare, $sql);
							header("location: profil.php?id=".$_SESSION['Id_Client']);
							exit();
						}
					}
				}
			}
	}
	else
	{
		header("location: autentificare.php");
		exit();
	}
?>