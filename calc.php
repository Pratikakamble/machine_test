<?php
	$conn=mysqli_connect("localhost", "root","","electricity");
	if($_POST['customer']=="")
	{
		echo "<script>alert('Customer Name is required');</script>";
		echo "<script>window.location='index.php';</script>";
	}
	else{
				$units=$_POST['units'];
				$cost=0;
				if($units>=1 && $units<=50)
				{
					$cost=$units * 3.50;
					
				}
				else if($units>50 && $units<=100)
				{
					$cost=$units * 4.00;
				}
				else if($units>100 && $units<=250)
				{
					$cost=$units * 5.20;
				}
				else if($units>250)
				{
					$cost=$units * 6.50;
				}
				$dt=date('d-m-y');
				
				
				$qry="insert into calculation(date,customer_id, total_unit, total_cost) values('".$dt."','".$_POST['customer']."', '".$units."','".$cost."')";
				$res=mysqli_query($conn, $qry);
				if($res)
				{
					
				}
			
			echo "<script>alert('Saved Successfully');</script>";
			echo "<script>window.location='index.php';</script>";
}
?>