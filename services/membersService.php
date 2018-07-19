<?php 
	require_once('PHPAction/services/dbHelper.php');

	function getMember($userName , $password){
		$data = [];
		$sql = "select id , phone , password , name from members where phone = '${userName}' and password = PASSWORD('${password}')";

		$rs = executeQuery($sql);

		if($rs){
			foreach ($rs as $value) {
				$data[] = [
					'id' => $value[0],
					'userName' => $value[1],
					'password' => $value[2],
					'name' => $value[3]
				];
			}
			return $data;
		}else{
			return false;
		}

	}



