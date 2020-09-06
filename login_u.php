<?php
include_once("db.php");
session_start();

header("Content-type: text/plain");

if (
    (isset($_POST['login'])) &&
    (isset($_POST['haslo']))
	){	
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$query = "SELECT * FROM user711 WHERE login=:login AND
			haslo=DBMS_CRYPTO.HASH(UTL_RAW.CAST_TO_RAW(:haslo),3)";
		
		$c = PolaczZoracle();
		
		$stm = oci_parse($c, $query);
		oci_bind_by_name($stm,':login',$login);
		oci_bind_by_name($stm,':haslo',$haslo);
		
		if (oci_execute($stm)){
			
			$numrows = oci_fetch_all($stm,$res);
			if ($numrows == 1){
				echo "zalogowany - DB";

				$_SESSION['login'] = $login;
				$_SESSION['id'] = $res['ID'][0];
				
				header("Location: lista_widok.php");
			}else{
				$_SESSION['error'] = "bledny login lub haslo";
				header("Location: login.php");
			}
			oci_free_statement($stm);
		}
		else{
			echo "Stm nie został wykonany poprawnie";		
			header("Location: login.php");
		}
		
		oci_close($c);
	
	}
	else{
		header("Location: login.php");
	}

?>