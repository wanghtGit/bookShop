<?php 
	require_once('PHPAction/services/borrowRecordsService.php');

	if(!array_key_exists('state' , $_REQUEST) || !array_key_exists('orderId' , $_REQUEST)){
		header('location:order.php');
	}

	$state = $_REQUEST['state'];
	$orderId = $_REQUEST['orderId'];

	$flag = false;
	if($state == 1){
		$flag = updateOrderState($orderId , 0);
	}elseif($state == 2){
		$flag = updateOrderState($orderId , 3);
	}
	elseif($state == 3){
		$flag = updateOrderState($orderId , 4);
	}

	if($flag){
		header('location:order.php');
	}


