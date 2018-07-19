<?php 
	require_once('dbHelper.php');

	function getPublishers(){
		$data = [];

		$sql = "select id , name from publishers";
		$rs = executeQuery($sql);

		if($rs){
			foreach ($rs as $key => $value) {
				$data[] = [
					'id' => $value['id'],
					'name' => $value['name']
				];
			}
		}
		return $data;
	}

 ?>