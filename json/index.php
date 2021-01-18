<?php
header('Content-Type: application/json');
	  require_once ('config.php');
            
			$db_link = mysqli_connect (
            MYSQL_HOST, 
            MYSQL_BENUTZER, 
            MYSQL_KENNWORT, 
            MYSQL_DATENBANK
            );

		$timestamp = time();
		$datum = date("d.m.Y", $timestamp); 
		
$sql2 = "SELECT *
			FROM 
			essen
			WHERE datum = '$datum'
			AND milch > '0'
			ORDER BY id DESC LIMIT 1
			";
			
			
$db_erg = mysqli_query( $db_link, $sql2 );
	if ( ! $db_erg )
	{
		die('Ungueltige Abfrage: ' . mysqli_error());
	}
	while ($zeile = mysqli_fetch_array( $db_erg ))
	{

		$uhrzeit = "". $zeile['uhrzeit'] . "";

		echo substr($beispieltext, 0, 10)."";
		$uhr = substr($uhrzeit, 0, 5)."";
	}
mysqli_free_result( $db_erg );
	  			

$sql = mysqli_query($db_link, "SELECT SUM(milch) AS 'milchsumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 
$milch = ''.$data->milchsumme.''; 

$sql = mysqli_query($db_link, "SELECT SUM(tablette)  AS 'tablettesumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 
if(''.$data->tablettesumme.'' >= '1') {
$tablette = "🟩";
} else { 
$tablette = "⬜️";
}

$sql = mysqli_query($db_link, "SELECT SUM(wg)  AS 'wgsumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 
if(''.$data->wgsumme.'' >= '1') {
$wg = "🟩";
} else { 
$wg = "⬜️";
}


$sql = mysqli_query($db_link, "SELECT SUM(zpm)  AS 'zpmsumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 
if(''.$data->zpmsumme.'' >= '1') {
$zpm = "🟩";
} else { 
$zpm = "⬜️";
}


$sql = mysqli_query($db_link, "SELECT SUM(zpa)  AS 'zpasumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 
if(''.$data->zpasumme.'' >= '1') {
$zpa = "🟩";
} else { 
$zpa = "⬜";
}


echo '{"!name":"scriptable","TEST":{"!url":"https://essen.chrischulte.de","!uhr":"'. $uhr . ' Uhr","!milch":"'.$milch.'","!windel":"'.$wg.'","!zpm":"'.$zpm.'","!zpa":"'.$zpa.'","!tablette":"'.$tablette.'"}}';
	
?>