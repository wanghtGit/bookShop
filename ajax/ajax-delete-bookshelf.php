<?php 
	require_once('PHPAction/services/bookshelvesService.php');
	header('content-type:application/json;charset:utf-8');

	$result = [
		'code' => 100,
		'message' => '删除成功',
		'data' => null
	];

	$bookId = $_REQUEST['id'];

	$flag = deleteBookById($bookId);
	if(!$flag){
		$result['code'] = 101;
		$result['message'] = '删除失败';
	}

	echo json_encode($result);

