<!DOCTYPE html>
<html>
<body>

<h1>Usługi</h1>


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

if (isset($_SESSION['id']))
{
	
		$query = "SELECT id, service_name, service_date, cost
		FROM services_add ORDER BY id ASC
             ";
				
		$c = PolaczZoracle();
		
		$stm = oci_parse($c, $query);
			
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

<h2>Dodawanie usług:</h2>

<form action="service_add.php" method="post">
  <label>Nazwa usługi: </label>
  <input type="text" name="nazwa" required><br>
  <label>Data: </label>
  <input type="date" name="data" required><br>
  <label>Koszt: </label>
  <input type="number" name="wartosc" required><br><br>
  <input type="submit" value="Dodaj">
</form> 


<h2>Edycja usług:</h2>
<p>Podaj id usługi i wpisz nowe dane.</p>
 
<form action="service_change.php" method="post">
    Id: <input type="number" name="id" required><br>
    Nowa nazwa usługi: <input type="text" name="service_name" required><br>
    Data: <input type="date" name="service_date" required><br>
    Koszt: <input type="number" name="cost" required><br><br>
    <input type="submit" value="Zmień dane"><br><br>
</form>


<h2>Usuwanie usług:</h2>

<form action="service_remove.php" method="post">
    Podaj id usługi do usunięcia: <input type="number" name="id" required>
    <input type="submit" value="Usuń rekord"><br><br>
</form>


<h2>Wyszukiwanie:</h2>
<form action="service_search.php" method="post">
    Podaj część nazwy do wyszukania (wielkość litery ma znaczenie): <input type="text" name="name" required>
    <input type="submit" value="Wyszukaj"><br><br>
</form>


<form action="lista_widok.php" method="post">
    <input type="submit" value="Powrót do widoku listy"><br><br>
</form>


<h2>Lista usług:</h2>
</body>
</html>
