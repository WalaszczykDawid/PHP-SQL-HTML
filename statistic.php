<!DOCTYPE html>
<html>
<body>
<h1>Statystyki</h1>
<head>

<?php
include_once("db.php");
session_start(); 

if (isset($_SESSION['id']))
{
	$query = "SELECT SUM(COST) FROM exploations";
				
	$c = PolaczZoracle();
		
	$stm = oci_parse($c, $query);
			
	if (oci_execute($stm)){
					
		while ($row = oci_fetch_row($stm))
		{			
			echo "Całkowita suma przeznaczona na eksploatację:";
			echo "<tr>
			      <td>{$row[0]}</td>
				  </tr><br><br>";
		}
	}
	
	
	$query = "SELECT SUM(COST) FROM element_change
      ";
	$stm = oci_parse($c, $query);
		
	if (oci_execute($stm)){		
		while ($row = oci_fetch_row($stm))
		{			
			echo "Całkowita suma przeznaczona na wymianę części motocykla:";
			echo "<tr>
			      <td>{$row[0]}</td>
				  </tr><br><br>";
		}
	}
		
		
	$query = "SELECT SUM(COST) FROM services_add
        ";
		
	$stm = oci_parse($c, $query);
			
	if (oci_execute($stm)){
				
		while ($row = oci_fetch_row($stm))
		{			
			echo "Całkowita suma przeznaczona na usługi:";
			echo "<tr>
			      <td>{$row[0]}</td>
				  </tr><br><br>";
		}
	}
		
		
	$query = "SELECT SUM(COST) FROM wish_list
        ";
		
	$stm = oci_parse($c, $query);
		
	if (oci_execute($stm)){
				
		while ($row = oci_fetch_row($stm))
		{			
			echo "Całkowita kwota produktów z listy życzeń:";
			echo "<tr>
			      <td>{$row[0]}</td>
				  </tr><br><br>";
		}
	}


	$query = "select * from ( select * from element_change order by cost desc ) where rownum <=1";
		
	$stm = oci_parse($c, $query);
			
	if (oci_execute($stm)){
				
		while ($row = oci_fetch_row($stm))
		{			
			echo "Najdroższy produkt wymieniony:";
			echo "<tr>
			      <td>wymieniono {$row[1]},</td>
				  <td> na {$row[2]},</td>
				  <td> za {$row[4]} PLN.</td>
				  </tr><br><br>";
		}
	}


	$query = "select * from ( select * from exploations order by cost desc ) where rownum <=1";
		
	$stm = oci_parse($c, $query);
			
	if (oci_execute($stm)){
				
		while ($row = oci_fetch_row($stm))
		{			
			echo "Najdroższy element eksploatacyjny:";
			echo "<tr>
			      <td>wymieniono {$row[1]},</td>
				  <td> podczas {$row[2]},</td>
				  <td> za {$row[5]} PLN.</td>
				  </tr><br><br>";
		}
	}


	$query = "select * from ( select * from SERVICES_ADD order by cost desc ) where rownum <=1";
		
	$stm = oci_parse($c, $query);
		
	if (oci_execute($stm)){
				
		while ($row = oci_fetch_row($stm))
		{			
			echo "Najdroższy usługa:";
			echo "<tr>
			      <td>Wykonano {$row[1]},</td>
				  <td> za {$row[3]} PLN.</td>
				  </tr><br><br>";
		}
	}		
		
		
	$query = "select * from ( select * from wish_list order by cost desc ) where rownum <=1";
		
	$stm = oci_parse($c, $query);
			
	if (oci_execute($stm)){
				
		while ($row = oci_fetch_row($stm))
		{			
			echo "Najdroższy prezent dla siebie:";
			echo "<tr>
			      <td>{$row[1]},</td>
				  <td> za {$row[2]} PLN.</td>
				  </tr><br><br>";
		}
	}	
}
?>


<form action="lista_widok.php" method="post">
    <input type="submit" value="Powrót do widoku listy"><br><br>
</body>
</form>
</html>
