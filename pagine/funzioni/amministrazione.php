	<?php

	define ('UPDATE',' UPDATE ');
	define ('WHERE', ' WHERE ');
	define ('CODICE', ' codice ');
	define ('USERNAME', 'username');
define ('EMAIL', 'email');
define ('CODICE1', 'codice');
define ('PASSWORD', 'password');
define ('CONNESSIONE_DB_FALLITA', "Connessione database fallita.");
define ('SCRIPT_TYPE', '<script type="text/javascript">alert(');
define ('SCRIPT', '")</script>');
define ('UNION', '(select username,email from amministratore) union (select username,email from comune) union (select username,email from ente) union (select username,email from gruppo_di_lavoro) union (select username,email from utente)');
define ('BR', '<br><br>');
define ('COMUNE', 'comune');
define ('GRUPPO', 'gruppo_di_lavoro');
define ('GRUPPO1', 'gruppo');
define ('CODICE_ACCOUNT', 'codiceAccount');
define ('TD', '</td>');
define ('SELECT', "select * from ");

	function modificaAccountComEnte( $tipoAccount, $conn, $codice, $username, $email, $password, $nome ) {
		
		$array = inizializzaArrayControllo( $username, $email, $password, $nome );


		if ( $conn ) {
			$sql = UNION;
			$queryUnione = mysqli_query( $conn, $sql );
			if ( isset( $queryUnione ) ) {
				$array = verificaDatiDuplicati( $conn, $queryUnione, $username, $email, $tipoAccount, $codice, $password, $nome, $array );


				if ( $array[ 0 ] == 1 ) {
					$query = UPDATE . $tipoAccount . "
								  SET username = '" . $username . "'".
								  WHERE. CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 0 ] = 0;
					} else {
						$_SESSION[ USERNAME ] = $username;
					}




				}



				if ( $array[ 1 ] == 1 ) {
					$query = UPDATE . $tipoAccount . "
								  SET email = '" . $email . "'".
								  WHERE .CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 1 ] = 0;
					} else {
						$_SESSION[ EMAIL ] = $email;
					}


				}



				if ( $array[ 2 ] == 1 ) {
					$query = UPDATE . $tipoAccount . "
								  SET password = '" . $password . "'".
								  WHERE .CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 2 ] = 0;
					} else {
						$_SESSION[ PASSWORD ] = $password;
					}


				}



				if ( $array[ 3 ] == 1 ) {
					$query = UPDATE . $tipoAccount . "
								  SET nome = '" . $nome . "'".
								  WHERE .CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 3 ] = 0;
					} else {
						$_SESSION[ "nome" ] = $nome;
					}


				}

				stampaAllert( $array );
			}

		} else {
			echo CONNESSIONE_DB_FALLITA;
		}
	}

	function verificaDatiDuplicati( $conn, $queryUnione, $username, $email, $tipoAccount, $codice, $password, $nome, $array ) {
	
		if ( mysqli_num_rows( $queryUnione ) > 0 ) {
			// output data of each row
			while ( $row = mysqli_fetch_assoc( $queryUnione ) ) {
				if ( $array[ 0 ] == 1 && strcasecmp( $username, $row[ USERNAME ] ) == 0 ) {
					$array[ 0 ] = 0;
				}
				if ( $array[ 1 ] == 1 && strcasecmp( $email, $row[ EMAIL ] ) == 0 ) {
					$array[ 1 ] = 0;
				}

			}

		}

		$sql = SELECT . $tipoAccount .  WHERE . CODICE ."='" . $codice . "'";

		$querySelezione = mysqli_query( $conn, $sql );
		if ( isset( $querySelezione ) && mysqli_num_rows( $querySelezione ) > 0) {
	
				// output data of each row

				while ( $row = mysqli_fetch_assoc( $querySelezione ) ) {
					if ( $array[ 2 ] == 1 && strcasecmp( $password, $row[ PASSWORD ] ) == 0 ) {
						$array[ 2 ] = 0;
					}

					if ( $nome != null && $array[ 3 ] == 1 && strcasecmp( $nome, $row[ "nome" ] ) == 0 ) {
						$array[ 3 ] = 0;
					}

				}


		} else {
			echo SCRIPT_TYPE.'"MANCA LA TABELLA ' . strtoupper( $tipoAccount ) . ' NEL SISTEMA '.SCRIPT;

		}
		return $array;
	}



	function modificaAccountFiglio( $tipoAccount, $conn, $codice, $username, $email, $password, $nome ) {
		
		$array = inizializzaArrayControllo( $username, $email, $password, $nome );

		if ( $conn ) {
			$sql = UNION;
			$queryUnione = mysqli_query( $conn, $sql );
			if ( isset( $queryUnione ) ) {
				$array = verificaDatiDuplicati( $conn, $queryUnione, $username, $email, $tipoAccount, $codice, $password, $nome, $array );

				if ( $array[ 0 ] == 1 ) {
					$query = UPDATE . $tipoAccount . " 
								  SET username = '" . $username . "'"
								  .WHERE. CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 0 ] = 0;
					}


				}



				if ( $array[ 1 ] == 1 ) {
					$query = UPDATE . $tipoAccount . " 
								  SET email = '" . $email . "'" .
								  WHERE .CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 1 ] = 0;
					}


				}



				if ( $array[ 2 ] == 1 ) {
					$query = UPDATE . $tipoAccount . " 
								  SET password = '" . $password . "'".
								  WHERE . "codice = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 2 ] = 0;
					}


				}



				if ( $array[ 3 ] == 1 ) {
					$query = UPDATE . $tipoAccount . " 
								  SET nome = '" . $nome . "'".
								  WHERE .CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 3 ] = 0;
					}


				}

				stampaAllert( $array );



			}





		} else {
			echo CONNESSIONE_DB_FALLITA;
		}


	}

	function stampaAllert( $array ) {
		for ( $j = 0; $j < 2; $j++ ) {
			$stringa = null;
			$checked = 0;
			for ( $i = 0; $i < 4; $i = $i + 1 ) {
				if ( $array[ $i ] == $j ) {
					$checked = 1;
				}
			}

			if ( $checked == 1 ) {
				if ( $j == 0 ) {
					$stringa = "I SEGUENTI DATI NON SONO STATI MODIFICATI:";
				} else {
					$stringa = "DATI MODIFICATI:";
				}
				for ( $i = 0; $i < 4; $i = $i + 1 ) {
					if ( $array[ $i ] == $j ) {
						switch ( $i ) {
							case 0:
								$stringa .= " USERNAME";
								break;
							case 1:
								$stringa .= " EMAIL";
								break;
							case 2:
								$stringa .= " PASSWORD";
								break;
							case 3:
								$stringa .= " NOME";
								break;
							default:
								break;
						}
					}
				}
				echo SCRIPT_TYPE.'"' . $stringa . ''.SCRIPT;
			}



		}
	}


	function modificaAccountGruppoUtente( $tipoAccount, $conn, $codice, $username, $email, $password ) {

		$array = inizializzaArrayControllo( $username, $email, $password, "" );


		if ( $conn ) {
			$sql = UNION;
			$queryUnione = mysqli_query( $conn, $sql );
			if ( isset( $queryUnione ) ) {
				$array = verificaDatiDuplicati( $conn, $queryUnione, $username, $email, $tipoAccount, $codice, $password, null, $array );


				if ( $array[ 0 ] == 1 ) {
					$query = UPDATE . $tipoAccount . " 
								  SET username = '" . $username . "'".
								  WHERE .CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 0 ] = 0;
					} else {
						if ( $_SESSION[ CODICE1 ] == 4 || $_SESSION[ CODICE1 ] == 5 ) {
							$_SESSION[ USERNAME ] = $username;
						}
					}




				}



				if ( $array[ 1 ] == 1 ) {
					$query = UPDATE . $tipoAccount . " 
								  SET email = '" . $email . "'".
								  WHERE .CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 1 ] = 0;
					} else {
						if ( $_SESSION[ CODICE1 ] == 4 || $_SESSION[ CODICE1 ] == 5 ) {
							$_SESSION[ EMAIL ] = $email;
						}
					}


				}



				if ( $array[ 2 ] == 1 ) {
					$query = UPDATE . $tipoAccount . " 
								  SET password = '" . $password . "'". 
								  WHERE .CODICE ." = '" . $codice . "' ";
					$result = mysqli_query( $conn, $query );
					if ( $result == null ) {

						$array[ 2 ] = 0;
					} else {
						if ( $_SESSION[ CODICE1 ] == 4 || $_SESSION[ CODICE1 ] == 5 ) {
							$_SESSION[ PASSWORD ] = $password;
						}
					}

				}





				for ( $j = 0; $j < 2; $j++ ) {
					$stringa = null;
					$checked = 0;
					for ( $i = 0; $i < 3; $i = $i + 1 ) {
						if ( $array[ $i ] == $j ) {
							$checked = 1;
						}
					}

					if ( $checked == 1 ) {
						if ( $j == 0 ) {
							$stringa = "I SEGUENTI DATI NON SONO STATI MODIFICATI:";
						} else {
							$stringa = "DATI MODIFICATI:";
						}
						for ( $i = 0; $i < 3; $i = $i + 1 ) {
							if ( $array[ $i ] == $j ) {
								switch ( $i ) {
									case 0:
										$stringa .= " USERNAME";
										break;
									case 1:
										$stringa .= " EMAIL";
										break;
									case 2:
										$stringa .= " PASSWORD";
										break;
									default:
										break;
								}
							}
						}
						echo SCRIPT_TYPE.'"' . $stringa . ''.SCRIPT;
					}
				}






			}







		} else {
			echo CONNESSIONE_DB_FALLITA;
		}



	}


	function visualizzaProfilo( $tipoAccount, $codice, $conn ) {
		$sql = SELECT . $tipoAccount . " where codice = '" . $codice . "'";
		$query = mysqli_query( $conn, $sql );
		// output data of each row
		$profilo = mysqli_fetch_assoc( $query );

		echo 'Codice: ' . $profilo[ CODICE1 ] . BR;
		echo 'Username: ' . $profilo[ USERNAME ] . BR;
		echo 'Password: ' . $profilo[ PASSWORD ] . BR;
		echo 'Email: ' . $profilo[ EMAIL ] . BR;
		if ( $tipoAccount == "ente" || $tipoAccount == COMUNE ) {
			echo "Nome: " . $profilo[ "nome" ] . BR;
		}
		$cartella = null;
		switch ( $tipoAccount ) {
			case 'utente':
				$cartella .= "utente/profiloUtente";
				break;
			case GRUPPO:
				$cartella = "attivitaAmministrativa/gruppoDiLavoro";
				break;
			default:
				$cartella = "attivitaAmministrativa/" . $tipoAccount;
		}


		echo '
					 <form action="./index.php?pagina=registrato/' . $cartella . '/modifica.php&codice=' . $profilo[ CODICE1 ] . '"  method="POST"> 
		<input type="submit" value="Modifica">
		</form>';

	}


	function creaUteGrup( $username, $password, $email, $ente, $conn ) {
		$sql = UNION;
		$queryUnione = mysqli_query( $conn, $sql );
		$array = array( 0, 0 );
		$errore = true;
		if ( isset( $queryUnione ) ) {
			if ( mysqli_num_rows( $queryUnione ) > 0 ) {
				// output data of each row
				while ( $profilo = mysqli_fetch_assoc( $queryUnione ) ) {

					if ( strcasecmp( $username, $profilo[ USERNAME ] ) == 0 ) {
						$array[ 0 ] = 1;
					}

					if ( strcasecmp( $email, $profilo[ EMAIL ] ) == 0 ) {
						$array[ 1 ] = 1;
					}




				}

			}

			$stringa = null;
			$checked = 0;
			for ( $i = 0; $i < 2; $i = $i + 1 ) {
				if ( $array[ $i ] == 1 ) {
					$checked = 1;
				}
			}
			$utente = null;
			if ( $ente == null ) {
				$utente = "utente";
			} else {
				$utente = GRUPPO1;
			}

			if ( $checked == 1 ) {
				$stringa = "IMPOSSIBILE INSERIRE " . strtoupper( $utente ) . "  PERCHÈ I SEGUENTI DATI SONO GIÀ PRESENTI NEL SISTEMA:";
				for ( $i = 0; $i < 2; $i = $i + 1 ) {
					if ( $array[ $i ] == 1 ) {
						if ( $i == 0 ) {
							$stringa .= " Username";
						} else {
							$stringa .= " Email";
						}

					}
				}
				echo SCRIPT_TYPE.'"' . $stringa . ''.SCRIPT;
			} else {
				$sql = null;
				if ( $utente == GRUPPO1 ) {
					$sql = "INSERT INTO gruppo_di_lavoro (username,password,email,ente) VALUES ('" . $username . "','" . $password . "','" . $email . "','" . $ente . "')";
				} else {
					$sql = "INSERT INTO utente (username,password,email) VALUES ('" . $username . "','" . $password . "','" . $email . "')";
				}

				mysqli_query( $conn, $sql );
				if ( $utente == GRUPPO1 ) {
					if ( isset( $sql ) ) {
						echo SCRIPT_TYPE.'"GRUPPO INSERITO NEL SISTEMA!!!'.SCRIPT;
						$errore = false;
					} else {
						echo SCRIPT_TYPE.'"IMPOSSIBILE INSERIRE GRUPPO NEL SISTEMA!!!'.SCRIPT;

					}
				} else {
					if ( isset( $sql ) ) {
						echo SCRIPT_TYPE.'"TI SEI ISCRITTO AL SISTEMA!!!'.SCRIPT;
						$errore = false;
					} else {
						echo SCRIPT_TYPE.'"IMPOSSIBILE INSERIRE ACCOUNT NEL SISTEMA!!!'.SCRIPT;

					}

				}
			}

		} else {
			echo SCRIPT_TYPE.'"MANCA QUALCHE TABELLA NEL SISTEMA '.SCRIPT;
		}

		return $errore;
	}


	function creaComEnte( $username, $password, $email, $nome, $codComune, $conn ) {
		$sql = UNION;
		$queryUnione = mysqli_query( $conn, $sql );

		if ( isset( $queryUnione ) ) {
			if ( mysqli_num_rows( $queryUnione ) > 0 ) {
				// output data of each row
				$array = array( 0, 0, 0, 0 );
				while ( $row = mysqli_fetch_assoc( $queryUnione ) ) {

					if ( strcasecmp( $username, $row[ USERNAME ] ) == 0 ) {
						$array[ 0 ] = 1;
					}

					if ( strcasecmp( $email, $row[ EMAIL ] ) == 0 ) {
						$array[ 1 ] = 1;
					}




				}

			}
			if ( $codComune == null ) {
				$tipoAccount = "ente";
				$lungArray = 3;
			} else {
				$tipoAccount = COMUNE;
				$lungArray = 4;
			}

			$sql = "select codice,nome from " . $tipoAccount;
			$querySelezione = mysqli_query( $conn, $sql );
			if ( isset( $querySelezione ) ) {
				if ( mysqli_num_rows( $querySelezione ) > 0 ) {
					// output data of each row
					while ( $row = mysqli_fetch_assoc( $querySelezione ) ) {
						if ( strcasecmp( $nome, $row[ "nome" ] ) == 0 ) {
							$array[ 2 ] = 1;
						}
						if ( $tipoAccount == COMUNE && strcasecmp( $codComune, $row[ CODICE1 ] ) == 0 ) {

							$array[ 3 ] = 1;

						}

					}

				}
			} else {
				echo SCRIPT_TYPE.'"MANCA LA TABELLA ' . strtoupper( $tipoAccount ) . ' NEL SISTEMA '.SCRIPT;

			}
			$stringa = null;
			$checked = 0;
			for ( $i = 0; $i < $lungArray; $i = $i + 1 ) {
				if ( $array[ $i ] == 1 ) {
					$checked = 1;
				}
			}
			if ( $checked == 1 ) {
				$stringa = "IMPOSSIBILE INSERIRE " . strtoupper( $tipoAccount ) . " PERCHÈ I SEGUENTI DATI SONO GIÀ PRESENTI NEL SISTEMA:";
				for ( $i = 0; $i < $lungArray; $i = $i + 1 ) {
					if ( $array[ $i ] == 1 ) {
						switch ( $i ) {
							case 0:
								$stringa .= " Username";
								break;
							case 1:
								$stringa .= " Email";
								break;
							case 2:
								$stringa .= " Nome";
								break;
							case 3:
								$stringa .= CODICE ."";
								break;
							default:
								break;
						}
					}
				}
				echo SCRIPT_TYPE.'"' . $stringa . ''.SCRIPT;
			} else {
				if ( $tipoAccount == COMUNE ) {
					$sql = "INSERT INTO " . $tipoAccount . " (codice,username,password,email,nome,amministratore) VALUES ('" . $codComune . "','" . $username . "','" . $password . "','" . $email . "','" . $nome . "','" . $_SESSION[ CODICE_ACCOUNT ] . "')";
				} else {
					$sql = "INSERT INTO " . $tipoAccount . " (username,password,email,nome,comune) VALUES ('" . $username . "','" . $password . "','" . $email . "','" . $nome . "','" . $_SESSION[ CODICE_ACCOUNT ] . "')";
				}
				mysqli_query( $conn, $sql );
				if ( isset( $sql ) ) {
					echo SCRIPT_TYPE.'"' . strtoupper( $tipoAccount ) . ' INSERITO NEL SISTEMA!!!'.SCRIPT;
				} else {
					echo SCRIPT_TYPE.'"IMPOSSIBILE INSERIRE ' . strtoupper( $tipoAccount ) . ' NEL SISTEMA!!!'.SCRIPT;
				}
			}


		} else {
			echo SCRIPT_TYPE.'"MANCA QUALCHE TABELLA NEL SISTEMA '.SCRIPT;
		}





	}


	function inizializzaArrayControllo( $username, $email, $password, $nome ) {
		$array = array( 0, 0, 0, 0 );

		if ( $username != "" ) {
			$array[ 0 ] = 1;
		} else {
			$array[ 0 ] = -1;
		}



		if ( $email != "" ) {
			$array[ 1 ] = 1;
		} else {
			$array[ 1 ] = -1;
		}



		if ( $password != "" ) {
			$array[ 2 ] = 1;
		} else {
			$array[ 2 ] = -1;
		}


		if ( $nome != "" ) {
			$array[ 3 ] = 1;
		} else {
			$array[ 3 ] = -1;
		}

		return $array;
	}

	function viewFigli( $tipoAccount, $conn ) {
		switch ( $tipoAccount ) {
			case 'amministratore':
				$figlio = COMUNE;
				$cartella = "amministratore/gestioneComune";
				break;
			case COMUNE:
				$figlio = "ente";
				$cartella = "comune/gestioneEnte";
				break;
			case 'ente':
				$figlio = GRUPPO;
				$cartella = "ente/gestioneGruppo";
				break;
			default: break;

		}



		$sql = SELECT . $figlio . ' where ' . $tipoAccount . ' = "' . $_SESSION[ CODICE_ACCOUNT ] . '"';
		$result = mysqli_query( $conn, $sql );
		if ( mysqli_num_rows( $result ) > 0 ) {

			while ( $rows = mysqli_fetch_assoc( $result ) ) {
				$codice = $rows[ 'codice' ];
				echo "<tr>";
				//eliminazione

				echo '<td align>
		
		  
		<form action="./index.php?pagina=registrato/attivitaAmministrativa/' . $cartella . '/delete.php&codice=' . $codice . '" onsubmit="return confirm_update();"  method="POST" id="user_update"> 
		<input type="submit" value="elimina">
		</form>
		  <td>
		  <form action="./index.php?pagina=registrato/attivitaAmministrativa/' . $cartella . '/modifica.php&codice=' . $codice . '"  method="POST"> 
		<input type="submit" value="Modifica">
		</form></td>';
				echo "<td>" . $rows[ CODICE1 ] . TD;
				echo "<td>" . $rows[ USERNAME ] . TD;
				echo "<td>" . $rows[ EMAIL ] . TD;
				echo "<td>" . $rows[ PASSWORD ] . TD;

				if ( $figlio != GRUPPO ) {
					echo "<td>" . $rows[ 'nome' ] . TD;
				}




				echo "</tr>";
			}
		}
	}
	?>