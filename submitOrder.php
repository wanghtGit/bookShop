<?php 
	session_start();
	require_once('PHPAction/services/bookService.php');
	require_once('PHPAction/services/bookshelvesService.php');
	require_once('PHPAction/services/borrowRecordsService.php');
	require_once('PHPAction/util/globalSettings.php');


	if(!array_key_exists('User' , $_SESSION)){
		header('location:login.php');
	}
	// $_SESSION['User']['id'];
	$memberId = $_SESSION['User'][0]['id'];


	// 检查图书是否可借(可借图书数量)
	$books = getBookShelf($memberId);

	$tag = null;
	foreach ($books as $key => $value) {
		if($value["number"] == 0){
			$tag = $value;
			break;
		}
	}
	if($tag){
		return  102; // 有不可借阅的图书;
	}

	// 如果可借-1- 更新图书状态 (获取图书详情)
	$detailList = [];
	foreach ($books as $key => $value) {
		$details = getBookDetail($value['id']);
		$detailList[] = $details[0];

	}

	foreach ($detailList as $key => $value) {
		updateBookDetailState($value['id'] , 0);
	}
	


	//-2- 生成订单  
	for($i = 0 ; $i < count($detailList) ; $i++){
		$borrowNumber = generateBorrowNumber();
		addOrder($borrowNumber , $books[$i]['id'] , $detailList[$i]['number'] , $memberId);
	}

	// -3- 清空借书架
	$flag = clearShelf($memberId);
	if($flag){
		header('location:order.php');
		return 100;
	}

	return 101;
			
		