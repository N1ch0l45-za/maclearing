<?php
	require_once('maclass.php');	
	
	if (!isset($_SESSION)) 
	{
		session_start();
	}
	else
	{
		session_destroy();
		session_start();
	}
	
	$_SESSION['username'] = 'none';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- created By: Nicholas Thomson -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Login Screen</title>
		<meta name="description=" content="">
		<meta http-equiv="Content-Language" content="en-za">
		<LINK REL=StyleSheet HREF="malogincss.css" TYPE="text/css">		
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#p1").hover(function()
				{
					$('input[name="Passwordtxt"]').attr('type', 'text');
				},
				function()
				{
					$('input[name="Passwordtxt"]').attr('type', 'password');
				});
			});
		</script> 
	</head>
	<body>
		<div id="Login">
			<form method="POST" action='./mafunctions.php'>
				<h1>Login</h1>
				<table width='85%' align='center'>
					<tr>
						<td>Username :</td>
						<td colspan='2'><input type='text' name="Usernametxt"></td>
					</tr>
					<tr>
						<td>Password :</td>
						<td colspan='2'><input id='password_input' type='password' name="Passwordtxt"></td>
						<td><img id='p1' src='./images/registration_registration2-512.png' height='25px'></img></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td><input type='reset' value='Reset'></td>
						<td><input type='submit'value='Login'></td>
					</tr>
				</table>
			</form>
			<?PHP
				$login = $_GET['f'];
				
				if($login != Null)
				{
					echo('login failed');
				}
			?>
		</div>
	</body>
</html>