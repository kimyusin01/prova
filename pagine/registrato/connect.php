<?php
$hostname="localhost";
$nomeutente="citizengo";
$password="";
$database="my_citizengo";



//-----------------------------------------------------------------
//connessione al server mysql
//-------------------------------------------------------------


$conn= mysqli_connect($hostname,$nomeutente,$password,$database);
if(! $conn)
	{
	echo "Errore durante la connessione al server";
	exit();
	}
	
	
	
	
//------------------------------------------------------------

// scelta del database my_citizengo
//-----------------------------------------------------------
$Dbcitizengo = mysqli_select_db($conn,$database);
if(! $Dbcitizengo)
	{
	echo "Connessione al database non effettuata";
	exit();
	}
	

	




?>
