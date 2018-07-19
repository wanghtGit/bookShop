<?php 

	require_once('dbHelper.php');
	require_once('bookService.php');

	function getSections(){
		$data = [];
		$sql = "select id , name from sections";

		$rs = executeQuery($sql);
		if($rs){
			foreach ($rs as $value) {
				$data[] = [
					'sectionId' => $value['id'],
					'sectionName' => $value['name'],
					'bookList' => getBooksBySectionId($value['id'])
				];

			}
		}
		return $data;
	}