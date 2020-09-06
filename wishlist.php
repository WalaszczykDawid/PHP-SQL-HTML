<!DOCTYPE html>
<html>
<body>

<h1>Lista życzeń</h1>

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
    <th>Część motocykla: </th>
	<th>Koszt: </th>
  </tr>

<?php
include_once("db.php");
session_start(); 

if (isset($_SESSION['id']))
{
	$query = "SELECT ID, NAME, COST
				FROM WISH_LIST 
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
				  </tr>";
		}
	}
}
?>


<h2>Dodawanie części:</h2>
<form action="wishlist_add.php" method="post">
  <label>Nazwa części: </label>
  <input type="text" name="NAME"><br>
  <label>Koszt: </label>
  <input type="number" name="COST"><br><br>
  <input type="submit" value="Dodaj">
</form> 


<h2>Usuwanie części:</h2>
<form action="wishlist_remove.php" method="post">
    Podaj id usługi do usunięcia: <input type="number" name="id" required>
    <input type="submit" value="Usuń rekord"><br><br>
</form>


<h2>Wyszukiwanie:</h2>
<form action="wishlist_search.php" method="post">
    Podaj część nazwy do wyszukania (wielkość litery ma znaczenie): <input type="text" name="name" required>
    <input type="submit" value="Wyszukaj"><br><br>
</form>


<form action="lista_widok.php" method="post">
    <input type="submit" value="Powrót do widoku listy"><br><br>
</form>

<h2>Lista części:</h2>

</body>
</html>
