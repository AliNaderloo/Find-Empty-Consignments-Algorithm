<center>
	<span style="color:#7000cc;font-size: 42px">
		<?php 
		$start = time(); 
		function getEmptyCells($range,$count){
			$empty=[];
			$servername="localhost";
			$start="";
			$dbusername="root";
			$dbpassword="root";
			$dbname="Barname";
			$conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
			foreach ($range as $rangekey => $range) {
				for ($i=$range['start']; $i <= $range['end']; $i++) { 
					$exist=false;
					$res = $conn->query("SELECT ConsignmentNo FROM tbl_cons WHERE ConsignmentNo='$i'  LIMIT 1");
					if($res->num_rows >0)
					{
						$exist=true;
						break 2;
					}
					if (!$exist) {
						if (count($empty)>=$count) {
							break 2;
						}else{
							$empty[]=$i;
						}
					}
				}
			}
			return $empty;
		}
		$range= array(
			array ('start' => 54100003970100,'end'=>54100003970125),
			array ('start' => 54100003970126,'end'=>54100003970175),
			array ('start' => 54100001393001,'end'=>54100001393100),
			array ('start' => 54100001394501,'end'=>54100001394542)
		);
		$empty=getEmptyCells($range,50);
		$end = time();

		echo "<br>"."Empty Cells Length :".count($empty);
		$duration=  $end-$start ;
		echo "<br>"."Duration (sec) :".$duration;
		?>
	</span>
</center>