<?php
	session_start();

	if (isset($_POST['autentificare']))
	{
		require_once("init.php");
		if (empty($_POST['email']) || empty($_POST['parola'])){
			header("location: autentificare.php?eroarecampuri");
			exit();
		}
		else
		{
			$email = mysqli_real_escape_string($conectare, $_POST['email']);
			$parola = mysqli_real_escape_string($conectare, $_POST['parola']);
			$sql = "SELECT * FROM clienti WHERE email = '".$email."'";
			$rezultat = mysqli_query($conectare, $sql);
			if ($row = mysqli_fetch_assoc($rezultat))
			{
				if($row['verificat'] == 0)
				{
					header("location: autentificare.php?cont_nevalidat");
					exit();
				}
				else
				{
					$parolacriptata = password_verify($parola, $row ['parola']);
					if ($parolacriptata == false)
					{
						header("location: autentificare.php?parola_incorecta");
						exit();
					}
					elseif ($parolacriptata == true){
							$_SESSION['Id_Client'] = $row['id_client'];
							$_SESSION['NumePrenume'] = $row['nume_prenume'];
							$_SESSION['Email'] = $row['email'];
							$_SESSION['Telefon'] = $row['Telefon'];
							$_SESSION['Parola'] = $row['parola'];
							$_SESSION['AdresaClient'] = $row['adresa'];
							$_SESSION['GrupID'] = $row['grup_id'];
							header("location: index.php");
							exit();
					}
				}
			}
			else
			{
				header("location: autentificare.php?mailinvalid");
				exit();
			}
		}
	}
	else
	{
		header("location: inregistrare.php");
		exit();
	}
?>