<?php
include_once("db.php");
session_start();
if (!isset($_SESSION['id']))
{
	header("Location: login.php");
	die();
}
if (
    (isset($_POST['id']))
	){
		$id = $_POST['id'];
		
		$query = "DELETE ELEMENT_CHANGE WHERE id=:id";
		
		$c = PolaczZoracle();
		$stm = oci_parse($c, $query);
		
		oci_bind_by_name($stm,':id',$id);
	
		if (oci_execute($stm)){
		    oci_free_statement($stm);	
			echo "<strong>Usuwam rekord numer $id.</strong><br>";
		}else{
			header("Location: lista_widok.php");			
		}	
		oci_close($c);	
	}
	else{
		header("Location: login.php");
	}
?>

<html>
<body>


<form action="element.php" method="post">
    <input type="submit" value="Powrót"><br><br>
</form>

</body>
</html>