
<?php
$account=$_GET["account"];
if($account!=null)
{
	switch($account)
	{
		case "utente":stampaLoginUtente();break;
		case "amministratore":stampaLoginAmministratore();break;
		case "comune":stampaLoginComune();break;
		case "ente":stampaLoginEnte();break;
		case "gruppo_di_lavoro":stampaLogingruppoDiLavoro();break;
		default: break;
	}
}

?>






<?php
function stampaLoginAmministratore()
{
	echo'<div id="main" class="wrapper style1">
  <div class="container">
    <header class="major">
      <h2>Accedi al sistema</h2>
    </header>
  </div>

	<div align="center">
	<img src="./images/amministratore.jpg" alt>
	</div>
	
<section>
    <form name="accedi" method="POST" action="./pagine/registrato/verificaAccount.php">
		<div class="container" align="center"><br>
    <label for="uname" ><b>Username:</b></label>
    <input type="text" placeholder="Inserisci il tuo username" name="username" required ><br>
    <label for="psw" align="center"><b>Password:</b></label>
    <input type="password" placeholder="Inserisci password" name="password" required ><br>
    <input type="hidden" name="ruolo" value="amministratore">
  </div>
		<center><input type="submit" value="Login" class="primary" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="Cancella" align="center" /></center>
    
     </form>
	</section>
    </div>';
}
function stampaLoginComune()
{
	echo'
<div id="main" class="wrapper style1">
  <div class="container">
    <header class="major">
      <h2>Accedi al sistema</h2>
    </header>
  </div>

	<div align="center">
	<img src="./images/comune.jpg" alt>
	</div>
	
<section>
    <form name="accedi" method="POST" action="./pagine/registrato/verificaAccount.php">
		<div class="container" align="center"><br>
    <label for="uname" ><b>Username:</b></label>
    <input type="text" placeholder="Inserisci il tuo username" name="username" required ><br>
    <label for="psw" align="center"><b>Password:</b></label>
    <input type="password" placeholder="Inserisci password" name="password" required ><br>
   <input type="hidden" name="ruolo" value="comune">
  </div>
		<center><input type="submit" value="Login" class="primary" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="Cancella" align="center" /></center>
    
     </form>
	</section>
    </div>';
}
function stampaLoginEnte()
{
	echo'
<div id="main" class="wrapper style1">
  <div class="container">
    <header class="major">
      <h2>Accedi al sistema</h2>
    </header>
  </div>

	<div align="center">
	<img src="./images/ente.jpg" alt>
	</div>
	
<section>
    <form name="accedi" method="POST" action="./pagine/registrato/verificaAccount.php">
		<div class="container" align="center"><br>
    <label for="uname" ><b>Username:</b></label>
    <input type="text" placeholder="Inserisci il tuo username" name="username" required ><br>
    <label for="psw" align="center"><b>Password:</b></label>
    <input type="password" placeholder="Inserisci password" name="password" required ><br>
   <input type="hidden" name="ruolo" value="ente">
  </div>
		<center><input type="submit" value="Login" class="primary" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="Cancella" align="center" /></center>
    
     </form>
	</section>
    </div>
  ';
}
function stampaLoginGruppoDiLavoro()
{
	echo'<div id="main" class="wrapper style1">
  <div class="container">
    <header class="major">
      <h2>Accedi al sistema</h2>
    </header>
  </div>

	<div align="center">
	<img src="./images/gruppo_di_lavoro.jpg" alt>
	</div>
	
<section>
    <form name="accedi" method="POST" action="./pagine/registrato/verificaAccount.php">
		<div class="container" align="center"><br>
    <label for="uname" ><b>Username:</b></label>
    <input type="text" placeholder="Inserisci il tuo username" name="username" required ><br>
    <label for="psw" align="center"><b>Password:</b></label>
    <input type="password" placeholder="Inserisci password" name="password" required ><br>
   <input type="hidden" name="ruolo" value="gruppo_di_lavoro">
  </div>
		<center><input type="submit" value="Login" class="primary" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="Cancella" align="center" /></center>
    
     </form>
	</section>
    </div>';
}
function stampaLoginUtente()
{
	echo '
<div id="main" class="wrapper style1">
  <div class="container">
    <header class="major">
      <h2>Accedi al sistema</h2>
    </header>
  </div>

	<div align="center">
	<img src="./images/utente.png" alt>
	</div>
	
<section>
    <form name="accedi" method="POST" action="./pagine/registrato/verificaAccount.php">
		<div class="container" align="center"><br>
    <label for="uname" ><b>Username:</b></label>
    <input type="text" placeholder="Inserisci il tuo username" name="username" required ><br>
    <label for="psw" align="center"><b>Password:</b></label>
    <input type="password" placeholder="Inserisci password" name="password" required ><br>
    <input type="hidden" name="ruolo" value="utente">
  </div>
		<center><input type="submit" value="Login" class="primary" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="Cancella" align="center" /></center>
    
     </form>
	</section>
    </div>

';
}



?>