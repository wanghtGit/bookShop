<?php 

require_once('dbHelper.php');

function addOrder($borrowNumber , $bookId , $bookNumber , $memberId){
	$sql = "insert into borrowrecords(id , borrowNumber , bookId , bookNumber , memberId  , createTime , state) values(UUID() , '${borrowNumber}' , '${bookId}' , '${bookNumber}' , '${memberId}' , UNIX_TIMESTAMP() * 1000 , 1);";

	return executeNonQuery($sql);
}