<?php 
session_start();
require_once('PHPAction/services/bookshelvesService.php');
header('content-type:application/json;charset:utf-8');

$result = [
	'code' => 100,
	'message' => '添加成功',
	'data' => 1
];

$bookId = $_REQUEST['bookId'];
if(array_key_exists('User' , $_SESSION)){
	$memberId = $_SESSION['User'][0]['id'];

	$flag = addBook($bookId , $memberId);

	if(!$flag){
		$result['code'] = 101;
		$result['message'] = '添加失败';
		$result['data'] = 0;
	}
}else{
	$result = [
		'code' => 102,
		'message' => '用户未登录',
		'data' => 0
	];
}

echo json_encode($result);