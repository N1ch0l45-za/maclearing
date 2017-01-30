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
											
											<li><a href='./#'>Reports</a></li>
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
									
									<li><a href='./#'>Reports</a></li>								
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
				<div>
					<a href = './reports.php?id=2'>Pallets to be collected</a><br>
					<a href = './reports.php?id=3'>Pallets on site</a><br>
					<a href = './reports.php?id=4'>Pallets Dispatched</a><br>
					<a href = './reports.php?id=5'>Waybill to be collected</a><br>
					<a href = './reports.php?id=6'>Waybill on site less than 3 months</a><br>
					<a href = './reports.php?id=7'>Waybill on site more than 3 months</a><br>
					<a href = './reports.php?id=8'>Waybill on site more than 6 months</a><br>
					<a href = './reports.php?id=9'>Waybill on site more than 1 year</a><br>
					<a href = './reports.php?id=10'>Waybill Dispatched</a><br></br>
				</div>
				<?php					
					$waybill = new waybillclass();
					$pallet = new palletclass();
					
					$id = $_GET['id'];
					$cidpg = $_GET['cid'];
					echo($cidpg);
					
					if($id == 1)
					{
						$waybill->wfcreport($cidpg);
					}
					if($id == 2)
					{
						$pallet->ptbcreport();
					}
					if($id == 3)
					{
						$pallet->osreport();
					}
					if($id == 4)
					{
						$pallet->pdreport();
					}
					if($id == 5)
					{
						$waybill->wtbcreport();
					}
					if($id == 6)
					{
						$waybill->wosnreport();
					}
					if($id == 7)
					{
						$waybill->wos3report();
					}
					if($id == 8)
					{
						$waybill->wos6report();
					}
					if($id == 9)
					{
						$waybill->wos1yreport();
					}
					if($id == 10)
					{
						$waybill->waydisyreport();
					}
				?>
				</div>
		</div>		
	</body>
</html>