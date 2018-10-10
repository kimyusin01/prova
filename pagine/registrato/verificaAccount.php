<?php
define("CODICE", "codice");
define("PASSWORD", "password");
define("USERNAME", "username");
define("RUOLO", "ruolo");

include 'connect.php';
$codiceAccount=null;
$ruolo=$_POST[RUOLO];
$username = $_POST[USERNAME];
$password= $_POST[PASSWORD];
$checked=0;

if($conn)
{
	
	//query database per creazione vista formata da email,password e ruolo per ricerca
$sql="(select username,password,ruolo from amministratore) union (select username,password,ruolo from comune) union (select username,password,ruolo from ente) union (select username,password,ruolo from gruppo_di_lavoro) union (select username,password,ruolo from utente)";
	//inizio attività su vista di ricerca
	$queryUnione=mysqli_query($conn, $sql);
	
	if(isset($queryUnione))
	{
	if (mysqli_num_rows($queryUnione) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($queryUnione)) {
		
			if($username==$row[USERNAME] && $password==$row[PASSWORD] &&$ruolo==$row[RUOLO])
			{
				$checked=1;
			}
		
    	}	
		
	} 
		else 
		{	echo "mancano tabelle";
			
		}
if($checked==1)
	{
	
	$sql="select codice,username,password,ruolo from ".$ruolo." where username='".$username."' and password='".$password."'";
	$querySelezione=mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($querySelezione);
	if(isset($querySelezione))
	{
		session_start();
				$_SESSION["codiceAccount"]=($row[CODICE]);
				$_SESSION[USERNAME]=strtolower($username);
				$_SESSION[PASSWORD]=$password;
				$_SESSION[RUOLO]=strtolower($ruolo);
				
				switch($ruolo)
				{
					case "amministratore":
						$_SESSION[CODICE]=1;
						break;
					case "comune":
						$_SESSION[CODICE]=2;
						break;
					case "ente":
						$_SESSION[CODICE]=3;
						break;
					case "gruppo_di_lavoro":
						$_SESSION[CODICE]=4;break;
					case "utente":
						$_SESSION[CODICE]=5;break;
						default:break;
				}
				
				header("location: ./../../index.php?pagina=registrato/account.php");
				exit();
		
	}
	
	}
		else
		{
			
				echo "<script type='text/javascript'>alert('Login errato. Username e/o Password errati ');</script>";
			echo '<script>
				window.location = "./../../index.php?pagina=registrato/login.php&account='.$ruolo.'";
				</script>';
		}
		
}
	
	
	
	}
else
{
	echo "impossibile accedere in questo momento al database";
}
?>