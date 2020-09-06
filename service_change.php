<?php
include_once("db.php");
session_start();
if (!isset($_SESSION['id']))
{
	header("Location: login.php");
	die();
}
if (
	(isset($_POST['id'])) &&
    (isset($_POST['service_name'])) &&
    (isset($_POST['service_date']))&&
    (isset($_POST['cost']))
	){
		$id = $_POST['id'];
		$service_name = $_POST['service_name'];
		$service_date = $_POST['service_date'];
		$cost = $_POST['cost'];

		$query = "UPDATE services_add SET
					service_name = :service_name,
					service_date = :service_date,
					cost = :cost
		 WHERE id = :id";
		
		$c = PolaczZoracle();
		
		$stm = oci_parse($c, $query);
		
		oci_bind_by_name($stm,':id',$id);
		oci_bind_by_name($stm,':service_name',$service_name);
		oci_bind_by_name($stm,':service_date',$service_date);
		oci_bind_by_name($stm,':cost',$cost);
		
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