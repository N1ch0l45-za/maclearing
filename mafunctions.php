<?php
	require_once('maclass.php');
	session_start();
	
	if($_SESSION['user'] == NULL)
	{
		$_SESSION['user'] = $_POST['Usernametxt'];
	}
	
	//get login details
	$username = $_POST['Usernametxt'];
	$pass = $_POST['Passwordtxt'];
	
	//create classes
	$user = new userclass();
	$super = new supervisorclass();
	$company = new companyclass();
	$type = new typeclass();
	$pallet = new palletclass();
	$item = new itemclass();
	$del = new deliveryclass();
	$delt = new deliverytclass();
	$way = new waybillclass();
	
	
	//test login
	if($username != NULL && $pass != NULL)
	{
		$super->superlogin($username, $pass);
		$user->userlogin($username, $pass);
		header("location: ./index.php?f=1");
	}
	
	//get all buttons values
	$superbtn = $_POST['superbtn'];	
	$userbtn = $_POST['userbtn']; 
	$compbtn = $_POST['compbtn'];
	$itembtn = $_POST['itembtn'];
	$palbtn = $_POST['palletbtn'];
	$typebtn = $_POST['typebtn'];
	$delbtn = $_POST['delbtn'];
	$deltbtn = $_POST['deltbtn'];
	$waybtn = $_POST['waybillbtn'];
	
	
	//get remove values
	$userremove = $_GET['removeuserid'];
	$superremove = $_GET['removesuperid'];
	$typeremove = $_GET['removetypeid'];
	$compremove = $_GET['removecompid'];
	$itemremove = $_GET['removeitemid'];
	$palletremove = $_GET['removepalletid'];
	$delremove = $_GET['removedelid'];
	$deltremove = $_GET['removedeltid'];
	$wayremove = $_GET['removewayid'];
	
	//supervisor functions	
	if($superbtn == 'Create' || $superbtn == 'Update' || $superremove != NULL)
	{
		$superid = $_GET['superid'];
		$superemail = $_POST['superemailtxt'];
		$superpass = $_POST['superpasswordtxt'];
		$superfname = $_POST['supernametxt'];
		
		if($superbtn == 'Create')
		{
			$super->createsuper($superemail, $superpass, $superfname);
			header('location: ./super.php');
		}
		
		if($superbtn == 'Update')
		{
			$super->editsuper($superid, $superemail, $superpass, $superfname);
			header('location: ./super.php');
		}
		
		if($superremove != NULL)
		{
			$super->removesuper($superremove);
			header('location: ./super.php');
		}		
	}
	
	//user values
	if($userbtn == 'Create' || $userbtn == 'Update' || $userremove != NULL)
	{
		$userid = $_GET['userid'];
		$useremail = $_POST['useremailtxt'];
		$userpass = $_POST['userpasswordtxt'];
		$userfname = $_POST['usernametxt'];
		
		if($userbtn == 'Create')
		{
			$user->createuser($useremail, $userpass, $userfname);
			header('location: ./user.php');
		}
		
		if($userbtn == 'Update')
		{
			$user->edituser($userid, $useremail, $userpass, $userfname);
			header('location: ./user.php');
		}
		
		if($userremove != NULL)
		{
			$user->removeuser($userremove);
			header('location: ./user.php');
		}
	}
	
	//type values
	if($typebtn == 'Create' || $typebtn == 'Update' || $typeremove != NULL)
	{
		$typeid = $_GET['typeid'];
		$typename = $_POST['typenametxt'];
		
		if($typebtn == 'Create')
		{
			$type->createtype($typename);
			header('location: ./type.php');
		}
		
		if($typebtn == 'Update')
		{
			$type->edittype($typeid, $typename);
			header('location: ./type.php');
		}
		
		if($typeremove != NULL)
		{
			$type->removetype($typeremove);
			header('location: ./type.php');
		}
	}
	
	//company values
	if($compbtn == 'Create' || $compbtn == 'Update' || $compremove != NULL)
	{
		$compid = $_GET['compid'];
		$compname = $_POST['compnametxt'];
		$compadd = $_POST['compaddtxt'];
		$comptel = $_POST['compteltxt'];
		$compfax = $_POST['compfaxtxt'];
		
		if($compbtn == 'Create')
		{
			$company->createcomp($compname, $compadd, $comptel, $compfax);
			header('location: ./company.php');
		}
		
		if($compbtn == 'Update')
		{
			$company->editcomp($compid, $compname, $compadd, $comptel, $compfax);
			header('location: ./company.php');
		}
		
		if($compremove != NULL)
		{
			$company->removecomp($compremove);
			header('location: ./company.php');
		}
		
	}
	
	//pallet values
	if($palbtn == 'Create' || $palbtn == 'Update' || $palletremove != NULL)
	{
		$palletid = $_GET['palletid'];
		$palletname = $_POST['palletnametxt'];
		$palcompid = $_POST['compnametxt'];
		$typeid = $_POST['typetxt'];
		$shelfnum = $_POST['shelftxt'];
		$rownum = $_POST['rowtxt'];
		$columnnum = $_POST['columntxt'];
		$location = $_POST['locationtxt'];
		$wayid = $_POST['wayidtxt'];
		$l = $_POST['ltxt'];
		$h = $_POST['htxt'];
		$w = $_POST['wtxt'];
		$weight = $_POST['weighttxt'];
		
		if($shelfnum == '')
		{
			$shelfnum = 'NULL';
		}
		if($wayid == '')
		{
			$wayid = 'NULL';
		}
		
		if($rownum == '')
		{
			$rownum = 'NULL';
		}
		
		if($columnnum == '')
		{
			$columnnum = 'NULL';
		}
		if($l == '')
		{
			$l = 'NULL';
		}
		
		if($h == '')
		{
			$h = 'NULL';
		}
		
		if($w == '')
		{
			$w = 'NULL';
		}
		
		if($weight == '')
		{
			$weight = 'NULL';
		}
		
		if($palbtn == 'Create')
		{
			$pallet->createpallet($palletname, $palcompid, $typeid, $shelfnum, $rownum, $columnnum, $location, $wayid, $l, $h, $w, $weight);
			header('location: ./pallet.php');
		}
		
		if($palbtn == 'Update')
		{
			$pallet->editpallet($palletid, $palletname, $palcompid, $typeid, $shelfnum, $rownum, $columnnum, $location, $wayid, $l, $h, $w, $weight);
			header('location: ./item.php?id='.$palletid.'');
		}
		
		if($palletremove != NULL)
		{
			$pallet->removepallet($palletremove);
			header('location: ./pallet.php');
		}
		
	}
	
	//item values
	if($itembtn == 'Create' || $itemremove != NULL)
	{
		$itemid = $_GET['itemid'];
		$palletid = $_SESSION['pallet'];
		$palletid1 = $_GET['palletid'];
		$itemqty = $_POST['itemqtytxt'];
		$itemserial = $_POST['itemserialtxt'];
		$itemname = $_POST['itemnametxt'];
		
		if($itembtn == 'Create')
		{
			$item->createitem($palletid, $itemqty, $itemserial, $itemname);
			header('location: ./item.php?id='.$palletid);
		}		
		if($itemremove != NULL)
		{
			$item->removeitem($itemremove);
			header('location: ./item.php?id='.$palletid1);
		}
	}
	
	//del values
	if($delbtn == 'Create' || $delbtn == 'Update' || $delremove != NULL)
	{
		$delid = $_GET['delid'];
		$delname = $_POST['delnametxt'];
		$deladd = $_POST['deladdtxt'];
		
		if($delbtn == 'Create')
		{
			$del->createdel($delname, $deladd);
			header('location: ./delivery.php?id='.$delid);
		}		
		if($delremove != NULL)
		{
			$del->removedel($delremove);
			header('location: ./delivery.php?id='.$delid);
		}
		
		if($delbtn == 'Update')
		{
			$del->editdel($delid, $delname, $deladd);
			header('location: ./delivery.php');
		}
		
		echo('no in if');
	}
	
	//delt values
	if($deltbtn == 'Create' || $deltbtn == 'Update' || $deltremove != NULL)
	{
		$deltid = $_GET['deltid'];
		$deltname = $_POST['deltnametxt'];
		
		if($deltbtn == 'Create')
		{
			$delt->createdelt($deltname);
			header('location: ./deliverytype.php?id='.$deltid);
		}		
		if($deltremove != NULL)
		{
			
			$delt->removedelt($deltremove);
			header('location: ./deliverytype.php?id='.$deltid);
		}		
		if($deltbtn == 'Update')
		{
			$delt->editdelt($deltid, $deltname);
			header('location: ./deliverytype.php');
		}
	}	
	
	if($waybtn == 'Create' || $waybtn == 'Update' || $wayremove != NULL)
	{
		$wayid = $_GET['waybillid'];
		$wayname = $_POST['waybillnumtxt'];
		$sname = $_POST['snametxt'];
		$sdate = $_POST['sdatetxt'];
		$compn = $_POST['compnametxt'];
		$delt = $_POST['delttxt'];
		$desc = $_POST['desctxt'];
		$np = $_POST['numptxt'];
		$tw = $_POST['twieghttxt'];
		$sinfo = $_POST['spinfotxt'];
		$del = $_POST['deltxt'];
		$rcom = $_POST['rcomtxt'];
		$dc = $_POST['coldeltxt'];
		$rdate = $_POST['rdatetxt'];
		$rname = $_POST['rnametxt'];
		$cnum = $_POST['cnumtxt'];
		$wl = $_POST['locationtxt'];
		
		if($del == '')
		{
			$del = 'NULL';
		}
		
		if($rcom == '')
		{
			$rcom = 'NULL';
		}
		
		if($waybtn == 'Create')
		{
			$way->createwaybill($wayname, $sname, $sdate, $compn, $delt, $desc, $np, $tw, $sinfo, $rdate, $rname, $rcom, $del, $dc, $cnum, $wl);
			header('location: ./waybill.php');
		}		
		if($wayremove != NULL)
		{
			$way->removewaybill($wayid);
			header('location: ./waybill.php');
		}		
		if($waybtn == 'Update')
		{
			$way->editwaybill($wayid, $wayname, $sname, $sdate, $compn, $delt, $desc, $np, $tw, $sinfo, $rdate, $rname, $rcom, $del, $dc, $cnum, $wl);
			header('location: ./waybill.php?id='.$wayid);
		}
	}
?> 