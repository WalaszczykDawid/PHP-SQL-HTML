<?php
include_once("db.php");
session_start();
if (!isset($_SESSION['id']))
{
	header("Location: login.php");
	die();
}
if (
    (isset($_POST['ELEMENT_OLD']))&&
    (isset($_POST['ELEMENT_NEW']))&&
	(isset($_POST['CHANGE_DATE']))&&
    (isset($_POST['COST']))
	){	
		$old = $_POST['ELEMENT_OLD'];
		$new = $_POST['ELEMENT_NEW'];
		$date = $_POST['CHANGE_DATE'];
		$cost = $_POST['COST'];
		
		$query = "INSERT INTO ELEMENT_CHANGE (
					ELEMENT_OLD,
					ELEMENT_NEW,
					CHANGE_DATE,
					COST)
				VALUES(:ELEMENT_OLD, :ELEMENT_NEW, :CHANGE_DATE, :COST)";
		
		$c = PolaczZoracle();
		
		$stm = oci_parse($c, $query);
		
		oci_bind_by_name($stm,':ELEMENT_OLD',$old);
		oci_bind_by_name($stm,':ELEMENT_NEW',$new);
		oci_bind_by_name($stm,':CHANGE_DATE',$date);
		oci_bind_by_name($stm,':COST',$cost);
		
		if (oci_execute($stm)){
		    oci_free_statement($stm);	
			header("Location: element.php");
		}else{	
			header("Location: lista_widok.php");				
		}						
		oci_close($c);
	}
else{
	header("Location: login.php");
}

