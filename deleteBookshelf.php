<?php 

	require_once('PHPAction/services/bookshelvesService.php');

	if(!array_key_exists('id' , $_REQUEST)){
		header('location:bookshelf.php');
	}
	$bookId = $_REQUEST['id'];

	$flag = deleteBookById($bookId);

	if($flag){
		header('location:bookshelf.php');
	}