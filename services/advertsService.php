<?php 
	require_once('PHPAction/services/dbHelper.php');


	function getAdverts(){
		$data = [];
		$sql = "select id , image ,link from adverts order by priority";

		$rs = executeQuery($sql);

		if($rs){
			foreach ($rs as $key => $value) {
				$data[] = [
					'id' => $value['id'],
					'image' => $value['image'],
					'link' => $value['link']
				];
			}			
		}
		return $data;
	}

 ?>