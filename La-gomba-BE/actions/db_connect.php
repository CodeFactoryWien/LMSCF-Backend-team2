<?php
// this will avoid mysql_connect() deprecation error.
error_reporting( ~E_DEPRECATED & ~E_NOTICE );

define ('DBHOST', '173.212.235.205');
define('DBUSER', 'schedler_Team2');
define('DBPASS', 'LaGomba12345+');
define ('DBNAME', 'schedler_lagomba');

$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);


if  ( !$conn ) {
 die("Connection failed : " . mysqli_error());
}

?>



