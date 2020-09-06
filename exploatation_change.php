<?php
include_once("db.php");
session_start();
if (!isset($_SESSION['id']))
{
	header("Location: login.php");
	die();
}
if (
	(isset($_POST['ID'])) &&
    (isset($_POST['EXPLOATION_OBJECT'])) &&
    (isset($_POST['EXPLOATION_ACTIVITY']))&&
	(isset($_POST['MOTORCYKLE_RANGE'])) &&
	(isset($_POST['EXPLOATION_DATE'])) &&
    (isset($_POST['COST']))
	){
		$id = $_POST['ID'];
		$element = $_POST['EXPLOATION_OBJECT'];
		$activity = $_POST['EXPLOATION_ACTIVITY'];
		$range = $_POST['MOTORCYKLE_RANGE'];
		$data= $_POST['EXPLOATION_DATE'];
		$cost = $_POST['COST'];

		$query = "UPDATE EXPLOATIONS SET
					EXPLOATION_OBJECT = :EXPLOATION_OBJECT,
					EXPLOATION_ACTIVITY = :EXPLOATION_ACTIVITY,
					MOTORCYKLE_RANGE = :MOTORCYKLE_RANGE,
					EXPLOATION_DATE = :EXPLOATION_DATE,
					COST = :COST
		 WHERE ID = :ID";
		
		$c = PolaczZoracle();	
		$stm = oci_parse($c, $query);
		
		oci_bind_by_name($stm,':id',$id);
		oci_bind_by_name($stm,':EXPLOATION_OBJECT',$element);
		oci_bind_by_name($stm,':EXPLOATION_ACTIVITY',$activity);
		oci_bind_by_name($stm,':MOTORCYKLE_RANGE',$range);
		oci_bind_by_name($stm,':EXPLOATION_DATE',$data);
		oci_bind_by_name($stm,':COST',$cost);
		
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