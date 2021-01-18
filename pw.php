<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
session_start();

require_once ('config.php');
/************************************************
	MySQL Connect
************************************************/

 	$db_link = mysqli_connect (
                     MYSQL_HOST, 
                     MYSQL_BENUTZER, 
                     MYSQL_KENNWORT, 
                     MYSQL_DATENBANK
                    );
					
if(isset($_POST['login']))
{
$username = $_POST['usr'];
$pass = $_POST['pswd'];

	$sql = "SELECT *
			FROM 
			login
			WHERE user = '$username'
			";

			function saltPassword($pass, $salt)
			{
				return hash('sha512', $pass . $salt);
			}

			// Erzeugung von Passwort-Hash mit Salt
			$salt   = ""; //saltcode einfügen
			$saltedHash    = saltPassword($pass, $salt);
			  
			
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		die('Ungueltige Abfrage: ' . mysqli_error());
	}
	while ($zeile = mysqli_fetch_array( $db_erg ))
	{
	 $usr = $zeile['user'];
	 $pswd = $zeile['pass'];
	 $rol = $zeile['rolle'];
	}
if ($username == "$usr" and $saltedHash == "$pswd" and $rol == "admin" ) { //Admin Login
    $_SESSION['admin'] = true;
    header('Location: https://essen.website.de/'); //Nach erfolgreichen Login, weiterleiten auf Seite XY
    exit;
} else {

if ($username == "$usr" and $saltedHash == "$pswd" and $rol == "sup") { //Supervisor Login
    $_SESSION['sup'] = true;
    header('Location: https://essen.website.de/'); //Nach erfolgreichen Login, weiterleiten auf Seite XY
    exit;
} else {

?>
<script type="text/javascript">
<!--
alert('Zugangsdaten Falsch')
//-->
</script>
<?php
echo $usr = $zeile['user'];
}
}
}
}

?>

<html>
<head>
		
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
  background: #4CAF50;
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

<body>

<div class="login-page">
  <div class="form">
    <form class="login-form"  method="post" action="">
      <input type="text" name="usr" placeholder="username"/>
      <input type="password" name="pswd" placeholder="password"/>
      <button type="submit" name="login" class="submit-button">login</button>
      <p class="message">Passwort vergessen? <a href="reset.php">Reset</a></p>
    </form>
  </div>
</div>
</body>
</html>
