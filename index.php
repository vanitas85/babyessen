<!DOCTYPE HTML>
<?php
session_start();
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Essen</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="bookmark" href="favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
	<meta name="theme-color" content="#ffffff">
    <!-- site css -->
    <link rel="stylesheet" href="css/site.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="js/site.min.js"></script>
    
        <style>
      
        #chart {
      max-width: 100%;
      margin: 0px auto;
      color: black;
    }
      
    </style>
    
    <script src="dist/apexcharts"></script>
  </head>
  <body style="background-color: #f1f2f6;">
  
       <?php
	  require_once ('config.php');
	  
         if(isset($_POST['add'])) {
            
			$db_link = mysqli_connect (
            MYSQL_HOST, 
            MYSQL_BENUTZER, 
            MYSQL_KENNWORT, 
            MYSQL_DATENBANK
            );
            
            if(! $db_link ) {
               die('Could not connect: ' . mysql_error());
            }
               $timestamp = $_POST['timestamp'];
               $datum = $_POST['datum'];
               $uhrzeit = $_POST['uhrzeit'];
			   $milch = $_POST['milch'];
			   $brei = $_POST['brei'];
			   $tablette = $_POST['tablette'];
			   $zpm = $_POST['zpm'];
			   $zpa = $_POST['zpa'];
			   $wk = $_POST['wk'];
			   $wg = $_POST['wg'];
			   
            $sql1 = "INSERT INTO essen(datum, uhrzeit, milch, brei, tablette, zpm, zpa, wk, wg, timestamp) 
					VALUES('$datum','$uhrzeit','$milch','$brei','$tablette','$zpm','$zpa','$wk','$wg', '$timestamp')";
               
			if (mysqli_query($db_link, $sql1)) {
			if( $milch >= '10' && $brei >= '1' && $wg >= '1') {
			curl_setopt_array($ch = curl_init(), array(
		    CURLOPT_URL => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS => array(
			    "token" => "",
			    "user" => "",
			    "message" => "🍼 $milch ml / $brei 🥣  / $wg 💩 ",
				  ),
			CURLOPT_SAFE_UPLOAD => true,
  			CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);	
			} elseif( $milch >= '10' && $brei >= '1') {
			curl_setopt_array($ch = curl_init(), array(
		    CURLOPT_URL => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS => array(
			    "token" => "",
			    "user" => "",
			    "message" => "🍼 $milch ml / $brei 🥣 ",
				  ),
			CURLOPT_SAFE_UPLOAD => true,
  			CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			} elseif( $milch >= '10' && $tablette >= '1') {
			curl_setopt_array($ch = curl_init(), array(
		    CURLOPT_URL => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS => array(
			    "token" => "",
			    "user" => "",
			    "message" => "🍼 $milch ml / $tablette 💊 ",
				  ),
			CURLOPT_SAFE_UPLOAD => true,
  			CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);		
			} elseif( $milch >= '10') {
			curl_setopt_array($ch = curl_init(), array(
		    CURLOPT_URL => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS => array(
			    "token" => "",
			    "user" => "",
			    "message" => "🍼 $milch ml",
				  ),
			CURLOPT_SAFE_UPLOAD => true,
  			CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			} elseif( $brei >= '1') {
			curl_setopt_array($ch = curl_init(), array(
		    CURLOPT_URL => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS => array(
			    "token" => "",
			    "user" => "",
			    "message" => "$brei 🥣 ",
				  ),
			CURLOPT_SAFE_UPLOAD => true,
  			CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			} elseif( $wg >= '1') {
			curl_setopt_array($ch = curl_init(), array(
		    CURLOPT_URL => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS => array(
			    "token" => "",
			    "user" => "",
			    "message" => "$wg 💩 ",
				  ),
			CURLOPT_SAFE_UPLOAD => true,
  			CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			} else { }
			?>
			
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <center><strong>Eintrag hinzugefügt!</strong> </center>
            </div>
            <?php  goto header;
			} else {
				echo "Error: " . $sql1 . "<br>" . mysqli_error($db_link);
			}
           
            mysqli_close($db_link);
         }
          header: ?>
    <div class="docs-header">
    <?php if (isset($_SESSION['admin'])) { ?> 
      <!--nav-->
      <nav class="navbar navbar-default navbar-custom" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><img src="img/flasche.png" height="40"></a>
            
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!--header-->     
      <div class="topic" style="padding-bottom: 40px; padding-top: 10px;">
        <div class="container">
        <div id="chart"></div>
			<div class="col-md-8">
			
				<?php
					$timestamp = time();
					$tag1 = date("d.m.Y", $timestamp);
					$tag2 = date("d.m.Y", time()-86400);
					$tag3 = date("d.m.Y", time()-172800);
					$tag4 = date("d.m.Y", time()-259200);
					$tag5 = date("d.m.Y", time()-345600);
					$tag6 = date("d.m.Y", time()-432000);
					$uhrzeit = date("H:i:s", $timestamp);
					
					$wt = date('N', $timestamp);
if ( $wt == '7'){
$wtag1 = 'So';
$wtag2 = 'Sa';
$wtag3 = 'Fr';
$wtag4 = 'Do';
$wtag5 = 'Mi';
$wtag6 = 'Di';
$wtag7 = 'Mo';
} elseif ( $wt == '6') {
$wtag7 = 'So';
$wtag1 = 'Sa';
$wtag2 = 'Fr';
$wtag3 = 'Do';
$wtag4 = 'Mi';
$wtag5 = 'Di';
$wtag6 = 'Mo';
} elseif ( $wt == '5') {
$wtag6 = 'So';
$wtag7 = 'Sa';
$wtag1 = 'Fr';
$wtag2 = 'Do';
$wtag3 = 'Mi';
$wtag4 = 'Di';
$wtag5 = 'Mo';
} elseif ( $wt == '4') {
$wtag5 = 'So';
$wtag6 = 'Sa';
$wtag7 = 'Fr';
$wtag1 = 'Do';
$wtag2 = 'Mi';
$wtag3 = 'Di';
$wtag4 = 'Mo';
} elseif ( $wt == '3') {
$wtag4 = 'So';
$wtag5 = 'Sa';
$wtag6 = 'Fr';
$wtag7 = 'Do';
$wtag1 = 'Mi';
$wtag2 = 'Di';
$wtag3 = 'Mo';
} elseif ( $wt == '2') {
$wtag3 = 'So';
$wtag4 = 'Sa';
$wtag5 = 'Fr';
$wtag6 = 'Do';
$wtag7 = 'Mi';
$wtag1 = 'Di';
$wtag2 = 'Mo';
} elseif ( $wt == '1') {
$wtag2 = 'So';
$wtag3 = 'Sa';
$wtag4 = 'Fr';
$wtag5 = 'Do';
$wtag6 = 'Mi';
$wtag7 = 'Di';
$wtag1 = 'Mo';
}
echo $tag;
					
								$db_link = mysqli_connect (
            MYSQL_HOST, 
            MYSQL_BENUTZER, 
            MYSQL_KENNWORT, 
            MYSQL_DATENBANK
            );


$sql6 = mysqli_query($db_link, "SELECT SUM(milch) AS 'milchsumme', SUM(wg) AS 'wgsumme' FROM essen WHERE datum = '$tag6'"); 
$data6 = mysqli_fetch_object($sql6); 
$stat6 = ''.$data6->milchsumme.'+'.$data6->wgsumme.''; 

$sql5 = mysqli_query($db_link, "SELECT SUM(milch) AS 'milchsumme', SUM(wg) AS 'wgsumme' FROM essen WHERE datum = '$tag5'"); 
$data5 = mysqli_fetch_object($sql5); 
$stat5 = ''.$data5->milchsumme.'+'.$data5->wgsumme.''; 

$sql4 = mysqli_query($db_link, "SELECT SUM(milch) AS 'milchsumme', SUM(wg) AS 'wgsumme' FROM essen WHERE datum = '$tag4'"); 
$data4 = mysqli_fetch_object($sql4); 
$stat4 = ''.$data4->milchsumme.'+'.$data4->wgsumme.''; 

$sql3 = mysqli_query($db_link, "SELECT SUM(milch) AS 'milchsumme', SUM(wg) AS 'wgsumme' FROM essen WHERE datum = '$tag3'"); 
$data3 = mysqli_fetch_object($sql3); 
$stat3 =  ''.$data3->milchsumme.'+'.$data3->wgsumme.''; 

$sql2 = mysqli_query($db_link, "SELECT SUM(milch) AS 'milchsumme', SUM(wg) AS 'wgsumme' FROM essen WHERE datum = '$tag2'"); 
$data2 = mysqli_fetch_object($sql2); 
$stat2 = ''.$data2->milchsumme.'+'.$data2->wgsumme.''; 

$sql = mysqli_query($db_link, "SELECT SUM(milch) AS 'milchsumme', SUM(wg) AS 'wgsumme' FROM essen WHERE datum = '$tag1'"); 
$data = mysqli_fetch_object($sql); 
$stat1 = ''.$data->milchsumme.'+'.$data->wgsumme.''; 

				?>	

    <script>
      
        var options = {
          series: [{
            name: "Milch",
            data: [ <?php echo $stat6; ?>, <?php echo $stat5; ?>, <?php echo $stat4; ?> ,<?php echo $stat3; ?>, <?php echo $stat2; ?>, <?php echo $stat1; ?>]
        }],
          chart: {
          height: 250,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: true
        },
        stroke: {
          curve: 'straight'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['<?php echo $wtag6; ?>', '<?php echo $wtag5; ?>', '<?php echo $wtag4; ?>' ,'<?php echo $wtag3; ?>', '<?php echo $wtag2; ?>', '<?php echo $wtag1; ?>'],
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
    </script>
			</div>
			<div class="col-md-4">

          </div>
        </div>
        <div class="topic__infos">
          <div class="container">
				<?php
					$timestamp = time();
					$datum = date("d.m.Y", $timestamp);
					$gestern = date("d.m.Y", time()-86400);
					$vorgestern = date("d.m.Y", time()-172800);
					$uhrzeit = date("H:i:s", $timestamp);
					
								$db_link = mysqli_connect (
            MYSQL_HOST, 
            MYSQL_BENUTZER, 
            MYSQL_KENNWORT, 
            MYSQL_DATENBANK
            );

$sql2 = mysqli_query($db_link, "SELECT SUM(milch)  AS 'milchsumme' FROM essen WHERE datum = '$vorgestern'"); 
$data3 = mysqli_fetch_object($sql2); 
echo ' <a href="?stat&datum=' .$vorgestern. '" style="text-decoration: none"><font color="#fff">Vorgestern: '.$data3->milchsumme.'ml</font></a>';

$sql2 = mysqli_query($db_link, "SELECT SUM(milch)  AS 'milchsumme' FROM essen WHERE datum = '$gestern'"); 
$data2 = mysqli_fetch_object($sql2); 
echo ' <a href="?stat&datum=' .$gestern. '" style="text-decoration: none"> <font color="#999">- Gestern: '.$data2->milchsumme.'ml</font></a>'; 

$sql = mysqli_query($db_link, "SELECT SUM(milch)  AS 'milchsumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 


echo ' <a href="?stat&datum=' .$datum. '" style="text-decoration: none" ><font color="#000">- Heute: '.$data->milchsumme. 'ml </font></a>'; 

				?>			
          </div>
        </div>
      </div>
    </div>
 <?PHP       
      	  if(isset($_GET['stat']))
{
goto uebersicht;


}
?>       
    
    <!--documents-->
    <div class="container documents">
<form class="form-container" method = "POST" action = "<?php $_PHP_SELF ?>">
  <div class="form-group">
    <select class="form-control" name="milch" id = "milch">  
 				    <option value="0" selected>0ml</option> 
					<option value="10" >10ml</option>
					<option value="20" >20ml</option>
					<option value="30" >30ml</option>
					<option value="40" >40ml</option>
					<option value="50" >50ml</option>
					<option value="60" >60ml</option>
					<option value="70" >70ml</option>
					<option value="80" >80ml</option>    
					<option value="90" >90ml</option>    
	    			<option value="100" >100ml</option>
 				   	<option value="110" >110ml</option>
					<option value="120" >120ml</option>
					<option value="130" >130ml</option>
			   	    <option value="140" >140ml</option>
			   	    <option value="150" >150ml</option>
					<option value="160" >160ml</option>
					<option value="170" >170ml</option>
    				<option value="180" >180ml</option>
					<option value="190" >190ml</option>
					<option value="200" >200ml</option>
					<option value="210" >210ml</option>
					<option value="220" >220ml</option>
					<option value="230" >230ml</option>
					<option value="240" >240ml</option>
					<option value="250" >250ml</option>
					<option value="260" >260ml</option>
					<option value="270" >270ml</option>
					<option value="280" >280ml</option>
					<option value="290" >290ml</option>
					<option value="300" >300ml</option>
					
    </select>
  </div>

  
	  <!--Toggle
      ================================================== -->

<div class="row">

          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light"  style="background-color:#5D9CEC"><center><font size="6">🥣</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
					<input type="hidden" name="brei" value="0">
 					 <input type="checkbox" id="brei" name="brei" value="1">
			  			<span class="handle"></span>	
					</label></center>   
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php 
$sql = mysqli_query($db_link, "SELECT SUM(tablette)  AS 'tablettesumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 
if(''.$data->tablettesumme.'' >= '1') {
?>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#4FC1E9"><center><font size="6">💊</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
			 		 <input type="hidden" name="tablette" value="0">
  					 <input type="checkbox" id="tablette" name="tablette" value="1" disabled>
			  			<span class="handle"></span>	
					</label></center>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php } else { ?>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#4FC1E9"><center><font size="6">💊</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
			 		 <input type="hidden" name="tablette" value="0">
  					 <input type="checkbox" id="tablette" name="tablette" value="1">
			  			<span class="handle"></span>	
					</label></center>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
}							
$sql = mysqli_query($db_link, "SELECT SUM(zpm)  AS 'zpmsumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 
if(''.$data->zpmsumme.'' >= '1') {
?>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#48CFAD"><center><font size="6">🦷☀️</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
  					<input type="hidden" name="zpm" value="0">
 					 <input type="checkbox" id="zpm" name="zpm" value="1" disabled>
			  			<span class="handle"></span>	
					</label></center>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php } else { ?>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#48CFAD"><center><font size="6">🦷☀️</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
  					<input type="hidden" name="zpm" value="0">
 					 <input type="checkbox" id="zpm" name="zpm" value="1">
			  			<span class="handle"></span>	
					</label></center>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
}
$sql = mysqli_query($db_link, "SELECT SUM(zpa)  AS 'zpasumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 
if(''.$data->zpasumme.'' >= '1') {
?>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#A0D468"><center><font size="6">🦷🌙</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
  					<input type="hidden" name="zpa" value="0">
  					 <input type="checkbox" id="zpa" name="zpa" value="1" disabled>
			  			<span class="handle"></span>	
					</label></center>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php } else { ?>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#A0D468"><center><font size="6">🦷🌙</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
  					<input type="hidden" name="zpa" value="0">
  					 <input type="checkbox" id="zpa" name="zpa" value="1">
			  			<span class="handle"></span>	
					</label></center>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
}
?>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#FFCE54"><center><font size="6">💧</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
  					<input type="hidden" name="wk" value="0">
 					 <input type="checkbox" id="wk" name="wk" value="1">
			  			<span class="handle"></span>	
					</label></center>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php 
$sql = mysqli_query($db_link, "SELECT SUM(wg)  AS 'wgsumme' FROM essen WHERE datum = '$datum'"); 
$data = mysqli_fetch_object($sql); 
if(''.$data->wgsumme.'' >= '1') {
?>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#FC6E51"><center><font size="6">💩</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
  					<input type="hidden" name="wg" value="0">
  					 <input type="checkbox" id="wg" name="wg" value="1" Disabled>
			  			<span class="handle"></span>	
					</label></center>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php } else { ?>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#FC6E51"><center><font size="6">💩</font></div>
                  <div class="pull-right dark">
                  	<center><label class="toggle"></span>
  					<input type="hidden" name="wg" value="0">
  					 <input type="checkbox" id="wg" name="wg" value="1">
			  			<span class="handle"></span>	
					</label></center>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php
}
?>

      <!-- Buttons
      ================================================== -->


       					<input class="form-field" type="hidden" name="timestamp" id = "timestamp" value="<?php echo $datum; ?> - <?php echo $uhrzeit; ?> "/><br />
       					<input class="form-field" type="hidden" name="uhrzeit" id = "uhrzeit" value="<?php echo $uhrzeit; ?> "/><br />
					<input class="form-field" type="hidden" name="datum" id = "datum" value="<?php echo $datum; ?> "/><br />
        
        <div class="submit-container">
        					<input  name = "add" class="btn btn-success btn-block" type="submit" id = "add" value="speichern" />
		</div>
        </form>


	 <br><br>

      <!-- Übersicht
      ================================================== -->	 
	  <?php goto end;
	 
	uebersicht:
	
	$datum = $_GET['datum'];
	 ?>
	  
	
	  <br>
	              <div class="panel panel-default">
              <div class="panel-heading"><center><b>- <?php echo $datum; ?> -</b></center></div>
              <table class="table">
                <thead>
                  <tr>
                    <th></th>
                    <th>Uhrzeit</th>
                    <th>Essen</th>
                  </tr>
                </thead>
                <tbody>
<?php 

	$sql = "SELECT *
			FROM 
			essen
			WHERE datum = '$datum'
			AND milch != '0'
			ORDER BY datum ASC
			";
 
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		die('Ungueltige Abfrage: ' . mysqli_error());
	}
	while ($zeile = mysqli_fetch_array( $db_erg ))
	{
		
		echo "<tr>";
		echo "<td></td>";
		echo "<td>". $zeile['uhrzeit'] . "</td>";
		echo "<td>". $zeile['milch'] . "</td>";
		echo "</tr>";

	}
mysqli_free_result( $db_erg );
	  
	  	echo "</tbody>";
		echo "</table>";
		echo "</div>";
	
?>
	       
<?php 

	$sql2 = "SELECT *
			FROM 
			essen
			WHERE datum = '$datum'
			AND brei != '0'
			ORDER BY datum ASC
			";
 ?>
 

        <div class="panel panel-default">
              <div class="panel-heading"><center><b>- 🥣 -</b></center></div>
              <table class="table">
                <tbody>
 
 <?php
	$db_erg = mysqli_query( $db_link, $sql2 );
	if ( ! $db_erg )
	{
		die('Ungueltige Abfrage: ' . mysqli_error());
	}
	while ($zeile = mysqli_fetch_array( $db_erg ))
	{
		
		echo "<tr>";
		echo "<td></td>";
		echo "<td>". $zeile['uhrzeit'] . "</td>";
		echo "<td>🥣 </td>";
		echo "</tr>";

	}
mysqli_free_result( $db_erg );
	  
	  	echo "</tbody>";
		echo "</table>";
		echo "</div>";
		
		
		?>
	              <div class="panel panel-default">
              <div class="panel-heading"><center><b>- 💧 /💩 -</b></center></div>
              <table class="table">
                <tbody>
<?php 

	$sql2 = "SELECT *
			FROM 
			essen
			WHERE datum = '$datum'
			AND wg != '0'
			ORDER BY datum ASC
			";
 
	$db_erg = mysqli_query( $db_link, $sql2 );
	if ( ! $db_erg )
	{
		die('Ungueltige Abfrage: ' . mysqli_error());
	}
	while ($zeile = mysqli_fetch_array( $db_erg ))
	{
		
		echo "<tr>";
		echo "<td></td>";
		echo "<td>". $zeile['uhrzeit'] . "</td>";
		echo "<td>💩 </td>";
		echo "</tr>";

	}
mysqli_free_result( $db_erg );

	$sql3 = "SELECT *
			FROM 
			essen
			WHERE datum = '$datum'
			AND wk != '0'
			ORDER BY datum ASC
			";
 
	$db_erg = mysqli_query( $db_link, $sql3 );
	if ( ! $db_erg )
	{
		die('Ungueltige Abfrage: ' . mysqli_error());
	}
	while ($zeile = mysqli_fetch_array( $db_erg ))
	{
		
		echo "<tr>";
		echo "<td></td>";
		echo "<td>". $zeile['uhrzeit'] . "</td>";
		echo "<td>💧 </td>";
		echo "</tr>";

	}
mysqli_free_result( $db_erg );
	  
	  	echo "</tbody>";
		echo "</table>";
		echo "</div>";
	  
  } else { 
  	echo '<script>window.location="pw.php"</script>'; ?>
  
<?php } 
end:
?> 
  </body>
</html>
