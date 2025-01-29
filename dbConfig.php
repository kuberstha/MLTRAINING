<?php 
// SQL server configuration 
$serverName = "10.192.1.51"; 
$dbUsername = "sa"; 
$dbPassword = "dec@2020"; 
$dbName     = "t1"; 
 
// Create database connection 
try {   
   $conn = new PDO( "sqlsrv:Server=$serverName;Database=$dbName", $dbUsername, $dbPassword);    
   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );   
}   
   
catch( PDOException $e ) {   
   die( "Error connecting to SQL Server: ".$e->getMessage() );    
} 