<?php
	class userclass
	{
		public $userid = 0;
		public $useremail = 'nicholas@deck.co.za';
		public $userpass = 'password';
		public $userfname = 'Nicholas Thomson';
		
		//open connection
		public function opencon()
		{
			$con = mysql_connect("localhost","root","");
			if (!$con)
			{
			  die('Could not connect: ' . mysql_error());
			}
			
			mysql_select_db("macleas_db1", $con);
		}
		//close connection
		public function CloseCon()
		{
			$con = mysql_connect("localhost","root","");
			if (!$con)
			{
			  die('Could not connect: ' . mysql_error());
			}
			
			mysql_close($con);
		}
		//create user
		public function createuser($useremail, $userpass, $userfname)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO user (useremail, userpass, userfname) 
			VALUES ('".$useremail."', '".$userpass."',  '".$userfname."')");
			
			$user->CloseCon();
		}
		//update user
		public function edituser($userid, $useremail, $userpass, $userfname)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE user SET useremail = '".$useremail."', userpass = '".$userpass."', userfname = '".$userfname."'
			WHERE userid = ".$userid); 
			
			$user->CloseCon();
		}
		//remove user 
		public function removeuser($userid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("DELETE FROM user WHERE userid = ".$userid); 
			
			$user->CloseCon();
		}
		
		//list all users in table
		public function listusers()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM user");
			
			echo("<table>
					<tr>
						<th>Email</th>
						<th>Password</th>
						<th>Full Name</th>
						<th>Edit</th>
						<th>Remove</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['useremail']."</td>
						<td>".$row['userpass']."</td>
						<td>".$row['userfname']."</td>
						<td><a href=./user.php?id=".$row['userid'].">Edit</a></td>						
						<td><a href=./mafunctions.php?removeuserid=".$row['userid'].">Remove</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//select specific user
		public function Listuser($userid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM user");

			while($row = mysql_fetch_array($result))
			{
				if($row['userid'] = $userid)
				{
					$userarray = array($row['userid'], $row['useremail'], $row['userpass'], $row['userfname']);
				}
			}
			
			return $userarray;
				
			$user->CloseCon();
		}
		
		//user login
		public function userlogin($useremail, $userpass)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM user");
			
			while($row = mysql_fetch_array($result))
			{
				if($useremail == $row['useremail'] && $userpass == $row['userpass'])
				{
					header( "Location: ./user.php?id=".$row['userid']);
					exit();
				}
			}
			
			$user->CloseCon();
		}
		
		//test if user is user or supervisor
		public function nusercheck($useremail)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$usertest = 0;
			
			$result = mysql_query("SELECT * FROM user");
			
			while($row = mysql_fetch_array($result))
			{
				if($useremail == $row['useremail'])
				{
					$usertest = 1;
				}
			}
			
			return $usertest;
			
			$user->CloseCon();
		}
		
		//create user table
		public function nusercreate()
		{
			$user = new userclass();
			
			echo("<form action='./mafunctions.php' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='15%'></td>
							<td width='35%'></td>
							<td width='15%'></td>
							<td width='35%'></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type='text' name='useremailtxt' value=''></td>			
							<td>Password:</td>
							<td><input type='text' name='userpasswordtxt' value=''></td>
						</tr>
						<tr>
							<td>Full Name:</td>
							<td><input type='text' name='usernametxt' value=''></td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button name='userbtn' type='submit' value='Create'>Create</button></td>
						</tr>
					</table>
				</form>");
		}
		
		//edit user table
		public function nuseredit($userid)
		{
			$user = new userclass();
			
			$i = $user->Listuser($userid);
			
			echo("<form action='./mafunctions.php?userid=".$i[0]."' method='POST'>
					<table width='80%'>
						<tr>
							<td>Email:</td>
							<td><input type='text' name='useremailtxt' value='".$i[1]."'></td>			
							<td>Password:</td>
							<td><input type='text' name='userpasswordtxt' value='".$i[2]."'></td>
						</tr>
						<tr>
							<td>Full Name:</td>
							<td><input type='text' name='usernametxt' value='".$i[3]."'></td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button name='userbtn' type='submit' value='Update'>Edit</button></td>
						</tr>
					</table>
				</form>");
		}
		
		//get user name
		public function nusername($email)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$usertest = 0;
			
			$result = mysql_query("SELECT * FROM user");
			
			while($row = mysql_fetch_array($result))
			{
				if($email == $row['useremail'])
				{
					$name = $row['userfname'];
				}
			}
			return $name;
			
			$user->CloseCon();
		}
		
		// get user id
		public function getuserid($email)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$usertest = 0;
			
			$result = mysql_query("SELECT * FROM user");
			
			while($row = mysql_fetch_array($result))
			{
				if($email == $row['useremail'])
				{
					$id = $row['userid'];
				}
			}
			return $id;
			
			$user->CloseCon();
		}
	}
	
	class supervisorclass
	{
		public $superid = 0;
		public $superemail = 'nicholas@deck.co.za';
		public $superpass = 'password';
		public $superfname = 'Nicholas Thomson';
		
		
		//create super
		public function createsuper($superemail, $superpass, $superfname)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO supervisor (superemail, superpass, supername) 
			VALUES ('".$superemail."', '".$superpass."',  '".$superfname."')");
			
			$user->CloseCon();
		}
		//update super
		public function editsuper($superid, $superemail, $superpass, $superfname)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE supervisor SET superemail = '".$superemail."', superpass = '".$superpass."', supername = '".$superfname."'
			WHERE superid = ".$superid.""); 
			
			$user->CloseCon();
		}
		//remove super 
		public function removesuper($superid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("DELETE FROM supervisor WHERE superid = ".$superid.""); 
			
			$user->CloseCon();
		}
		
		//list all supervisors in table
		public function listsupervisors()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM supervisor");
			
			echo("<table>
					<tr>
						<th>Email</th>
						<th>Password</th>
						<th>Full Name</th>
						<th>Edit</th>
						<th>Remove</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['superemail']."</td>
						<td>".$row['superpass']."</td>
						<td>".$row['supername']."</td>
						<td><a href=./super.php?id=".$row['superid'].">Edit</a></td>
						<td><a href=./mafunctions.php?removesuperid=".$row['superid'].">Remove</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//select specific supervisor
		public function Listsupervisor($superid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM supervisor where superid =".$superid);

			while($row = mysql_fetch_array($result))
			{
				$userarray = array($row['superid'], $row['superemail'], $row['superpass'], $row['supername']);
			}
			
			return $userarray;
				
			$user->CloseCon();
		}
		
		//supervisor login
		public function superlogin($superemail, $superpass)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM supervisor");
			
			while($row = mysql_fetch_array($result))
			{
				if($superemail == $row['superemail'] && $superpass == $row['superpass'])
				{
					header('location: ./super.php?id='. $row['superid']);  
					exit();
				}
			}
			
			$user->CloseCon();
		}
		
		//check if a supervisor
		public function susercheck($superemail)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$usertest = 0;
			
			$result = mysql_query("SELECT * FROM supervisor");
			
			while($row = mysql_fetch_array($result))
			{
				if($superemail == $row['superemail'])
				{
					$usertest = 1;
				}
			}
			
			return $usertest;
			
			$user->CloseCon();
		}
		
		//edit supervisor table
		public function suseredit($superid)
		{
			$user = new userclass();
			$super = new supervisorclass();
			
			$i = $super->Listsupervisor($superid);
			
			echo("
				<form action='./mafunctions.php?superid=".$i[0]."' method='POST'>
					<table width='80%'>
						<tr>
							<td>Email:</td>
							<td><input type='text' name='superemailtxt' value='".$i[1]."'></td>			
							<td>Password:</td>
							<td><input type='text' name='superpasswordtxt' value='".$i[2]."'></td>
						</tr>
						<tr>
							<td>Full Name:</td>
							<td><input type='text' name='supernametxt' value='".$i[3]."'></td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button name='superbtn' type='submit' value='Update'>Edit</button></td>
						</tr>
					</table>
				</form>");
		}
		
		//create supervisor table
		public function susercreate()
		{
			$user = new userclass();
			$super = new supervisorclass();
			
			
			echo("
				<form action='./mafunctions.php' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='15%'></td>
							<td width='35%'></td>
							<td width='15%'></td>
							<td width='35%'></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type='text' name='superemailtxt' value=''></td>			
							<td>Password:</td>
							<td><input type='text' name='superpasswordtxt' value=''></td>
						</tr>
						<tr>
							<td>Full Name:</td>
							<td><input type='text' name='supernametxt' value=''></td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button name='superbtn' type='submit' value='Create'>Create</button></td>
						</tr>
					</table>
				</form>");
		}
		
		//show supervisor name
		public function susername($email)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$usertest = 0;
			
			$result = mysql_query("SELECT * FROM supervisor");
			
			while($row = mysql_fetch_array($result))
			{
				if($email == $row['superemail'])
				{
					$name = $row['supername'];
				}
			}
			return $name;
			
			$user->CloseCon();
		}
		
		// get supervisors id
		public function getsuperid($email)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$usertest = 0;
			
			$result = mysql_query("SELECT * FROM supervisor");
			
			while($row = mysql_fetch_array($result))
			{
				if($email == $row['superemail'])
				{
					$id = $row['superid'];
				}
			}
			return $id;
			
			$user->CloseCon();
		}
	}
	
	class typeclass
	{
		public $typeid = 0;
		public $typename = 'Pallet';
		
		
		//create type
		public function createtype($typename)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO type (typename) 
			VALUES ('".$typename."')");
			
			$user->CloseCon();
		}
		//update type
		public function edittype($typeid, $typename)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE type SET typename = '".$typename."' WHERE typeid = ".$typeid); 
			
			$user->CloseCon();
		}
		//remove type 
		public function removetype($typeid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("DELETE FROM type WHERE typeid = ".$typeid); 
			
			$user->CloseCon();
		}
		
		//list all types in table
		public function listtypes()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM type");
			
			echo("<table>
					<tr>
						<th>Name</th>
						<th>Edit</th>
						<th>Remove</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['typename']."</td>
						<td><a href=./type.php?id=".$row['typeid'].">Edit</a></td>
						<td><a href=./mafunctions.php?removetypeid=".$row['typeid'].">remove</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//select specific type
		public function Listtype($typeid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM type where typeid =".$typeid);

			while($row = mysql_fetch_array($result))
			{
				$userarray = array($row['typeid'], $row['typename']);
			}
			
			return $userarray;
				
			$user->CloseCon();
		}
		
		//get type name
		public function gettypename($typeid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM type where typeid =".$typeid);

			while($row = mysql_fetch_array($result))
			{
				$name = $row['typename'];
			}
			
			return $name;
				
			$user->CloseCon();
		}
		
		//type create table
		public function createtypetable()
		{
			echo("<form action='mafunctions.php' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='30%'></td>
							<td width='70%'></td>
						</tr>
						<tr>
							<td>Type:</td>
							<td><input type='text' value='' name='typenametxt'></td>
						</tr>
						<tr>
							<td colspan='2' align='right' style='background: white; border: 0px;'><button name='typebtn' type='submit' value='Create'>Create</td>
						</tr>
					</table>
				</form>");
		}
		
		//type edit table
		public function edittypetable($id)
		{
			$user = new userclass();
			
			$type = new typeclass();
			$i = $type->Listtype($id);
			
			echo("<form action='mafunctions.php?typeid=".$i[0]."' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='30%'></td>
							<td width='70%'></td>
						</tr>
						<tr>
							<td>Type:</td>
							<td><input type='text' value='".$i[1]."' name='typenametxt'></td>
						</tr>
						<tr>
							<td colspan='2' align='right' style='background: white; border: 0px;'><button name='typebtn' type='submit' value='Update'>Edit</td>
						</tr>
					</table>
				</form>");
		}
	}
	
	class deliveryclass
	{
		public $delid = 0;
		public $delname = '';
		public $deladd = '';
		
		
		//create delivery
		public function createdel($delname, $deladd)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO delivery (delname, deladd) 
			VALUES ('".$delname."', '".$deladd."')");
			
			$user->CloseCon();
		}
		//update delivery
		public function editdel($delid, $delname, $deladd)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE delivery SET delname = '".$delname."', deladd = '".$deladd."'   WHERE delid = ".$delid); 
			
			$user->CloseCon();
		}
		//remove delivery 
		public function removedel($delid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("DELETE FROM delivery WHERE delid = ".$delid); 
			
			$user->CloseCon();
		}
		
		//list all delivery in table
		public function listdeliverys()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM delivery");
			
			echo("<table>
					<tr>
						<th>Name</th>
						<th>Address</th>
						<th>Edit</th>
						<th>Remove</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['delname']."</td>
						<td>".$row['deladd']."</td>
						<td><a href=./delivery.php?id=".$row['delid'].">Edit</a></td>
						<td><a href=./mafunctions.php?removedelid=".$row['delid'].">remove</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//select specific delivery
		public function Listdelivery($delid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM delivery where delid =".$delid);

			while($row = mysql_fetch_array($result))
			{
				$userarray = array($row['delid'], $row['delname'], $row['deladd']);
			}
			
			return $userarray;
				
			$user->CloseCon();
		}
		
		//get delivery name
		public function getdeliveryname($delid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM delivery where delid =".$delid);

			while($row = mysql_fetch_array($result))
			{
				$name = $row['delname'];
			}
			
			return $name;
				
			$user->CloseCon();
		}
		
		//delivery create table
		public function createdeltable()
		{
			echo("<form action='mafunctions.php' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='30%'></td>
							<td width='70%'></td>
						</tr>
						<tr>
							<td>Delivery Name:</td>
							<td><input type='text' value='' name='delnametxt'></td>
						</tr>
						<tr>
							<td>Delivery Address:</td>
							<td><textarea type='text' cols='68' rows='4' style='resize:none' name='deladdtxt'></textarea></td>
						</tr>
						<tr>
							<td colspan='2' align='right' style='background: white; border: 0px;'><button name='delbtn' type='submit' value='Create'>Create</td>
						</tr>
					</table>
				</form>");
		}
		
		//del edit table
		public function editdeltable($id)
		{
			$user = new userclass();
			
			$del = new deliveryclass();
			$i = $del->Listdelivery($id);
			
			echo("<form action='mafunctions.php?delid=".$i[0]."' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='30%'></td>
							<td width='70%'></td>
						</tr>
						<tr>
							<td>Delivery Name:</td>
							<td><input type='text' value='".$i[1]."' name='delnametxt'></td>
						</tr>
						<tr>
							<td>Delivery Address:</td>
							<td><textarea type='text' cols='68' rows='4' style='resize:none' name='deladdtxt'>".$i[2]."</textarea></td>
						</tr>
						<tr>
							<td colspan='2' align='right' style='background: white; border: 0px;'><button name='delbtn' type='submit' value='Update'>Edit</td>
						</tr>
					</table>
				</form>");
		}
		
		public function Listdelt()
		{
			$user = new userclass();
			$del = new deliveryclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM delivery");

			while($row = mysql_fetch_array($result))
			{
				echo('<option value='.$row['delid'].'>'.$row['delname'].'</option>');
			}
			$user->CloseCon();
		}
		
		public function Listdeltname($id)
		{
			$user = new userclass();
			$del = new deliveryclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM delivery");

			while($row = mysql_fetch_array($result))
			{
				if($id == $row['delid'])
				{
					echo('<option selected value='.$row['delid'].'>'.$row['delname'].'</option>');
				}
				else
				{
					echo('<option value='.$row['delid'].'>'.$row['delname'].'</option>');					
				}
			}
			$user->CloseCon();
		}
	}
	
	class deliverytclass
	{
		public $deltid = 0;
		public $deltname = ' ';
		
		
		//create deliveryt
		public function createdelt($deltname)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO deliverytype (deltname) 
			VALUES ('".$deltname."')");
			
			$user->CloseCon();
		}
		//update deliveryt
		public function editdelt($deltid, $deltname)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE deliverytype SET deltname = '".$deltname."' WHERE delid = ".$deltid); 
			
			$user->CloseCon();
		}
		//remove deliveryt
		public function removedelt($deltid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("DELETE FROM deliverytype WHERE delid = ".$deltid); 
			
			$user->CloseCon();
		}
		
		//list all deliveryt in table
		public function listdeliveryts()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM deliverytype");
			
			echo("<table>
					<tr>
						<th>Name</th>
						<th>Edit</th>
						<th>Remove</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['deltname']."</td>
						<td><a href=./deliverytype.php?id=".$row['delid'].">Edit</a></td>
						<td><a href=./mafunctions.php?removedeltid=".$row['delid'].">remove</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//select specific delivery
		public function Listdeliveryt($deltid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM deliverytype where delid =".$deltid);

			while($row = mysql_fetch_array($result))
			{
				$userarray = array($row['delid'], $row['deltname']);
			}
			
			return $userarray;
				
			$user->CloseCon();
		}
		
		//get delivery name
		public function getdeliverytname($deltid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM deliverytype where delid =".$deltid);

			while($row = mysql_fetch_array($result))
			{
				$name = $row['deltname'];
			}
			
			return $name;
				
			$user->CloseCon();
		}
		
		//delivery create table
		public function createdelttable()
		{
			echo("<form action='mafunctions.php' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='30%'></td>
							<td width='70%'></td>
						</tr>
						<tr>
							<td>Delivery type:</td>
							<td><input type='text' value='' name='deltnametxt'></td>
						</tr>
						<tr>
							<td colspan='2' align='right' style='background: white; border: 0px;'><button name='deltbtn' type='submit' value='Create'>Create</td>
						</tr>
					</table>
				</form>");
		}
		
		//del edit table
		public function editdelttable($id)
		{
			$user = new userclass();
			
			$delt = new deliverytclass();
			$i = $delt->Listdeliveryt($id);
			
			echo("<form action='mafunctions.php?deltid=".$i[0]."' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='30%'></td>
							<td width='70%'></td>
						</tr>
						<tr>
							<td>Delivery type:</td>
							<td><input type='text' value='".$i[1]."' name='deltnametxt'></td>
						</tr>
						<tr>
							<td colspan='2' align='right' style='background: white; border: 0px;'><button name='deltbtn' type='submit' value='Update'>Edit</td>
						</tr>
					</table>
				</form>");
		}
		
		//list company names
		public function Listdelts()
		{
			$user = new userclass();
			$delt = new deliverytclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM deliverytype");

			while($row = mysql_fetch_array($result))
			{
				echo('<option value='.$row['delid'].'>'.$row['deltname'].'</option>');
			}
			$user->CloseCon();
		}
		
		public function Listdeltname($id)
		{
			$user = new userclass();
			$delt = new deliverytclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM deliverytype");

			while($row = mysql_fetch_array($result))
			{
				if($row['delid'] == $id)
				{
					echo('<option selected value='.$row['delid'].'>'.$row['deltname'].'</option>');
				}
				else
				{
					echo('<option value='.$row['delid'].'>'.$row['deltname'].'</option>');
				}
			}
			$user->CloseCon();
		}
		
	}
	
	class companyclass
	{
		public $compid = 0;
		public $compname = 'Deck';
		public $compadd = 'shop 14D Monte Vista blvd service road';
		public $comptel = '(021) 559-8373';		
		public $compfax = '(021) 559-8372';
		
		//create company
		public function createcomp($compname, $compadd, $comptel, $compfax)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO company (compname, compadd, comptel, compfax) 
			VALUES ('".$compname."' , '".$compadd."' , '".$comptel."' , '".$compfax."')");
			
			$user->CloseCon();
		}
		//update company
		public function editcomp($compid, $compname, $compadd, $comptel, $compfax)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE company SET compname = '".$compname."',  compadd = '".$compadd."', comptel = '".$comptel."' , compfax = '".$compfax."'
			WHERE compid = ".$compid); 
			
			$user->CloseCon();
		}
		//remove company 
		public function removecomp($compid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("DELETE FROM company WHERE compid = ".$compid); 
			
			$user->CloseCon();
		}
		
		//list all companies in table
		public function listcompuser()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM company");
			
			echo("<table>
					<tr>
						<th>Name</th>
						<th>Tell</th>
						<th>Fax</th>
						<th>Edit</th>			
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['compname']."</td>
						<td>".$row['comptel']."</td>
						<td>".$row['compfax']."</td>
						<td><a href=./company.php?id=".$row['compid'].">Edit</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//list all companies in table for supervisors
		public function listcompsuper()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM company");
			
			echo("<table>
					<tr>
						<th>Name</th>
						<th>Tell</th>
						<th>Fax</th>
						<th>Edit</th>						
						<th>Remove</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['compname']."</td>
						<td>".$row['comptel']."</td>
						<td>".$row['compfax']."</td>
						<td><a href=./company.php?id=".$row['compid'].">Edit</a></td>
						<td><a href=./mafunctions.php?removecompid=".$row['compid'].">Remove</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//select specific company
		public function Listcompany($compid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM company");

			while($row = mysql_fetch_array($result))
			{
				if($compid == $row['compid'])
				{
					$userarray = array($row['compid'], $row['compname'], $row['compadd'], $row['comptel'], $row['compfax']);
				}
			}
			
			return $userarray;
				
			$user->CloseCon();
		}
		
		//get company's name
		public function getcompanyname($compid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM company where compid =".$compid);

			while($row = mysql_fetch_array($result))
			{
				$name = $row['compname'];
			}
			
			return $name;
				
			$user->CloseCon();
		}
		
		//create compnay table
		public function createcompanytable()
		{
			echo("<form action='mafunctions.php' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='15%'></td>
							<td width='35%'></td>
							<td width='15%'></td>
							<td width='35%'></td>
						</tr>
						<tr>
							<td >Name:</td>
							<td><input type='text' value='' name='compnametxt'></td>
							<td colspan='2' align='right' style='background: white; border: 0px;'></td>
						</tr>
						<tr>
							<td rowspan='2'>Address:</td>
							<td rowspan='2'><textarea type='text' cols='40' rows='4' style='resize:none' name='compaddtxt'></textarea></td>
							<td>Tell:</td>
							<td><input type='text' value='' name='compteltxt'></td>
						</tr>
						<tr>
							<td>Fax:</td>
							<td><input type='text' value='' name='compfaxtxt'></td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button type='submit' value='Create' name='compbtn'>Create</td>
						</tr>
					</table>
				");
		}
		
		//edit compnay table
		public function editcompanytable($id)
		{
			$user = new userclass();
			$comp = new companyclass();
			$i = $comp->Listcompany($id);
			
			for($l = 0; $l < 15; $l++)
			{
				if($i[$l] == 'NULL')
				{
					$i[$l] = '';
				}
			}
			
			echo("<form action='mafunctions.php?compid=".$i[0]."' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='15%'></td>
							<td width='35%'></td>
							<td width='15%'></td>
							<td width='35%'></td>
						</tr>
						<tr>
							<td >Name:</td>
							<td><input type='text' value='".$i[1]."' name='compnametxt'></td>
							<td colspan='2' align='right' style='background: white; border: 0px;'></td>
						</tr>
						<tr>
							<td rowspan='2'>Address:</td>
							<td rowspan='2'><textarea type='text' name='compaddtxt' cols='40' rows='4' style='resize:none' >".$i[2]."</textarea></td>
							<td>Tell:</td>
							<td><input type='text' value='".$i[3]."' name='compteltxt'></td>
						</tr>
						<tr>
							<td>Fax:</td>
							<td><input type='text' value='".$i[4]."' name='compfaxtxt'></td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button type='submit' name='compbtn' value='Update'>Edit</td>
						</tr>
					</table>
				</form>");
		}
	}
	
	class itemclass
	{
		public $itemid = 0;
		public $palletid = 0;
		public $quantity = 75;
		public $serialnum = 'DC-HDDC';		
		public $itemname = 'External HDD case';
		
		//create item
		public function createitem($palletid, $quantity, $serialnum, $itemname)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO item (palletid, quantity, serialnum, itemname) 
			VALUES ('".$palletid."' , '".$quantity."' , '".$serialnum."' , '".$itemname."')");
			
			$user->CloseCon();
		}
		//update item
		public function edititem($itemid, $palletid, $quantity, $serialnum, $itemname)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE item SET 
			palletid = '".$palletid."',  quantity = '".$quantity."', serialnum = '".$serialnum."' , itemname = '".$itemname."'
			WHERE itemid = ".$itemid); 
			
			$user->CloseCon();
		}
		//remove item 
		public function removeitem($itemid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("DELETE FROM item WHERE itemid = ".$itemid); 
			
			$user->CloseCon();
		}
		
		//list all items in table
		public function listitem($id)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM item");
			
			echo("<table>
					<tr>
						<th>Quantity</th>
						<th>Serial/Barcode</th>
						<th>Name</th>
						<th>Remove</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				if($row['palletid'] == $id)
				{
					echo("<tr>
							<td>".$row['quantity']."</td>
							<td>".$row['serialnum']."</td>
							<td>".$row['itemname']."</td>
							<td><a href=./mafunctions.php?removeitemid=".$row['itemid']."&palletid=".$id.">Remove</a></td>
						</tr>");
				}
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//list all items in table
		public function createitemtable($id)
		{
			$pallet = new palletclass();
			$i = $pallet->getpalletname($id);
			
			echo("<form action='mafunctions.php' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='15%'></td>
							<td width='35%'></td>
							<td width='15%'></td>
							<td width='35%'></td>
						</tr>
						<tr>
							<td>Item Name:</td>
							<td><input type='text' value='' name='itemnametxt'></td>
							<td>Pallet name:</td>
							<td><input type='text' value='".$i."' name='palletnametxt' disabled='true'></td>
						</tr>
						<tr>
							<td>Quantity:</td>
							<td><input type='text' value='' name='itemqtytxt'></td>
							<td>Serial #:</td>
							<td><input type='text' value='' name='itemserialtxt'></td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button name='itembtn' type='submit' value='Create'>Create</td>
						</tr>
					</table>
				</form>");
				
			$_SESSION['pallet'] = $id;
		}
	}
	
	class palletclass
	{
		public $palletid = 0;
		public $palletname = 'Pallet no.0';
		public $compid = 0;
		public $typeid = 0;
		public $shelfnum = 1;		
		public $rownum = 1;
		public $columnnum = 1;
		public $location = 'At Client';
		public $wayid = 1;
		public $l = 15.5;
		public $w = 20.876;
		public $h = 1.527;
		public $weight = 157.585;
		
		//create pallet
		public function createpallet($palletname, $compid, $typeid, $shelfnum, $rownum, $columnnum, $location, $wayid, $l, $w, $h, $weight)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO pallet (palletname, compid, typeid, shelfnum, rownum, columnnum, location, wayid, l, w, h, weight) 
			VALUES ('".$palletname."' , '".$compid."' , '".$typeid."' , '".$shelfnum."' , '".$rownum."',
			'".$columnnum."' , '".$location."', ".$wayid.", ".$l.", ".$w.", ".$h.", ".$weight.")");
			
			$user->CloseCon();
		}
		//update pallet
		public function editpallet($palletid, $palletname, $compid, $typeid, $shelfnum, $rownum, $columnnum, $location, $wayid, $l, $w, $h, $weight)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE 'pallet' SET 'palletname'= '".$palletname."', 'compid'= ".$compid.",'typeid'= ".$typeid." 
			,'shelfnum'= '".$shelfnum."', 'rownum'= '".$rownum."', 'columnnum'= '".$columnnum."', 'location'= '".$location."', 
			'l' = ".$l.", 'w' = ".$w.", 'h' = ".$h." 'weight' = ".$weight."  WHERE 'palletid' = ".$palletid);
			
			$user->CloseCon();
		}
		//remove pallet 
		public function removepallet($palletid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("DELETE FROM pallet WHERE palletid = ".$palletid); 
			
			$user->CloseCon();
		}
		
		//list all pallets in table for supervisor
		public function listpalletssuper()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM pallet");
			
			echo("<table>
					<tr>
						<th>Company</th>						
						<th>Name</th>
						<th>Type</th>
						<th>Shelf</th>
						<th>Row</th>
						<th>Column</th>
						<th>Location</th>
						<th>Edit</th>
						<th>Remove</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				$company = new companyclass();
				$compname = $company->getcompanyname($row['compid']);
				
				$type = new typeclass();
				$typename = $type->gettypename($row['typeid']);
				
				echo("<tr>
						<td>".$compname."</td>
						<td>".$row['palletname']."</td>
						<td>".$typename."</td>
						<td>".$row['shelfnum']."</td>
						<td>".$row['rownum']."</td>
						<td>".$row['columnnum']."</td>
						<td>".$row['location']."</td>
						<td><a href=./item.php?id=".$row['palletid'].">Edit</a></td>
						<td><a href=./mafunctions.php?removepalletid=".$row['palletid'].">Remove</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//list all pallets in table for user
		public function listpalletsuser()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM pallet");
			
			echo("<table>
					<tr>
						<th>Company</th>						
						<th>Name</th>
						<th>Type</th>
						<th>Shelf</th>
						<th>Row</th>
						<th>Column</th>
						<th>Location</th>
						<th>Edit</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				$company = new companyclass();
				$compname = $company->getcompanyname($row['compid']);
				
				$type = new typeclass();
				$typename = $type->gettypename($row['typeid']);
				
				echo("<tr>
						<td>".$compname."</td>
						<td>".$row['palletname']."</td>
						<td>".$typename."</td>
						<td>".$row['shelfnum']."</td>
						<td>".$row['rownum']."</td>
						<td>".$row['columnnum']."</td>
						<td>".$row['location']."</td>
						<td><a href=./item.php?id=".$row['palletid'].">Edit</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//list all pallets in table for user
		public function listwaybillpallets($id)
		{
			
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM pallet where wayid = ".$id);
			
			echo("<table>
					<tr>				
						<th>Name</th>
						<th>L</th>
						<th>W</th>
						<th>H</th>
						<th>Weight</th>
						<th>Edit</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['palletname']."</td>
						<td>".$row['l']."</td>
						<td>".$row['w']."</td>
						<td>".$row['h']."</td>
						<td>".$row['weight']."</td>
						<td><a href=./item.php?id=".$row['palletid'].">Edit</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//list company names
		public function Listcompanynames()
		{
			$user = new userclass();
			$company = new companyclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM company");

			while($row = mysql_fetch_array($result))
			{
				echo('<option value='.$row['compid'].'>'.$row['compname'].'</option>');
			}
			$user->CloseCon();
		}
		
		//list company names select current
		public function Listcompanyname($id)
		{
			$user = new userclass();
			$company = new companyclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM company");

			while($row = mysql_fetch_array($result))
			{
				if($row['compid'] == $id)
				{
					echo('<option selected value='.$row['compid'].'>'.$row['compname'].'</option>');
				}
				else
				{
					echo('<option value='.$row['compid'].'>'.$row['compname'].'</option>');
				}
			}
			$user->CloseCon();
		}
		
		//list type names
		public function Listtypenames()
		{
			$user = new userclass();
			$type = new typeclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM type");

			while($row = mysql_fetch_array($result))
			{
				echo('<option value='.$row['typeid'].'>'.$row['typename'].'</option>');
			}
			$user->CloseCon();
		}
		
		//list type names select current
		public function Listtypename($id)
		{
			$user = new userclass();
			$company = new typeclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM type");

			while($row = mysql_fetch_array($result))
			{
				if($row['typeid'] == $id)
				{
					echo('<option selected value='.$row['typeid'].'>'.$row['typename'].'</option>');
				}
				else
				{
					echo('<option value='.$row['typeid'].'>'.$row['typename'].'</option>');
				}
			}
			$user->CloseCon();
		}
		
		//select specific pallet
		public function Listpallet($palletid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM pallet");

			while($row = mysql_fetch_array($result))
			{
				if( $row['palletid'] == $palletid)
				{
					$userarray = array($row['palletid'], $row['compid'], $row['palletname'], $row['typeid'], 
					$row['shelfnum'], $row['rownum'], $row['columnnum'], $row['location'], $row['wayid'], $row['l'], $row['w'], $row['h'], $row['weight']);
				}
			}
			
			return $userarray;
				
			$user->CloseCon();
		}
		
		//create pallet table
		public function createpallettable()
		{	
			$user = new userclass();
			$pallet = new palletclass();
			$waybill = new waybillclass();
			
			echo("<form action='mafunctions.php' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='15%'></td>
							<td width='35%'></td>
							<td width='15%'></td>
							<td width='35%'></td>
						</tr>
						<tr>
							<td>Compnay:</td>
							<td>
								<select style='width: 100%' name='compnametxt'>");
									
									$pallet->Listcompanynames();
									
								echo("</select></td>
							<td>Shelf #:</td>
							<td><input type='text' value='' name='shelftxt'></td>
						</tr>
						<tr>
							<td>Type:</td>
							<td><select type='text' value='' name='typetxt' style='width:100%'>");
									
									$pallet->Listtypenames();
									
								echo("</select>
							</td>
							<td>Row #:</td>
							<td><input type='text' value='' name='rowtxt'></td>
						</tr>
						<tr>
							<td>Pallet Name:</td>
							<td><input type='text' value='' name='palletnametxt'></td>
							<td>Column #:</td>
							<td><input type='text' value='' name='columntxt'></td>
						</tr>
						</tr>
						<tr>
							<td>Location:</td>
							<td>
								<select style='width: 100%' name='locationtxt'>
									<option>At Client</option>
									<option>On Site</option>
									<option>Dispatched</option>
								</select>
							</td>
							<td>Waybill #id</td>
							<td><select type='text' value='' name='wayidtxt' style='width:100%'>");
								
								$waybill->listwaybillnames();
								
							echo("</select>
							</td>							
						</tr>
						<tr>
							<td>Height:</td>
							<td><input type='text' value='' name='htxt'></td>
							<td>Width:</td>
							<td><input type='text' value='' name='wtxt'></td>
						</tr>
						<tr>
							<td>Length:</td>
							<td><input type='text' value='' name='ltxt'></td>
							<td>Weight:</td>
							<td><input type='text' value='' name='weighttxt'></td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button name='palletbtn' type='submit' value='Create'>Create</td>
						</tr>
					</table>
				</form>");
		}
		
		//edit pallet table
		public function editpallettable($id)
		{	
			$user = new userclass();			
			$waybill = new waybillclass();
			$pallet = new palletclass();
			$i = $pallet->Listpallet($id);
			
			echo("<form action='mafunctions.php?palletid=".$i[0]."' method='POST'>");
			
					echo($i[12]);
					echo("<table>
						<tr style='visibility:hidden;'>
							<td width='15%'></td>
							<td width='35%'></td>
							<td width='15%'></td>
							<td width='35%'></td>
						</tr>
						<tr>
							<td>Compnay:</td>
							<td>
								<select style='width: 100%' name='compnametxt'>");
									$pallet->Listcompanyname($i[1]);
								echo("</select></td>
							<td>Shelf #:</td>
							<td><input type='text' value='".$i[4]."' name='shelftxt'></td>
						</tr>
						<tr>
							<td>Type:</td>
							<td><select style='width: 100%' type='text' value='' name='typetxt'>");
									$pallet->Listtypename($i[3]);
								echo("</select>
							</td>
							<td>Row #:</td>
							<td><input type='text' value='".$i[5]."' name='rowtxt'></td>
						</tr>
						<tr>
							<td>Pallet Name:</td>
							<td><input type='text' value='".$i[2]."' name='palletnametxt'></td>
							<td>Column #:</td>
							<td><input type='text' value='".$i[6]."' name='columntxt'></td>
						</tr>
						<tr>
							<td>Location:</td>
							<td>
								<select style='width: 100%' name='locationtxt'>");
									
									if($i[7] == 'At Client')
									{
										echo("<option selected value='At Client'>At Client</option>");
									}
									else
									{
										echo("<option value='At Client'>At Client</option>");
									}
									
									if($i[7] == 'On Site')
									{
										echo("<option selected value='On Site'>On Site</option>");
									}
									else
									{
										echo("<option value='On Site'>On Site</option>");
									}
									
									if($i[7] == 'Dispatched')
									{
										echo("<option selected value='Dispatched'>Dispatched</option>");
									}
									else
									{
										echo("<option value='Dispatched'>Dispatched</option>");
									}
									
								echo("</select>
							</td>
							<td>Waybill #id</td>
							<td><select type='text' value='' name='wayidtxt' style='width:100%'>");
								
								$waybill->listwaybillname($i[8]);
									
								echo("</select>
								</td>							
							</tr>
							<tr>
								<td>Height:</td>
								<td><input type='text' value='".$i[11]."' name='htxt'></td>
								<td>Width:</td>
								<td><input type='text' value='".$i[10]."' name='wtxt'></td>
							</tr>
							<tr>
								<td>Length:</td>
								<td><input type='text' value='".$i[9]."' name='ltxt'></td>
								<td>Weight:</td>
								<td><input type='text' value='".$i[12]."' name='weighttxt'></td>
							</tr>
							</tr>
							<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button name='palletbtn' type='submit' value='Update'>Edit</td>
						</tr>
					</table>
				</form>");
		}
		
		//get pallet name
		public function getpalletname($palletid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM pallet");

			while($row = mysql_fetch_array($result))
			{
				if( $row['palletid'] == $palletid)
				{
					$name = $row['palletname'];
				}
			}
			
			return $name;
				
			$user->CloseCon();
		}
		
		public function ptbcreport()
		{	
			$user = new userclass();
			$user->OpenCon();
			$pallet = new palletclass();
			$company = new companyclass();			
			$waybill = new waybillclass();
			
			echo("<table>
			<tr>
				<th>Waybill Number</th>
				<th>Pallet Name</th>
				<th>Company</th>
			</tr>");
			
			
			$result = mysql_query("select * from pallet where location = 'At Client'");
						
			while($row = mysql_fetch_array($result))
			{
				$compname = $company->getcompanyname($row['compid']);			
				$waybillname = $waybill->getwaybillname($row['wayid']);
				
				echo("<tr>
						<td>".$waybillname."</td>
						<td>".$row['palletname']."</td>
						<td>".$compname."</td>
					</tr>");
			}
			
			$user->CloseCon();
		}
		
		public function pdreport()
		{	
			$user = new userclass();
			$user->OpenCon();
			$pallet = new palletclass();
			$company = new companyclass();			
			$waybill = new waybillclass();
			
			echo("<table>
			<tr>
				<th>Waybill Number</th>
				<th>Pallet Name</th>
				<th>Company</th>
			</tr>");
			
			
			$result = mysql_query("select * from pallet where location = 'Dispatched'");
			
			while($row = mysql_fetch_array($result))
			{
				$compname = $company->getcompanyname($row['compid']);			
				$waybillname = $waybill->getwaybillname($row['wayid']);
				
				echo("<tr>
						<td>".$waybillname."</td>
						<td>".$row['palletname']."</td>
						<td>".$compname."</td>
					</tr>");
			}
			$user->CloseCon();
		}
		
		public function osreport()
		{	
			$user = new userclass();
			$user->OpenCon();
			$pallet = new palletclass();
			
			$company = new companyclass();			
			$waybill = new waybillclass();
			
			echo("<table>
			<tr>				
				<th>Waybill Number</th>
				<th>Pallet Name</th>
				<th>Company</th>
			</tr>");
			
			
			$result = mysql_query("select * from pallet where location = 'On Site'");
			
			while($row = mysql_fetch_array($result))
			{
				$compname = $company->getcompanyname($row['compid']);			
				$waybillname = $waybill->getwaybillname($row['wayid']);
				
				echo("<tr>
						<td>".$waybillname."</td>
						<td>".$row['palletname']."</td>
						<td>".$compname."</td>
					</tr>");
			}
			
			$user->CloseCon();
		}
	}
	
	class waybillclass
	{
		public $waybillid = 0;
		public $waybillnum = '#555';
		public $sndname = 'Nicholas';
		public $cdate = '05-03-2014';
		public $compid = 0;		
		public $deltid = 1;
		public $desc = 'lots of little things';
		public $numpie = 9;
		public $tweight = 500;		
		public $spinfo = 'handle with care';
		public $rdate = '05-04-2014';
		public $rname = 'David';
		public $rcompany = 'Deck Computers';		
		public $delit = 0;
		public $coldel = 'Collect';		
		public $rnum = '021 559 8373';
		public $wlocation = 'At Client';
		
		//create waybill
		public function createwaybill($waybillnum, $sndname, $cdate, $compid, $deltid, $desc, $numpie, $tweight, $spinfo, $rdate, $rname, $rcompany, $delit, $coldel, $rnum, $wlocation)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO waybill (waybillnum, sndname, cdate, compid, deltid, 'desc', numpie, tweight, spinfo, rdate, rname, rcompany, delit, coldel, rnum, wlocation) 
			VALUES ('".$waybillnum."' , '".$sndname."' , '".$cdate."' , ".$compid." , ".$deltid." , `".$desc."` , ".$numpie." , ".$tweight." , 
			'".$spinfo."' , '".$rdate."' , '".$rname."' , '".$rcompany."' , ".$delit.", '".$coldel."', '".$rnum."', '".$wlocation."')");
			
			$user->CloseCon();
		}
		//update waybill
		public function editwaybill($waybillid, $waybillnum, $sndname, $cdate, $compid, $deltid, $desc, $numpie, $tweight, $spinfo, $rdate, $rname, $rcompany, $delit, $coldel, $rnum, $wlocation)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE waybill SET waybillnum = '".$waybillnum."', sndname= '".$sndname."' ,cdate= '".$cdate."' ,compid = ".$compid.", 
			deltid = ".$deltid.", `desc` = '".$desc."', numpie = ".$numpie.",tweight = ".$tweight.", spinfo = '".$spinfo."', rdate = '".$rdate."', 
			rname = '".$rname."', rcompany = '".$rcompany."', delit = ".$delit.", coldel = '".$coldel."', rnum = '".$rnum."', wlocation = '".$wlocation."' WHERE waybillid = ".$waybillid);
			
			$user->CloseCon();
		}
		//remove waybill 
		public function removewaybill($waybillid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("DELETE FROM waybill WHERE waybillid = ".$waybillid); 
			
			$user->CloseCon();
		}
		
		//list all waybill in table for supervisor
		public function listwaybillssuper()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM waybill");
			
			echo("<table>
					<tr>
						<th>Waybill#</th>						
						<th>Compay</th>
						<th>Type</th>
						<th># Pices</th>
						<th>Weight</th>
						<th>Delivery Name</th>
						<th>Date</th>
						<th>Edit</th>
						<th>Remove</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				$company = new companyclass();
				$compname = $company->getcompanyname($row['compid']);
				
				$delt = new deliverytclass();
				$deltname = $delt->getdeliverytname($row['deltid']);
				
				$del = new deliveryclass();
				$delname = $del->getdeliverytname($row['delid']);
				
				echo("<tr>
						<td>".$row['waybillnum']."</td>
						<td>".$compname."</td>
						<td>".$deltname."</td>
						<td>".$row['numpie']."</td>
						<td>".$row['tweight']."</td>
						<td>".$delname."</td>
						<td>".$row['cdate']."</td>
						<td><a href=./waybill.php?id=".$row['waybillid'].">Edit</a></td>
						<td><a href=./mafunctions.php?removewaybillid=".$row['waybillid'].">Remove</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//list all waybill in table for user
		public function listwaybillsuser()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM waybill");
			
			echo("<table>
					<tr>
						<th>Waybill#</th>						
						<th>Compay</th>
						<th>Type</th>
						<th># Pices</th>
						<th>Weight</th>
						<th>Delivery Name</th>
						<th>Date</th>
						<th>Edit</th>
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				$company = new companyclass();
				$compname = $company->getcompanyname($row['compid']);
				
				$delt = new deliverytclass();
				$deltname = $delt->getdeliverytname($row['deltid']);
				
				$del = new deliveryclass();
				$delname = $del->getdeliverytname($row['delid']);
				
				echo("<tr>
						<td>".$row['waybillnum']."</td>
						<td>".$compname."</td>
						<td>".$deltname."</td>
						<td>".$row['numpie']."</td>
						<td>".$row['tweight']."</td>
						<td>".$delname."</td>
						<td>".$row['cdate']."</td>
						<td><a href=./waybill.php?id=".$row['waybillid'].">Edit</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		//select specific waybill
		public function Listwaybill($waybillid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM waybill");

			while($row = mysql_fetch_array($result))
			{
				if( $row['waybillid'] == $waybillid)
				{
					$userarray = array($row['waybillnum'], $row['sndname'], $row['cdate'], $row['compid'], 
					$row['deltid'], $row['desc'], $row['numpie'], $row['tweight'], $row['spinfo'], $row['rdate'],
					$row['rname'], $row['rcompany'], $row['delid'], $row['coldel'], $row['rnum'], $row['waybillid'], $row['wlocation']);
				}
			}
			
			return $userarray;
				
			$user->CloseCon();
		}
		
		//create pallet table
		public function createwaybilltable()
		{	
			$user = new userclass();
			$waybill = new waybillclass();
			$pallet = new palletclass();
			$del = new deliveryclass();
			$delt = new deliverytclass();
			
			echo("<form action='mafunctions.php' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='15%'></td>
							<td width='35%'></td>
							<td width='15%'></td>
							<td width='35%'></td>
						</tr>
						<tr>
							<td>Waybill #:</td>
							<td><input type='text' value='' name='waybillnumtxt'></td>
						</tr>
						<tr>
							<td colspan='4'>Sender Details</td>
						</tr>
						<tr>
							<td>Sender Name</td>
							<td><input type='text' value='' name='snametxt'></td>
							<td>Send Date</td>
							<td><input type='text' value='' name='sdatetxt'></td>
						</t>
						<tr>
							<td>Company:</td>
							<td>
								<select style='width: 100%' name='compnametxt'>");
									
									$pallet->Listcompanynames();
									
								echo("</select></td>
							<td>Delivery Type:</td>
							<td>
								<select style='width: 100%' name='delttxt'>");
									$delt->listdelts();
							echo("</select></td>
							</td>
						</tr>
						<tr>
							<td rowspan='2'>Description:</td>
							<td rowspan='2'><textarea type='text' cols='35' rows='4' style='resize:none' name='desctxt' style='width:100%'></textarea>
							</td>
							<td># Pices</td>
							<td><input type='text' value='0' name='numptxt'></td>
						</tr>
						<tr>
							<td>Total Weight:</td>
							<td><input type='text' value='0' name='twieghttxt'></td>
						</tr>
						<tr>
							<td rowspan='2'>Special Instructions:</td>
							<td rowspan='2' colspan='3'>
								<textarea type='text' cols='85' rows='4' style='resize:none' name='spinfotxt' style='width:100%'></textarea>
							</td>
						</tr>
						<tr></tr>
						<tr>
							<td colspan='4'>Receiver Details</td>
						</tr>	
						<tr>
							<td>Receiving Address:</td>
							<td>
								<select style='width: 100%' name='deltxt'>");
									$del->Listdelt();
							echo("</select></td>
							<td>Receiving Company</td>
							<td><input type='text' value='' name='rcomtxt'></td>
						</tr>
						<tr>
							<td>Collect/Delivery</td>
							<td>
								<select style='width: 100%' type='text' value='' name='coldeltxt'>
									<option value='Collect'>Collect</option>
									<option value='Delivery'>Delivery</option>
								</select>
							</td>
							<td>Receiving Date</td>
							<td><input type='text' value='' name='rdatetxt'></td>
						</tr>
						<tr>
							<td>Person Receiving</td>
							<td><input type='text' value='' name='rnametxt'></td>
							<td>Contact number:</td>
							<td><input type='text' value='' name='cnumtxt'></td>
						</tr>
						<tr>
							<td>Location:</td>
							<td>
								<select style='width: 100%' name='locationtxt'>
									<option>At Client</option>
									<option>On Site</option>
									<option>Dispatched</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button name='waybillbtn' type='submit' value='Create'>Create</td>
						</tr>
					</table>
				</form>");
		}
		
		//edit pallet table
		public function editwaybilltable($id)
		{			
			$user = new userclass();
			$waybill = new waybillclass();
			$i = $waybill->Listwaybill($id);
			
			$pallet = new palletclass();
			$del = new deliveryclass();
			$delt = new deliverytclass();
			
			for($l = 0; $l < 15; $l++)
			{
				if($i[$l] == 'NULL')
				{
					$i[$l] = '';
				}
			}
			
			$tp = $waybill->getwaytp($i[15]);
			$tw = $waybill->getwaytw($i[15]);
			
			echo("<form action='mafunctions.php?waybillid=".$i[15]."' method='POST'>
					<table>
						<tr style='visibility:hidden;'>
							<td width='15%'></td>
							<td width='35%'></td>
							<td width='15%'></td>
							<td width='35%'></td>
						</tr>
						<tr>
							<td>Waybill #:</td>
							<td><input type='text' value='".$i[0]."' name='waybillnumtxt'></td>
						</tr>
						<tr>
							<td colspan='4'>Sender Details</td>
						</tr>
						<tr>
							<td>Sender Name</td>
							<td><input type='text' value='".$i[1]."' name='snametxt'></td>
							<td>Send Date</td>
							<td><input type='text' value='".$i[2]."' name='sdatetxt'></td>
						</t>
						<tr>
							<td>Company:</td>
							<td>
								<select style='width: 100%' name='compnametxt'>");
									
									$pallet->Listcompanyname($i[3]);
									
								echo("</select></td>
							<td>Delivery Type:</td>
							<td>
								<select style='width: 100%' name='delttxt'>");
									$delt->listdeltname($i[4]);
							echo("</select></td>
							</td>
						</tr>
						<tr>
							<td rowspan='2'>Description:</td>
							<td rowspan='2'><textarea type='text' cols='35' rows='4' style='resize:none' name='desctxt' style='width:100%'>".$i[5]."</textarea>
							</td>
							<td># Pices</td>
							<td><input type='text' value='". $tp ."' name='numptxt'></td>
						</tr>
						<tr>
							<td>Total Weight:</td>
							<td><input type='text' value='". $tw ."' name='twieghttxt'></td>
						</tr>
						<tr>
							<td rowspan='2'>Special Instructions:</td>
							<td rowspan='2' colspan='3'>
								<textarea type='text' cols='85' rows='4' style='resize:none' name='spinfotxt' style='width:100%'>".$i[8]."</textarea>
							</td>
						</tr>
						<tr></tr>
						<tr>
							<td colspan='4'>Reciever Details</td>
						</tr>	
						<tr>
							<td>Receiving Address:</td>
							<td>
								<select style='width: 100%' name='delttxt'>");
									$del->listdeltname($i[12]);
							echo("</select></td>
							</td>
							
							<td>Receiving Company:</td>
							<td><input type='text' value='".$i[11]."' name='rcomtxt'></td>
						</tr>
						<tr>
							<td>Collect/Delivery</td>
							<td>
								<select style='width: 100%' type='text' value='' name='coldeltxt'>");
								
								if($i[13] == 'Collect')
								{
									echo("<option value='Collect'>Collect</option>
									<option value='Delivery'>Delivery</option>");
								}
								else
								{
									echo("<option value='Delivery'>Delivery</option>
									<option value='Collect'>Collect</option>");
								}
								echo("</select>
							</td>
							<td>Receiving Date</td>
							<td><input type='text' value='".$i[9]."' name='rdatetxt'></td>
						</tr>
						<tr>
							<td>Person Receiving</td>
							<td><input type='text' value='".$i[10]."' name='rnametxt'></td>
							<td>Contact number:</td>
							<td><input type='text' value='".$i[14]."' name='cnumtxt'></td>
						</tr>
						<tr>
							<td>Location:</td>
							<td>
								<select style='width: 100%' name='locationtxt'>");
									
									if($i[16] == 'At Client')
									{
										echo("<option selected value='At Client'>At Client</option>");
									}
									else
									{
										echo("<option value='At Client'>At Client</option>");
									}
									
									if($i[16] == 'On Site')
									{
										echo("<option selected value='On Site'>On Site</option>");
									}
									else
									{
										echo("<option value='On Site'>On Site</option>");
									}
									
									if($i[16] == 'Dispatched')
									{
										echo("<option selected value='Dispatched'>Dispatched</option>");
									}
									else
									{
										echo("<option value='Dispatched'>Dispatched</option>");
									}
									
								echo("</select>
							</td>
						</tr>
						<tr>
							<td colspan='4' align='right' style='background: white; border: 0px;'><button name='waypbtn' type='submit' value='Print'>Print</><button name='waybillbtn' type='submit' value='Update'>Edit</td>
						</tr>
					</table>
				</form>");
		}
		
		public function listwaybillnames()
		{
			$user = new userclass();
			$delt = new deliverytclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM waybill");
			
			echo("<option value=NULL></option>");
			
			while($row = mysql_fetch_array($result))
			{
				echo('<option value='.$row['waybillid'].'>'.$row['waybillnum'].'</option>');
			}
			$user->CloseCon();
		}
		
		public function listwaybillname($id)
		{
			$user = new userclass();
			$delt = new deliverytclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM waybill");

			
			echo("<option value=NULL></option>");
			while($row = mysql_fetch_array($result))
			{
				if($row['delid'] == $id)
				{
					echo('<option selected value='.$row['waybillid'].'>'.$row['waybillnum'].'</option>');
				}
				else
				{
					echo('<option value='.$row['waybillid'].'>'.$row['waybillnum'].'</option>');
				}
			}
			$user->CloseCon();
		}
		
		public function wfcreport($compid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$comp = new companyclass();
			
			$result = mysql_query("select * FROM waybill WHERE compid = ". $compid." AND wlocation <> 'Dispatched'");
			
			echo("<table>
			<tr>
				<th>Waybill Number</th>
				<th>Company</th>
				<th>Date created</th>
				<th>Date Received</th>
			</tr>");
			
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['waybillnum']."</td>
						<td>".$comp->getcompanyname($row['compid'])."</td>
						<td>".$row['cdate']."</td>
						<td>".$row['rdate']."</td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		public function wtbcreport()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$comp = new companyclass();
			
			$result = mysql_query("select * FROM waybill WHERE wlocation = 'At Client' AND rdate = NULL");
			
			echo("<table>
			<tr>
				<th>Waybill Number</th>
				<th>Company</th>
				<th>Date created</th>
				<th>Date Received</th>
			</tr>");
			
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['waybillnum']."</td>
						<td>".$comp->getcompanyname($row['compid'])."</td>
						<td>".$row['cdate']."</td>
						<td>".$row['rdate']."</td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		public function wosnreport()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$comp = new companyclass();
			
			$result = mysql_query("SELECT * FROM waybill WHERE (datediff(cdate, curdate()) > -90) AND rdate = NULL");
			
			echo("<table>
			<tr>
				<th>Waybill Number</th>
				<th>Company</th>
				<th>Date created</th>
				<th>Date Received</th>
			</tr>");
			
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['waybillnum']."</td>
						<td>".$comp->getcompanyname($row['compid'])."</td>
						<td>".$row['cdate']."</td>
						<td>".$row['rdate']."</td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		public function wos3report()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$comp = new companyclass();
			
			$result = mysql_query("SELECT * FROM waybill WHERE (datediff(cdate, curdate()) < -90  AND datediff(cdate, curdate()) > -180) AND rdate = NULL");
			
			echo("<table>
			<tr>
				<th>Waybill Number</th>
				<th>Company</th>
				<th>Date created</th>
				<th>Date Received</th>
			</tr>");
			
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['waybillnum']."</td>
						<td>".$comp->getcompanyname($row['compid'])."</td>
						<td>".$row['cdate']."</td>
						<td>".$row['rdate']."</td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		public function wos6report()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$comp = new companyclass();
			
			$result = mysql_query("SELECT * FROM waybill WHERE (datediff(cdate, curdate()) < -180  AND datediff(cdate, curdate()) > -360) AND rdate = NULL");
			
			echo("<table>
			<tr>
				<th>Waybill Number</th>
				<th>Company</th>
				<th>Date created</th>
				<th>Date Received</th>
			</tr>");
			
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['waybillnum']."</td>
						<td>".$comp->getcompanyname($row['compid'])."</td>
						<td>".$row['cdate']."</td>
						<td>".$row['rdate']."</td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		public function wos1yreport()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$comp = new companyclass();
			
			$result = mysql_query("select * FROM waybill WHERE (datediff(cdate, curdate()) < -360) AND rdate = NULL");
			
			echo("<table>
			<tr>
				<th>Waybill Number</th>
				<th>Company</th>
				<th>Date created</th>
				<th>Date Received</th>
			</tr>");
			
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['waybillnum']."</td>
						<td>".$comp->getcompanyname($row['compid'])."</td>
						<td>".$row['cdate']."</td>
						<td>".$row['rdate']."</td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		public function waydisyreport()
		{
			$user = new userclass();
			$user->OpenCon();
			
			$comp = new companyclass();
			
			$result = mysql_query("select * FROM waybill WHERE wlocation = 'Dispatched'");
			
			echo("<table>
			<tr>
				<th>Waybill Number</th>
				<th>Company</th>
				<th>Date created</th>
				<th>Date Received</th>
			</tr>");
			
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row['waybillnum']."</td>
						<td>".$comp->getcompanyname($row['compid'])."</td>
						<td>".$row['cdate']."</td>
						<td>".$row['rdate']."</td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
		
		public function getwaybillname($wayid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("SELECT * FROM waybill");

			while($row = mysql_fetch_array($result))
			{
				if( $row['waybillid'] == $wayid)
				{
					$name = $row['waybillnum'];
				}
			}
			
			return $name;
				
			$user->CloseCon();
		}
		
		public function getwaytp($id)
		{			
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("select * from pallet where wayid = ".$id);
			
			$num = 0;			
			
			while($row = mysql_fetch_array($result))
			{
				$num += 1;
			}
			
			return $num;
			
			$user->CloseCon();
		}
		
		public function getwaytw($waybillid)
		{
			$user = new userclass();
			$user->OpenCon();
			
			$result = mysql_query("select Sum(weight) as `totalw` from pallet where wayid = ". $waybillid);
			
			while($row = mysql_fetch_array($result))
			{
				$sum = $row['totalw'];
			}
			
			return $sum;
			
			$user->CloseCon();
		}
	}
?>
