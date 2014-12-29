<?php
session_start();
$user="root";
$password="";
$database="testdb";
mysql_connect(localhost,$user,$password);
@mysql_select_db($database) or die( "Unable to select database");
?>
<html>
<head>
</head>
<body>
<?php if(isset($_POST['username']) && isset($_POST['password']))
{
	$query = "SELECT * FROM users WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'";
	
	$result=mysql_query($query);
	
	$num=mysql_numrows($result);
	
	if($num > 0)
	{
		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = $_POST['username'];
	}
	else 
		echo 'Username and password combination is wrong.';
}
if(isset($_POST['logout']) && $_POST['logout'] == 1)
{

	$_SESSION['logged_in'] = false;
	$_SESSION['username'] = "";
}
?>
<h1><?php
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])
	echo 'Eingeloggt.';
else
	echo 'Nicht eingeloggt.';
?></h1>
<?php if(!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])): ?>
<form action="index.php" method="post">
<input type="text" name="username"></input>
<input type="password" name="password"></input>
<button type="submit">Absenden</button>
</form>
<?php else:?>
Willkommen <?php echo $_SESSION['username'];?>
<form action="index.php" method="post">
<input type="hidden" name="logout" value="1">
<button type="submit">Logout</button>
</form>
<?php endif;?>

</body>
</html>
<?php 
mysql_close();
?>
