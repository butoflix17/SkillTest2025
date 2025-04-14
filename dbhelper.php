<?php
	///database helper
	$hostname="127.0.0.1";
	$database="school";
	$username="root";
	$password="";
	///
	function connectdb(){
		global $hostname,$database,$username,$password;
		try{
			$conn = new PDO("mysql:host=$hostname;dbname=$database",$username,$password);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $conn;
		}catch(PDOException $e){ echo $e->getMessage();}
	}
	function postprocess($sql){
		$ok=0;
		try{
			$conn = connectdb();
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$conn = null;
			$ok = 1;
		}catch(PDOException $e){ echo $e->getMessage();}
		return $ok;
	}
	function getprocess($sql){
		$row=[];
		try{
			$conn = connectdb();
			$query=$conn->query($sql);
			$row=$query->fetchall(PDO::FETCH_ASSOC);
			$conn = null;
		}catch(PDOException $e){ echo $e->getMessage();}
		return $row;
	}
	function getall($table){
		$sql="SELECT * FROM `$table`";
		return getprocess($sql);
	}
	function getrecord($table,$fields,$data){
		$sql="SELECT * FROM `$table` WHERE `$fields`='$data'";
		return getprocess($sql);
	}
	function deleterecord($table,$fields,$data){
		$sql="DELETE FROM `$table` WHERE `$fields`='$data'";
		return postprocess($sql);
	}
	function addrecord($table,$fields,$data){
		if(count($fields)==count($data)){
			$flds = implode("`,`",$fields);
			$dats = implode("','",$data);
			$sql="INSERT INTO `$table`(`$flds`) VALUES('$dats')";
			return postprocess($sql);
		}else echo "Field(s) count is not equal to data count";
	}
	function updaterecord($table,$fields,$data){
		if(count($fields)==count($data)){
			$flds=[];
			for($i=1;$i<count($data);$i++){
				array_push($flds,"`".$fields[$i]."`='".$data[$i]."'");
			}
			$fld_data = implode(",",$flds);
			$sql="UPDATE `$table` SET $fld_data WHERE `$fields[0]`='$data[0]'";
			return postprocess($sql);
		}else echo "Field(s) count is not equal to data count";
	}
	
?>