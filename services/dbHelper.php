<?php 
	const DB_HOST = '127.0.0.1';
	const DB_ROOT = 'root';
	const DB_PASSWORD = '123456';
	const DB_DATABASE = 'librarydb';

	function executeNonQuery($sql){
		$data = false;
		$con = mysqli_connect(DB_HOST , DB_ROOT , DB_PASSWORD , DB_DATABASE);
		if(mysqli_connect_errno($con)){
			return false;
		}
		$rs = mysqli_query($con , $sql);

		if($rs){
			$data = $rs;
		}
		mysqli_close($con);
		return $data;
	}

	function executeQuery($sql){
		$data = false;
		$con = mysqli_connect(DB_HOST , DB_ROOT , DB_PASSWORD , DB_DATABASE);
		if(mysqli_connect_errno($con)){
			return false;
		}
		$rs = mysqli_query($con , $sql);
		if($rs){
			$data = mysqli_fetch_all($rs , MYSQLI_BOTH);
			mysqli_free_result($rs);
		}
		mysqli_close($con);
		return $data;
	}

	function exeMultiQuery($sql){
		// $sql1 = "select * from books where state = 0 limit 0 , 5";
		// $sql2 = "select count(*) from books where state = 0";

		// $sql = $sql1 . ";" . $sql2;
		
		$list = [];
		$con = mysqli_connect(DB_HOST , DB_ROOT , DB_PASSWORD , DB_DATABASE);
		if(mysqli_connect_errno($con)){
			return false;
		}
		$flag = mysqli_multi_query($con , $sql);

		if($flag){
			do{
				$rs = mysqli_store_result($con);
				$data = mysqli_fetch_all($rs);
				$list[] = $data;

			}while(mysqli_more_results($con) && mysqli_next_result($con));
			mysqli_free_result($rs);
		}

		// print_r($list);
		mysqli_close($con);
		return $list;
	}

 ?>