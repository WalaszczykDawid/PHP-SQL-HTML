<!DOCTYPE html>
<html>
<body>

<h1>Elementy orginalne lub akcesoryjne</h1>

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
    <th>Stary element: </th>
    <th>Nowa część: </th>
	<th>Data wymiany: </th>
	<th>Koszt: </th>
  </tr>

<?php
include_once("db.php");
session_start(); 

if (isset($_SESSION['id']))
{
	$query = "SELECT ID,
				ELEMENT_OLD,
				ELEMENT_NEW,
				CHANGE_DATE,
				COST
			FROM ELEMENT_CHANGE 
				ORDER BY ID ASC
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
				  <th>{$row[4]}</td>
				  </tr>";
		}
	}
}
?>


<h2>Dodawanie elementów wymienionych:</h2>
<form action="element_add.php" method="post">
  <label>Stary element: </label>
  <input type="text" name="ELEMENT_OLD"><br>
  <label>Nowy element: </label>
  <input type="text" name="ELEMENT_NEW"><br>
  <label>Data wymiany: </label>
  <input type="date" name="CHANGE_DATE"><br>
  <label>Koszt: </label>
  <input type="number" name="COST"><br><br>
  <input type="submit" value="Dodaj">
</form> 


<h2>Edycja rekordów:</h2>
<p>Podaj id rekordu i wpisz nowe dane.</p>
<form action="element_change.php" method="post">
    Id: <input type="number" name="id" required><br>
	<label>Stary element: </label>
	<input type="text" name="ELEMENT_OLD"><br>
	<label>Nowy element: </label>
	<input type="text" name="ELEMENT_NEW"><br>
	<label>Data wymiany: </label>
	<input type="date" name="CHANGE_DATE"><br>
	<label>Koszt: </label>
	<input type="number" name="COST"><br><br>
    <input type="submit" value="Zmień dane"><br><br>
</form>


<h2>Usuwanie rekordów:</h2>
<form action="element_remove.php" method="post">
    Podaj id rekordu do usunięcia: <input type="number" name="id" required>
    <input type="submit" value="Usuń rekord"><br><br>
</form>


<h2>Wyszukiwanie:</h2>
<form action="element_search.php" method="post">
    Podaj część nazwy starego elementu do wyszukania (wielkość litery ma znaczenie): <input type="text" name="name" required>
    <input type="submit" value="Wyszukaj"><br><br>
</form>


<form action="lista_widok.php" method="post">
    <input type="submit" value="Powrót do widoku listy"><br><br>
</form>


<h2>Elementy wymienione w trakcie użytkowania motocykla:</h2>

</body>
</html>
