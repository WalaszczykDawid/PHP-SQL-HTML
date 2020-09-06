<?php
include_once("db.php");
session_start();
if (!isset($_SESSION['id']))
{
	header("Location: login.php");
	die();
}
if (
    (isset($_POST['nazwa'])) &&
    (isset($_POST['data']))&&
    (isset($_POST['wartosc']))
	){
		$nazwa = $_POST['nazwa'];
		$date = $_POST['data'];
		$wartosc = $_POST['wartosc'];

		$query = "INSERT INTO services_add (
					service_name,
					service_date,
					cost)
				VALUES(:nazwa, :data, :wartosc)";
		
		$c = PolaczZoracle();
		
		$stm = oci_parse($c, $query);
		
		oci_bind_by_name($stm,':nazwa',$nazwa);
		oci_bind_by_name($stm,':data',$date);
		oci_bind_by_name($stm,':wartosc',$wartosc);
		
		if (oci_execute($stm)){
		    oci_free_statement($stm);	
			header("Location: service.php");
		}else{		
			header("Location: lista_widok.php");				
		}
		oci_close($c);
	}
	else{
		header("Location: login.php");	
	}
?>