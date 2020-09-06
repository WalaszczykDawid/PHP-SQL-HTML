<?php
include_once("db.php");
session_start();
if (!isset($_SESSION['id']))
{
	header("Location: login.php");
	die();
}
if (
    (isset($_POST['element'])) &&
    (isset($_POST['activity']))&&
	(isset($_POST['range'])) &&
	(isset($_POST['data'])) &&
    (isset($_POST['cost']))
	){	
		$element = $_POST['element'];
		$activity = $_POST['activity'];
		$range = $_POST['range'];
		$data= $_POST['data'];
		$cost = $_POST['cost'];

		$query = "INSERT INTO EXPLOATIONS (
			EXPLOATION_OBJECT,
			EXPLOATION_ACTIVITY,
			MOTORCYKLE_RANGE,
			EXPLOATION_DATE,
			COST
			)
		VALUES(:element, :activity, :range, :data, :cost)";
		
		$c = PolaczZoracle();		
		$stm = oci_parse($c, $query);
		
		oci_bind_by_name($stm,':element',$element);
		oci_bind_by_name($stm,':activity',$activity);
		oci_bind_by_name($stm,':range',$range);
		oci_bind_by_name($stm,':data',$data);
		oci_bind_by_name($stm,':cost',$cost);
		
		if (oci_execute($stm)){
		    oci_free_statement($stm);	
			header("Location: exploatation.php");
		}else{
			header("Location: lista_widok.php");				
		}						
		oci_close($c);
	}
	else{
		header("Location: login.php");
	}
?>