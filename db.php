<?php

function PolaczZOracle()
{
	$dbstr ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)
	(HOST=dbserver.mif.pg.gda.pl)(PORT = 1521))
	(CONNECT_DATA = (SERVER=DEDICATED)
	(SERVICE_NAME = ORACLEMIF)
	))"; 

	$charenc = 'AL32UTF8';
	$conn = oci_connect('WALADAW_P','p4C9G',$dbstr, $charenc);

	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	$setup1 = "ALTER SESSION SET NLS_NUMERIC_CHARACTERS='.,'";
	oci_execute(oci_parse($conn,$setup1));
	return $conn;
}
?>