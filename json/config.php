<?php
// Credentials
$dbhost = "sql.local";
$dbname = "db194850016";
$dbuser = "db194850016";
$dbpass = "CRSrulez!";

//	Connection
global $tutorial_db;

$tutorial_db = new mysqli();
$tutorial_db->connect($dbhost, $dbuser, $dbpass, $dbname);
$tutorial_db->set_charset("utf8");

//	Check Connection
if ($tutorial_db->connect_errno) {
    printf("Connect failed: %s\n", $tutorial_db->connect_error);
    exit();
}

// Damit alle Fehler angezeigt werden
error_reporting(E_ALL);
 
// Zum Aufbau der Verbindung zur Datenbank
// die Daten erhalten Sie von Ihrem Provider
define ( 'MYSQL_HOST',      'sql.local' );
 
// bei XAMPP ist der MYSQL_Benutzer: root
define ( 'MYSQL_BENUTZER',  'db194850016' );
define ( 'MYSQL_KENNWORT',  'CRSrulez!' );
// für unser Bsp. nennen wir die DB adressverwaltung
define ( 'MYSQL_DATENBANK', 'db194850016' );

$db_link2 = new PDO('mysql:host=sql.local;dbname=db194850016', 'db194850016', 'CRSrulez!');			

?>