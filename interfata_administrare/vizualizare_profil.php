<?php
	require("admincp.php");
	require_once("../init.php");
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$sql = "SELECT * FROM clienti WHERE id_client='".$id."'";
	$rezultat = mysqli_query($conectare, $sql);
	while ($row = mysqli_fetch_array($rezultat))
	{
?>

<br>
<body>
	<form method = "post" action = "vizualizare_profil.php?id="<?php echo $row['id_client']?> style = "padding-left: 10px">
		<p>Informatii <b><?php echo $row['nume_prenume']?></b></p>
		<div class="row">
			<div class="form-group col-md-3">
				<input type = "hidden" name = "id_client" value = "<?php echo $row['id_client']?>">
				<label for = "numeprenume">Nume Prenume</label>
				<input type = "text" class="form-control" name = "numeprenume" value ="<?php echo $row['nume_prenume'];?>"><br>
				<label for = "email">Email</label>
				<input type = "text" class="form-control" name = "email" value ="<?php echo $row['email'];?>"><br>
				<label for = "telefon">Telefon</label>
				<input type = "text" class="form-control" name = "telefon" value ="<?php echo $row['telefon'];?>"><br>
				<label for = "adresa">Adresa</label><br>
				<input type = "text" class="form-control" name = "adresa" value ="<?php echo $row['adresa'];?>"><br>
				<button type="submit" class="btn btn-primary" name = "modifica1">Modifica</button>
			</div>
		</div>
	</form>
	<?php
		}
			if(isset($_POST['modifica1']))
			{
				if (empty($_POST['numeprenume']) || empty($_POST['email']) || empty($_POST['telefon']) || empty($_POST['adresa']))
				{
					header("location: vizualizare_profil.php?invalid");
					exit();
				}
				else
				{
					$idclient = mysqli_real_escape_string($conectare, $_POST['id_client']);
					$nume = mysqli_real_escape_string($conectare, $_POST['numeprenume']);
					$email = mysqli_real_escape_string($conectare, $_POST['email']);
					$telefon = mysqli_real_escape_string($conectare, $_POST['telefon']);
					$adresa = mysqli_real_escape_string($conectare, $_POST['adresa']);
					if (!preg_match("/^[a-zA-Z_ -]*$/", $nume)){
						header("location: vizualizare_profil.php?camp_invalid");
						exit();
					}
					else
					{
							$sql = "UPDATE clienti SET nume_prenume = '$nume', email = '$email', telefon = '$telefon', adresa = '$adresa'
							WHERE id_client = '".$idclient."'";
							$rezultat = mysqli_query($conectare, $sql);
							header("location: vizualizare_profil.php?id=".$idclient);
							exit();
					}
				}
			}
?>
</body>