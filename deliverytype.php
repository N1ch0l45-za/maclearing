<?php
	if (!isset($_SESSION)) 
	{
		session_start();
	}
	require_once('maclass.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- created By: Nicholas Thomson -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Login Screen</title>
		<meta name="description=" content="">
		<meta http-equiv="Content-Language" content="en-za">
		<LINK REL=StyleSheet HREF="macss.css" TYPE="text/css">		
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	</head>
	<body>
		<div id='container'>
			<div id='Banner'>
				<?PHP
					$user = new userclass();
					$super = new supervisorclass();
					
					$currentuser = $_SESSION['user'];
					
					$currentuser = $_SESSION['user'];
					$Nuser = $user->nusercheck($currentuser);
					$Suser = $super->susercheck($currentuser);	
					
					if($Suser == true)
					{
						$name = $super->susername($currentuser);
						echo("<h1>". $name ."</h1>");
					}
					else if($Nuser == true)
					{
						$name = $user->nusername($currentuser);
						echo("<h1>". $name ."<h1>");
					}
				?>
			</div>
			<div id='content'>
				<div id="nav">
					<?php
						if($Suser == true)
						{
							echo("<ul>
									<li><a>Users</a>
										<ul>
											<li><a href='./super.php'>Supervisor</a></li>
											<li><a href='./user.php'>Users</a></li>
										</ul>
									</li>
									<li><a>Setup info</a>
										<ul>
											<li><a href='./type.php'>Type</a></li>
											<li><a href='#'>Delivery Type</a></li>
											<li><a href='./delivery.php'>Delivery</a></li>
											<li><a href='./company.php'>Companies</a></li>
										</ul>							
											<li><a href='./waybill.php'>Waybill</a></li>
											<li><a href='./pallet.php'>Pallet</a></li>
											
											<li><a href='./reports.php'>Reports</a></li>	
									<li><a href='./logout.php'>logout</a></li>
							</ul>");
						}
						else if($Nuser == true)
						{
							echo("<ul>
									<li><a href='./user.php'>Users</a></li>				
									<li><a href='./company.php'>Companies</a></li>								
									<li><a href='./waybill.php'>Waybill</a></li>
									<li><a href='./pallet.php'>Pallet</a></li>
									
									<li><a href='./reports.php'>Reports</a></li>									
									<li><a href='./logout.php'>logout</a></li>
							</ul>");
						}
						else if($username == NULL)
						{
							 echo ('<META HTTP-EQUIV="Refresh" Content="0; URL=logout.php">');
							exit();
						}
					?>
				</div>
				<div id='clear'></div>
				<?php					
					$delt = new deliverytclass();
					
					$id = $_GET['id'];
					
					if($id == Null)
					{
						$delt->createdelttable();
					}
					else
					{
						$delt->editdelttable($id);
					}
					$delt->Listdeliveryts();
				?>
				</div>
		</div>		
	</body>
</html>