<?php 
	require_once('dbHelper.php');

	function getCategories(){
		$data = [];

		$sql = "select id , name , icon , tag from categories";
		$rs = executeQuery($sql);

		if($rs){
			foreach ($rs as $key => $value) {
				$data[] = [
					'id' => $value['id'],
					'name' => $value['name'],
					'icon' => $value['icon'],
					'tag' => $value['tag']
				];
			}
		}
		return $data;
	}


 ?>