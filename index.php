<center>
	<span style="color:green;font-size: 22px">
		<?php 
		$start = time(); 
		function getEmptyCells(array $range,$count){
			$empty=[];
			$exist[0]="";
			$servername="localhost";
			$start="";
			$dbusername="root";
			$dbpassword="root";
			$dbname="Barname";
			$conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
			$fndCount=0;
			foreach ($range as $rangee) {
				$first=$rangee['start']."101";
				$last=$rangee['end']."101";
				$ress = $conn->query("SELECT ConsignmentNo FROM tbl_cons WHERE ConsignmentNo >= '$first' AND ConsignmentNo <= '$last'");
				if($ress->num_rows >0)
				{
					while($row = $ress->fetch_assoc())
					{
						$exist[]=$row['ConsignmentNo'];
					}
				}
				for ($i=$rangee['start']; $i <= $rangee['end']; $i++) {
					$ind=$i."101";
					if ($fndCount<$count) {
						if (empty(array_search($ind,$exist))){
							$empty[]=$ind;
							$fndCount++;
						}
					}else{
						break 2;
					}
				}
			}
			echo "Used Cells Length :".count($exist)."<br>";
			return $empty;

		}
		$range= array(
			array ('start' => 54100002320837,'end'=>54100002321838),
			array ('start' => 54100000871319,'end'=>54100000879600),
			array ('start' => 54100003970100,'end'=>54100003970125),
			array ('start' => 54100003970126,'end'=>54100003970175),
			array ('start' => 54100001393001,'end'=>54100001393100),
			array ('start' => 54100001394501,'end'=>54100001394642)
		);
		$empty=getEmptyCells($range,5550);
		$end = time();

		echo "Empty Cells Length :".count($empty);
		$duration=  $end-$start ;
		echo "<br>"."Duration (sec) :".$duration;
		?>
	</span>
</center>
