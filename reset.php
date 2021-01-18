<html>
   <head>
      <title>Passwort Vergessen</title>
		
		<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #98ceda;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #98ceda; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #98ceda, #98ceda);
  background: -moz-linear-gradient(right, #98ceda, #98ceda);
  background: -o-linear-gradient(right, #98ceda, #98ceda);
  background: linear-gradient(to left, #98ceda, #98ceda);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}

</style>

   </head>
   	<body class="cbp-spmenu-push">
   <br><br>
   
	<?php 		
	  require_once ('config.php');
	  
	  		$db_link = mysqli_connect (
            MYSQL_HOST, 
            MYSQL_BENUTZER, 
            MYSQL_KENNWORT, 
            MYSQL_DATENBANK
            );
            
            if(! $db_link ) {
               die('Could not connect: ' . mysql_error());
            }
	//Passwort zurück setzten anfordern
         if(isset($_POST['add'])) {
            
				$user = $_POST['user'];
				$token = bin2hex(random_bytes(16));
				$expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

			   
            $sql1 = "UPDATE login
					SET token ='$token', timestamp ='$expires'
					WHERE user ='$user'";
             
	//email mit zurücksetzten link zuschicken
				$to = 'mail@chrischulte.de';
				$subject = "Passwort zurücksetzten!";
				$message = "Bitte ein neues Passwort über folgenden Link setzten: \n\n\n\n https://essen.chrischulte.de/reset.php?token=$token ";
				$from = "From: Essen <essen@chrischulte.de>";
				mail($to,$subject,$message,$from);

			   
			   
			if (mysqli_query($db_link, $sql1)) {
				echo "<center>Passwort für $user wurde zurückgesetzt! <br>";
				echo "<a href='https://essen.chrischulte.de/'><font color='#000'>◀ zurück</a></center>";exit;
			} else {
				echo "Error: " . $sql1 . "<br>" . mysqli_error($db_link);
			}
           
            mysqli_close($db_link);
			
	// Passwort verschlüsseln und setzten
         }if(isset($_POST['setpw'])) {
			$myDate = date("Y-m-d H:i:s");
            $token = $_POST['token'];
            $pass = $_POST['pass'];
	
	//abfrage ob Zeitstempel nicht zu alt
			$sql = "SELECT *
			FROM 
			login
			WHERE token = '$token'
			";
			
			$db_erg = mysqli_query( $db_link, $sql );
			if ( ! $db_erg )
			{
				die('Ungueltige Abfrage: ' . mysqli_error());
			}
			
			while ($zeile = mysqli_fetch_array( $db_erg ))
			{
				$expires = $zeile['timestamp'];
			}
			
			if(strtotime($expires) > strtotime($myDate)){ 
			
			$result = mysqli_query ($db_link, $sql); 
			function saltPassword($pass, $salt)
			{
				return hash('sha512', $pass . $salt);
			}

			// Erzeugung von Passwort-Hash mit Salt und in datenbank setzten und token löschen
			$salt   = "quSjqUQuyBWxcU1IybBquUQU1IWxcxUQU1IWxcxXhnybBnyBxnyBWxcU1IybBquUQU1IWxcxUQU1I";
			$saltedHash    = saltPassword($pass, $salt);
			$expires = date("Y-m-d H:i:s", strtotime('-1 hour'));   
			
            $sql1 = "UPDATE login SET pass = '$saltedHash', timestamp ='$expires'
					WHERE token = '$token'";
               
			if (mysqli_query($db_link, $sql1)) {
				echo "<center>Neues Passwort wurde gesetzt! <br>";
				echo "<a href='https://essen.chrischulte.de/'><font color='#000'>◀ zurück</a></center>";
			} else {
				echo "Error: " . $sql1 . "<br>" . mysqli_error($db_link);
			}
			
			}else{
			echo "<center>Token ist ungültig, bitte neuen zuschicken lassen!<br></center>";
			}
			
			
           
            mysqli_close($db_link);
         }else if(isset($_GET['token'])){
			 
			$token = $_GET['token'];
			 
			$sql = "SELECT *
			FROM 
			login
			WHERE token = '$token'
			";
			
			$result = mysqli_query ($db_link, $sql);  

        if (mysqli_num_rows ($result) > 0)  
            {  ?>
        <form class="form-container" method = "POST" action = "<?php $_PHP_SELF ?>">
			    <div class="form-title"><h2>Neues Password vergeben</h2></div>
				
					<div class="form-title"></div>
					<input class="form-field" type="password" name="pass" id = "pass"/><br />
					<input type="hidden" name="token" id = "token" value="<?php echo $token; ?>" />
					<div class="submit-container">
					<input  name = "setpw" class="submit-button" type="submit" id = "add" value="Passwort setzten" />
					</div>
					</form>
		<?php
		}  
        else  
        {  
          echo "<center>Token nicht mehr gültig!</center>";
        }  

			
         }else {
			 //Passwort Anfordern
            ?>
				
<div class="login-page">
  <div class="form">
    <form class="login-form" method = "POST" action = "<?php $_PHP_SELF ?>">
      <input type="text" name="user" placeholder="username"/>
      <button type="submit" name="add" class="submit-button" id = "add">Passwort zurücksetzten</button>
      
    </form>
  </div>
</div>				
						
            <!--   <form class="form-container" method = "POST" action = "<?php $_PHP_SELF ?>">
			    <div class="form-title"><h2>Passwort Vergessen</h2></div>
				
					<div class="form-title">Username</div>
					<input class="form-field" type="text" name="user" id = "user"/><br />
					
					<div class="submit-container">
					<input  name = "add" class="submit-button" type="submit" id = "add" value="Passwort zurücksetzten" />
					</div>
					</form>-->
                                 
                     
            
            <?php
         }
	
      ?>

	  	<!-- Menu Button -->
		<?php include  ("menu.php"); ?>

   </body>
</html>