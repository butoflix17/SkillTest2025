<?php
	include("dbhelper.php");
	////delete the student
	if(isset($_GET['idno'])){
		$idno = $_GET['idno'];
		$ok = deleterecord('students','idno',$idno);
		$message=($ok==1)?"Student $idno is Deleted":"Error Deleting Student";
		header("location:../index.php?message=$message");
	}
?>