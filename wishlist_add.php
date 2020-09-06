<?php
include_once("db.php");
session_start();
if (!isset($_SESSION['id']))
{
	header("Location: login.php");
	die();
}
if (
    (isset($_POST['NAME'])) &&
    (isset($_POST['COST']))
	){		
		$name = $_POST['NAME'];
		$cost = $_POST['COST'];

		$query = "INSERT INTO wish_list (NAME,
		  COST)
		VALUES(:name, :cost)";
		
		$c = PolaczZoracle();
		
		$stm = oci_parse($c, $query);
		
		oci_bind_by_name($stm,':NAME',$name);
		oci_bind_by_name($stm,':COST',$cost);
		
		if (oci_execute($stm)){
		    oci_free_statement($stm);	
			header("Location: wishlist.php");
		}else{
			header("Location: lista_widok.php");				
		}			
		oci_close($c);
	}
	else{
		header("Location: login.php");
	}

?>