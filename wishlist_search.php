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
    <th>Nazwa: </th>
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
		
	$query = "SELECT * FROM WISH_LIST 
				WHERE NAME LIKE :name
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
				  </tr>";
		}
	}
}
?>

<html>
<body>


<form action="wishlist.php" method="post">
    <input type="submit" value="Powrót"><br><br>
</form>

</body>
</html>