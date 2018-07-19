<?php 
	require_once('PHPAction/services/dbHelper.php');

	function getOrders($memberId , $state = 1){
		$data = [];

		$sql = "select b.name , b.image , p.name , a.name , br.BorrowNumber , br.BookNumber , br.CreateTime , br.State , br.id from borrowrecords br inner join books b on br.BookId = b.Id inner join publishers p on p.id = b.PublisherId inner join authors a on a.id = b.AuthorId where br.MemberId = '${memberId}' and br.State = '${state}'";

		$rs = executeQuery($sql);

		if($rs){
			foreach ($rs as $key => $value) {
				$data[] = [
					'bookName' => $value[0],
					'bookImage' => $value[1],
					'publisherName' => $value[2],
					'authorName' => $value[3],
					'borrowNumber' => $value[4],
					'ookNumber' => $value[5],
					'createTime' => $value[6],
					'orderState' => $value[7],
					'orderId' => $value[8],
				];
			}
		}

		return $data;
	}

	function addOrder($borrowNumber , $bookId , $bookNumber , $memberId){
		$sql = "insert into borrowrecords(id , borrowNumber , bookId , bookNumber , memberId  , createTime , state) values(UUID() , '${borrowNumber}' , '${bookId}' , '${bookNumber}' , '${memberId}' , UNIX_TIMESTAMP() * 1000 , 1);";

		return executeNonQuery($sql);
	}

	function updateOrderState($orderId , $state){
		$sql = "update borrowrecords set state = ${state} where id = '${orderId}'";
		return executeNonQuery($sql);
	}

