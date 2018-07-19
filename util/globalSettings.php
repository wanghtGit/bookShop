<?php 
	const IMAGE_URL = 'http://192.168.11.223:7070/PHPAction/images/';

	function generateBorrowNumber(){
		return ceil(microtime(true) * 1000) . '-' . mt_rand(1000 , 9999);
	}

 ?>