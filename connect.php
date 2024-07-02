<?php
	$conn = mysqli_connect('localhost','root','','apartments');
	$s = mysqli_query($conn,"set names UTF8");

	function getData($sql){
		global $conn;
		$query = mysqli_query($conn,$sql);
		$rows = mysqli_fetch_all($query,MYSQLI_ASSOC);
		return $rows;
	}

	function exceData($sql){
		global $conn;
		$query = mysqli_query($conn, $sql);
	
		if ($query === false) {
			die('Error: ' . mysqli_error($conn));
		}
	
		$eff = mysqli_affected_rows($conn);
		return $eff;
	}

	function insert($sql){
		global $conn;
		$query = mysqli_query($conn,$sql);
		
		if ($query === false) {
			die('Error: ' . mysqli_error($conn));
		}
		
		// รับค่า ID ที่เพิ่งถูก insert
		$lastId = mysqli_insert_id($conn);
		return $lastId;
	}
?>