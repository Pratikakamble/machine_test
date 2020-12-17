<?php
$conn=mysqli_connect("localhost", "root","","electricity");

?>
<!Doctype html>
<html>
	<head>
		<title>Electricity Bill</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="jquery.js"></script>
	</head>
	<body style="background-color:#efefef;">
		<div class="container">
			<div class="col-md-10 m-auto" style="background-color:white; min-height:625px;">
				<h2 class="text-center">Electricity Bill</h2>
				<div class="col-md-8 m-auto">
					<form action="calc.php" method="post" style="border:1px solid black; padding:10px;">
						<div class="form-group">
							<label>Select Customer</label>
							<select name="customer" class="form-control">
							<option value="">Select Customer</option>
							<?php
							$qry="select * from customer_master";
							$res=mysqli_query($conn, $qry);
							while($row=mysqli_fetch_assoc($res))
							{
								?><option value=<?php echo $row['id'];?>><?php echo $row['customer_name'];?></option><?php
							}
							?>
							</select>
						</div>
						<div class="form-group">
							<label>Total Unit</label>
							<input type="number" name="units" id="units" class="form-control" required>
						</div>
						<div class="form-group">
						<input type="submit" name="submit" value="Calculate" class="btn btn-success"> 
						</div>
						<div class="form-group">
							<label>Total Cost</label>
							<input type="number" name="units" id="cost" readonly class="form-control">
						</div>
					</form>
					</div>
					
					<br><br>
		<?php
			
			$q="select * from calculation cal inner join customer_master cust on cal.customer_id=cust.id";
			$r=mysqli_query($conn, $q);
			if(mysqli_num_rows($r)>0)
			{
				?><br><br>
				<h3 class="text-center">Customer Electricity Details</h3>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
						<tr>
						<th>Customer Name</th>
						<th>Date</th>
						<th>Total Unit</th>
						<th>Total Cost</th>
						</tr>
						</thead>
						<tbody>
						
						<?php
						while($ro=mysqli_fetch_assoc($r))
						{
							?>
							<tr>
								<td><?php echo $ro['customer_name'];?></td>
								<td><?php echo $ro['date'];?></td>
								<td><?php echo $ro['total_unit'];?></td>
								<td><?php echo $ro['total_cost'];?>Rs</td>
							</tr>
							<?php
						}
						?>
						
						</tbody>
					</table>
					</div>
				<?php
			}
			else{
				echo "<div class='alert alert-danger'>No Records</div>";
			}
		?>
			</div>
		</div>
		
		<script>
		$(document).ready(function(){
		$('#units').keyup(function(){
			var units=$(this).val();
			
			var cost=0;
				if(units>=1 && units<=50)
				{
					cost=units * 3.50;
					
				}
				else if(units>50 && units<=100)
				{
					cost=units * 4.00;
				}
				else if(units>100 && units<=250)
				{
					cost=units * 5.20;
				}
				else if(units>250)
				{
					cost=units * 6.50;
				}
				$('#cost').val(cost);
		})
		})
		</script>
	</body>
</html>