<!DOCTYPE html>
<html>
<body>

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
 
<h1>Eksploatacja motocykla</h1>

<table style="width:20%">

  <tr>
    <th>ID: </th>
    <th>Wymieniany element: </th>
	<th>Aktywność: </th>
	<th>Przebieg: </th>
    <th>Data: </th>
	<th>Koszt: </th>
  </tr>

<?php
include_once("db.php");
session_start(); 

if (isset($_SESSION['id']))
{
	$query = "SELECT 
		id,
		EXPLOATION_OBJECT,
		EXPLOATION_ACTIVITY, 
		MOTORCYKLE_RANGE, 
		EXPLOATION_DATE, 
		COST
	FROM EXPLOATIONS 
		ORDER BY id ASC
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
				  <td>{$row[4]}</td>
				  <td>{$row[5]}</td>
				  </tr>";
		}
	}
}
?>


<h2>Wymiana eksploatowanych elementów:</h2>
<form action="exploatation_add.php" method="post">
  <label>Element: </label>
  <input type="text" name="element" required><br>
  <label>Aktywność: </label>
  <input type="text" name="activity" required><br>
  <label>Przebieg motocykla: </label>
  <input type="number" name="range" required><br>
  <label>Data: </label>
  <input type="date" name="data" required><br>
  <label>Koszt: </label>
  <input type="number" name="cost" required><br><br>
  <input type="submit" value="Dodaj">
</form> 


<h2>Edycja rekordów eksploatacji</h2>
<p>Podaj id eksploatacji i wpisz nowe dane.</p>
 
<form action="exploatation_change.php" method="post">
    Id: <input type="number" name="ID" required><br>
    Element eksploatowany: <input type="text" name="EXPLOATION_OBJECT" required><br>
	Aktywność: <input type="text" name="EXPLOATION_ACTIVITY" required><br>
	Przebieg motocykla: <input type="number" name="MOTORCYKLE_RANGE" required><br>
    Data: <input type="date" name="EXPLOATION_DATE" required><br>
    Koszt: <input type="number" name="COST" required><br><br>
    <input type="submit" value="Zmień dane"><br><br>
</form>


<h2>Usuwanie rekordów eksploatacji</h2>

<form action="exploatation_remove.php" method="post">
    Podaj id aktywności by ją usunąć: <input type="number" name="id" required>
    <input type="submit" value="Usuń rekord"><br><br>
</form>


<h2>Wyszukiwanie:</h2>
<form action="exploatation_search.php" method="post">
    Podaj część nazwy elementu do wyszukania (wielkość litery ma znaczenie): <input type="text" name="name" required>
    <input type="submit" value="Wyszukaj"><br><br>
</form>


<form action="lista_widok.php" method="post">
    <input type="submit" value="Powrót do widoku listy"><br><br>
</form>

<h3>Lista eksploatacji:</h3>

</body>
</html>
