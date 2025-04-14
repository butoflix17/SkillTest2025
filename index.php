<?php
	$message="";
	if(isset($_GET['message'])){
		$message=$_GET['message'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="ie-edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" href="assets/w3.css">
		<script src="assets/angular.min.js"></script>
		<title>Skills 2025</title>
	</head>
	<body ng-app="app" ng-controller="ctrl">
		<div class="w3-bar w3-indigo w3-container w3-padding">
			<h3>SKILLS REVIEW 2025</h3>
		</div>
		<div class="w3-container w3-padding">
			<div>
				
				<input type="text" ng-model="search" class="w3-border w3-margin w3-padding" placeholder="&#128269;search ...">
				
				<button class="w3-button w3-blue w3-right w3-margin w3-padding" onclick="document.getElementById('mymodal').style.display='block'">+ADD</button>
				<?php
					if($message){
						echo "<div class='w3-panel w3-center w3-padding w3-amber'>";
							echo $message;
						echo "</div>";
					}
				?>
				<table class="w3-table-all">
					<tr>
						<th ng-repeat="head in header">{{ head | uppercase}}</th>
					</tr>
					<tr ng-repeat="student in students | filter:search | orderBy:'lastname'">
						<td>{{ student['idno'] }}</td>
						<td>{{ student['lastname'] | uppercase}}</td>
						<td>{{ student['firstname']| uppercase }}</td>
						<td>{{ student['course'] | uppercase}}</td>
						<td>{{ student['level'] }}</td>
						<td>
							<a href="db/deletestudent.php?idno={{ student['idno'] }}" class="w3-button w3-red">&times;</a>
							<button class="w3-button w3-green" ng-click="editstudent(student)">&#9998;</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
		
		<div class="w3-modal" id="mymodal">
			<div class="w3-modal-content  w3-animate-top">
				<div class="w3-container w3-blue">
					<span class="w3-button w3-display-topright" onclick="document.getElementById('mymodal').style.display='none'">&times;</span>
					<h3>Student</h3>
				</div>
				<form method="post" class="w3-card-4 w3-round-xlarge w3-padding w3-container" action="db/savestudent.php">
					<input type="text" id="mode" name="mode"  ng-model="mode" style="display:none">
					<p>
						<label><b>IDNO</b></label>
						<input type="text" name="idno" id="idno" class="w3-input w3-border" ng-model="idno">
					</p>
					<p>
						<label><b>LASTNAME</b></label>
						<input type="text" name="lastname" id="lastname" class="w3-input w3-border" ng-model="lastname">
					</p>
					<p>
						<label><b>FIRSTNAME</b></label>
						<input type="text" name="firstname" id="firstname" class="w3-input w3-border" ng-model="firstname">
					</p>
					<p>
						<label><b>COURSE</b></label>
						<input type="text" name="course" id="course" class="w3-input w3-border" ng-model="course">
					</p>
					<p>
						<label><b>LEVEL</b></label>
						<input type="text" name="level" id="level" class="w3-input w3-border" ng-model="level">
					</p>
					<p>
						<input type="submit" name="submit" class="w3-button w3-blue w3-right">
					</p>
				</form>
			</div>
		</div>
		
		
		
	</body>
	<script>
		
			
		var app = angular.module("app",[]);
			app.controller("ctrl",function($scope,$http){
				$scope.header = ['idno','lastname','firstname','course','level','action'];
				$http({
					method:'GET',
					url:'http://localhost/review/db/studentlist.php'
				}).then(function(response){
					$scope.students = response.data;
				});
				$scope.editstudent = function(student){
					console.log(student);
					document.getElementById('mymodal').style.display='block';
					let values = Object.values(student);
					$scope.mode = "1";
					$scope.idno = values[1];
					$scope.lastname = values[2];
					$scope.firstname = values[3];
					$scope.course = values[4];
					$scope.level = values[5];
				}
			});
	</script>
</html>