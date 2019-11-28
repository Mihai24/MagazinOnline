<?php
	require_once("init.php");
	
	if (isset($_POST['inregistrare']))
	{
		if (empty($_POST['numeprenume']) || empty($_POST['email']) || empty($_POST['telefon']) || empty($_POST['parola']) || empty($_POST['parolarep'])){
			header("location: inregistrare.php?completati_campurile");
			exit();
		}
		else
		{
			$numeprenume = mysqli_real_escape_string($conectare, $_POST['numeprenume']);
			$email = mysqli_real_escape_string($conectare, $_POST['email']);
			$telefon = mysqli_real_escape_string($conectare, $_POST['telefon']);
			$parola = mysqli_real_escape_string($conectare, $_POST['parola']);
			$parolarep = mysqli_real_escape_string($conectare, $_POST['parolarep']);
			if (!preg_match("/^[a-zA-Z_ -]*$/", $numeprenume)){
				header("location: inregistrare.php?camp_invalid");
				exit();
			}
			else
			{
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
					header("location: inregistrare.php?email_invalid");
					exit();
				}
				else
				{
					$sql = "SELECT * FROM clienti WHERE email = '".$email."'";
					$rezultat = mysqli_query($conectare, $sql);
					if (mysqli_fetch_assoc($rezultat))
					{
						header("location: inregistrare.php?emailfolosit");
						exit();
					}
					else
					{
						if ($parola !== $parolarep)
						{
							header("location: inregistrare.php?parolainvalida");
							exit();
						}
						else
						{
							$parolacriptata = password_hash($parola,PASSWORD_DEFAULT);
							$cod_validare = md5(time().$numeprenume);
							$sql = "INSERT INTO clienti (nume_prenume, email, telefon, parola, cod_verificare) 
							VALUES ('$numeprenume', '$email', '$telefon', '$parolacriptata', '$cod_validare')";
							$rezultat = mysqli_query($conectare, $sql);
							if ($sql){
								$to = $email;
								$subject = "Activare cont";
								$mesaj = 'http://localhost/magazinonline/validare.php?cod='.$cod_validare;
								$headers = "From: apvfreg@gmail.com \r\n";
								mail($to, $subject, $mesaj, $headers);
							}
							header("location: autentificare.php");
							exit();
						}
					}
				}
			}
		}
	}
	else
	{
		header("location: inregistrare.php");
		exit();
	}
?>