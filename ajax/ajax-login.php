<?php 
session_start();

require_once('PHPAction/services/membersService.php');
header('content-type:application/json;charset:utf-8');

$result = [
	'code' => 100,
	'message' => '登录成功',
	'data' => null
];

$userName = $_REQUEST['userName'];
$password = $_REQUEST['password'];

$data = getMember($userName , $password);

if(!$data){
	$result['code'] = 101;
	$result['message'] = '用户名或密码不正确';
}else{
	$_SESSION['User'] = $data;
}

echo json_encode($result);