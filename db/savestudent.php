<?php
	include("dbhelper.php");
	$message="";
	if(isset($_POST['submit'])){
		$mode = $_POST['mode'];
		$idno = $_POST['idno'];
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$course = $_POST['course'];
		$level = $_POST['level'];
		//
		
		echo $mode;
		
			if($mode=='1'){
				$ok = updaterecord('students',['idno','lastname','firstname','course','level'],[$idno,$lastname,$firstname,$course,$level]);
				$message = ($ok==1)?"Student Updated":"Error Updating Student";
			}
			else{
				$ok = addrecord('students',['idno','lastname','firstname','course','level'],[$idno,$lastname,$firstname,$course,$level]);
				$message = ($ok==1)?"New Student Added":"Error Adding Student";
			}
		
		header("location:../index.php?message=$message");
	}
?>