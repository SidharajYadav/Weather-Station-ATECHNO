<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


<script src="https://kit.fontawesome.com/ccbd4d6bc1.js" cross origin="anonymous">


</script>
<link rel="stylesheet"
href="style.css">
</head>
 <style type ="text/css">
 .chartBox{
	 width:500px;
 </style>
<body>
<div id ="preloader"></div>
<section>
<div class="weather-app">
<div class="container">
<h2 class="brand">The Weather Station </h2>
<div>
<h1 class="temp">17&#176;</h1>
<div class ="city-time">
<h1 class="name">London</h1>
<small>
<span class="time">06:09</span>
-
<span class="date">
Monday sep 19
</span>
</small>
</div>
<div class="weather">
<img
src =".\icons\day\122.png"
class="icon"
alt="icon"
width="50"
height="50"
/>
<span class="condition">Cloudy</span>
</div>
</div>
</div>
<div class ="panel">
<form id="locationInput">

<input 
type="text"
class="search"
placeholder="Search Location..."/>
<button type="submit" class="submit">
<i class="fas fa-search"></i>
</button>
</form>

<ul class ="cities">
<li class ="city">London</li>
<li class ="city">California</li>
<li class ="city">Paris</li>
<li class ="city">Tokyo</li>
</ul>
<ul class="details">
<h4> Weather Details</h4>
<li> 
<span>Cloudy</span>
<span class="cloud">89%</span>
</li>
<li> 
<span>Humidity</span>
<span class="humidity">89%</span>
</li>
<li> 
<span>Wind</span>
<span class="wind">89.19</span>
</li>
</ul>

</div>
<div>
</section>

<div class ="dropdown">
<div class ="select">
<div class ="selected">Records</div>
<div class ="caret"></div>
</div>
<ul class ="menu">
<li><button onclick="showData(6)">last 6hr</button></li>
<li><button onclick="showData(12)">last 12hr</button></li>
<li><button onclick="showData(24)">last 24hr</button></li>
<li><button onclick="showData(20)">Yesterday</button></li>
<li>Custom
<input type="date" id ="Test_Date"></li>
</ul>
</div>

<div>

<?php
$username = "root";
$password = "";
$database = "chartjs";

 try {
 $pdo = new PDO("mysql:host=localhost;database=$database",$username,$password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
  die("ERROR:Could not connect." .$e-> getMessage());
 }
 ?>

 <style type ="text/css">
 .chartBox{
  width:900px;
  margin: 0 auto;
 }


.b1 {

font-size:13px;
	 padding:10px;
	 border-radius:5px;
	 margin:25px;
	 color:white;
	 background-color:#47d147;
	 position:relative;
	 right:-44em;
	 top:-0.5em;

}
.record3 {

background:#2a2f3b;
	color:#fff;
	display:flex;
	justify-content:center;
	align-items:center;
	border:1px #2a2f3b solid;
	border-radius : 0.5em;
	padding:1.4em;
	cursor:pointer;
	transition:background 0.9s;
  min-width:111em;

	position:relative;
	margin:1em;
}

</style>



 
 <?php 
 try{
$sql = "SELECT * FROM chartjs.barchart";
 $result = $pdo->query($sql);
 if($result->rowCount()>0){
	 $Temperature =  array();
	 $Rainfall =  array();
	 $Humidity =  array();
	 $Wind =  array();
	 $id = array();
 while($row = $result->fetch()){
$Temperature[] = $row["Temperature"];
 $Rainfall[] = $row["Rainfall"];
 $Humidity[] = $row["Humidity"];
  $Wind[] = $row["Wind"];
  $id[]=$row["id"];
 }
 unset($result);
 }else{
 echo "No record matching your query were found";
 }
 } catch (PDOException $e){
 die ("ERROR: Could not able execute $sql.".$e->getMessage());
 }
 unset ($pdo);
 ?>
 
 

 <div class="chartBox">
 <canvas id="myChart"></canvas>
 </div>

 <button class ="b1" onclick="chartType('bar')">Bar chart</button>
<button class ="b1" onclick="chartType('line')">line chart</button>
<button class ="b1" onclick="chartType('pie')">pie chart</button>
</div>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

	//Setup block 

	const Temperature = <?php echo json_encode($Temperature);?>;
	const Rainfall = <?php echo json_encode($Rainfall);?>;
	const Humidity = <?php echo json_encode($Humidity);?>;
	const Wind = <?php echo json_encode($Wind);?>;
	const id = <?php echo json_encode($id);?>;
   const data={
        labels: ['1.00', '2.00', '3.00', '4.00', '5.00', '6.00', '7.00', '8.00','9.00','10.00','11.00','12.00','13.00','14.00','15.00','16.00','17.00','18.00','19.00','20.00','21.00','22.00','23.00','24.00'],
        datasets: [{
            label: 'Temperature°C',
            data: Temperature,
            backgroundColor:'rgba(54, 162, 235, 0.2)',
            borderColor:'rgba(54, 162, 235, 1)',
            borderWidth: 1
        },{
            label: 'Rainfall %',
            data: Rainfall,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        },{
            label: 'Humidity %',
            data: Humidity,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
    
            borderColor:'rgba(75, 192, 192, 1)',

            borderWidth: 1
        },{
            label: 'Wind km/hr',
            data: Wind,
            backgroundColor:  'rgba(255, 159, 64, 0.2)',
    
            borderColor:'rgba(255, 159, 64, 1)',


            borderWidth: 1
		}]
    };
	// config block 
	const config ={
		type: 'bar',
		data,
	 options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
	
	};
	
	//config block
const config2 ={
		type: 'line',
		data,
	 options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};
//config block
const config3 ={
		type: 'pie',
		data,
	 options: {}
};
	
	
	
	// render block 
	let myChart = new Chart (
	document.getElementById('myChart'),
	config
	);
	
function chartType(type){
	//destroy chart
	myChart.destroy();
	if(type ==='bar'){
	myChart = new Chart(
	document.getElementById('myChart'),
	config
	);
	}
	
		if(type ==='line'){
	myChart = new Chart(
	document.getElementById('myChart'),
	config2
	);
	}
	
		if(type ==='pie'){
	myChart = new Chart(
	document.getElementById('myChart'),
	config3
	);
	}
	}

	
function showData(num){
	const TemperatureSliced = Temperature.slice(0,num);
	const RainfallSliced = Rainfall.slice(0,num);
	const HumiditySliced = Humidity.slice(0,num);
	const WindSliced = Wind.slice(0,num);
	const idSliced = id.slice(0,num);
	

	
	myChart.data.datasets[0].data=TemperatureSliced;
	myChart.data.datasets[0].data=RainfallSliced;
	myChart.data.datasets[0].data=HumiditySliced;
	myChart.data.datasets[0].data=TemperatureSliced;
	//myChart.data.datasets[0].data=WindSliced;
	//myChart.data.datasets[0].data=idSliced;
	  
	  
	myChart.data.labels=TemperatureSliced;
	myChart.data.labels=RainfallSliced;
	myChart.data.labels=WindSliced;
	myChart.data.labels=HumiditySliced;  
    myChart.data.labels=idSliced;	 
	myChart.update();


	
	
	
};
</script>
</div>

<div class ="abc">
<div class ="container1">
<div class ="card1">

<div class ="content1">

<h2>Average Temperature</h2>
<h1> 32°C </h1>
<h3> Maximum 35°C</h3>
<h3> Minimum 20°C</h3>

</div>
</div>
<div class ="card1">
<div class ="content1">
<h2>Average Rainfall </h2>
<h1> 12% </h1>
<h3> Maximum 35%</h3>
<h3> Minimum 13%</h3>
</div>
</div>
<div class ="card1">
<div class ="content1">
<h2> Average WindSpeed </h2>
<h1> 18km/hr </h1>
<h3> Maximum 25km/hr</h3>
<h3> Minimum 20km/hr</h3>
</div>
</div>
</div>
</div>
<script src="assest/app.js"></script>
<script>
VanillaTilt.init(document.querySelectorAll(".card1"),{
max:25,
speed:400,
glare:true,
"max-glare":1,

})

</script>

<style type ="text/css">
#preloader{
	background:white url(assest/loader2.gif)no-repeat center center;
	background-size:40%;
	height:100vh;
	width:100%;
	position:absolute;
	z-index:100;
}

table{
	border-collapse: collapse;
    width: 100%;
    color: white;
	font-size:1.2em;
	text-align:Center;
	background-color:2a2f3b;
}
th{
	border-top: 1px solid #2a2f3b !important;
    border-bottom: none !important;
    vertical-align: middle;
    padding-top: 20px;
    padding-bottom: 20px;
	background-color:#2a2f3b;
}
tr{
	border-bottom:0.3px solid #2a2f3b;
	background-color:black;
}

	 a{
		 color:white;
		 text-decoration:none;
	 }


</style>



<button  class = "record3">
<a href="index.php">Table Records</a> 
</button>
<div>
<h3 style ="color:white;">Weather forcasting</h3>
</div>
<style>
h3{text-align:center;}
</style>
<div>
<iframe width="1520" height="600" src="https://embed.windy.com/embed2.html?lat=14.817&lon=73.740&detailLat=18.616&detailLon=73.729&width=650&height=450&zoom=5&level=surface&overlay=wind&product=ecmwf&menu=&message=&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=true&metricWind=km%2Fh&metricTemp=%C2%B0C&radarRange=-1" frameborder="0" style="border:0; width: 100%; height: 600px;"> allowfullscreen </iframe>
</div>

	<script src="assest/main.js"></script>
</body>
</html>