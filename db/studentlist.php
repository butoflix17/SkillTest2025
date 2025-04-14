<?php
	include("dbhelper.php");
	///display all students
	$table = "students";
	echo json_encode(getall($table));
?>