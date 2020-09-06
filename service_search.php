<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}
th {
  text-align: left;
}
</style>
</head>

<table style="width:20%">
  <tr>
    <th>ID: </th>
    <th>Nazwa usługi: </th>
    <th>Data: </th>
	<th>Koszt: </th>
  </tr>

<?php
include_once("db.php");
session_start(); 

if (!isset($_SESSION['id']))
{
	header("Location: login.php");
	die();
}
if (isset($_POST['name']))
{		
	$name = "%".$_POST['name']."%";
		
	$query = "SELECT ID, SERVICE_NAME, SERVICE_DATE, COST FROM SERVICES_ADD 
				WHERE SERVICE_NAME LIKE :name
				ORDER BY SERVICE_DATE ASC
            ";
			
	$c = PolaczZoracle();		
	$stm = oci_parse($c, $query);
	
	oci_bind_by_name($stm,":name", $name);
	
	if (oci_execute($stm)){	
		while ($row = oci_fetch_row($stm))
		{			
			echo "<tr>
			      <td>{$row[0]}</td>
				  <td>{$row[1]}</td>
				  <td>{$row[2]}</td>
				  <td>{$row[3]}</td>
				  </tr>";
		}
	}
}
?>

<html>
<body>


<form action="service.php" method="post">
    <input type="submit" value="Powrót"><br><br>
</form>

</body>
</html>