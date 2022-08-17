<?php
include('export.php');
include('inc/header.php');
?>
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="js/datepickers.js"></script>
<style>
body{
	background: linear-gradient(68.6deg, rgb(252, 165, 241) 1.8%, rgb(181, 255, 255) 100.5%);
}
.input-daterange input {
  text-align: left;
}
input[type=submit]{
	background-color:#47d147;
	color:white;
	text-align: left;
	border-color:#47d147;
}
input[type=submit]:hover {
	background-color:#47d147;
	color:white;
	cursor :pointer;
	border-color:black;
}
input[type=submit]:active{
    background:#47d147;
}

input[type=submit]:focus{
    background:#47d147;
}
input[type=submit]:visited{
    background:#47d147;
}
table td {
	color:black;
}
table th {	
background-color:#0E0E10;
color:white;
}
</style>
<div class="container" style="min-height:500px;">
<br>
<div class="row">
 <form method="post">
  <div class="input-daterange">
   <div class="col-md-4">
	From<input type="text" name="fromDate" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly />
	<?php echo $startDateMessage; ?>
   </div>
   <div class="col-md-3">
	To<input type="text" name="toDate" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly />
	<?php echo $endDate; ?>
   </div>
  </div>
  <div class="col-md-2"><div>&nbsp;</div>
   <input type="submit" name="export" value="Export to CSV" class="btn btn-info" />
  </div>
 </form>
</div>
<div class="row">
	<div class="col-md-8">
		<?php echo $noResult;?>
	</div>
</div>
<br />
<table class="table table-bordered table-striped">
 <thead>
  <tr>
   <th>Date</th>
   <th>Temperature</th>
   <th>Rainfall</th>
   <th>Humidity</th>
   <th>Wind</th>
  </tr>
 </thead>
 <tbody>
  <?php
  foreach($allOrders as $order) {
   echo '
   <tr>
	<td>'.$order["Date"].'</td>
	<td>'.$order["Temperature"].'</td>
	<td>'.$order["Rainfall"].'</td>
	<td>'.$order["Humidity"].'</td>
	<td>'.$order["Wind"].'</td>
   </tr>
   ';
  }
  ?>
 </tbody>
</table>
</div>
