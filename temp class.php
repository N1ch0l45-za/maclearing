<?php
	class palletclass
	{
		public $palletid = 0;
		public $palletname = 'Pallet no.0'
		public $compid = 0;
		public $typeid = 0;
		public $shelfnum = 1;		
		public $rownum = 1;
		public $columnnum = 1;
		public $location = 'At Client';
		
		//create pallet
		public function createpallet($palletname, $compid, $typeid, $shelfnum, $rownum, $columnnum, $location)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("INSERT INTO pallet (palletname, compid, typeid, shelfnum, rownum, columnnum, location) 
			VALUES ('".$palletname."' , '".$compid."' , '".$typeid."' , '".$shelfnum."' , '".$rownum."' , '".$columnnum."' , '".$location."'");
			
			$user->CloseCon();
		}
		//update pallet
		public function editpallet($palletid, $palletname, $compid, $typeid, $shelfnum, $rownum, $columnnum, $location)
		{
			$user = new userclass();
			$user->OpenCon();
			
			mysql_query("UPDATE pallet SET (palletname = '".$palletname."' compid = '".$compid."',  typeid = '".$typeid."', shelfnum = '".$shelfnum."' , 
			rownum = '".$rownum."', columnnum = '".$columnnum."' , location = '".$location."'
			WHERE palletid = ".$palletid); 
			
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
		
		//list all pallets in table
		public function listpallet()
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
					</tr>");
					
			while($row = mysql_fetch_array($result))
			{
				echo("<tr>
						<td>".$row.['compid']."</td>
						<td>".$row.['palletname']."</td>
						<td>".$row.['typeid']."</td>
						<td>".$row.['shelfnum']."</td>
						<td>".$row.['rownum']."</td>
						<td>".$row.['columnnum']."</td>
						<td>".$row.['location']."</td>
						<td><a href=./pallet.php?id=".$row['palletid'].">Edit</a></td>
					</tr>");
			}
			
			echo("</table>");
			
			$user->CloseCon();
		}
	}
?>