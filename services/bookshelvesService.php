<?php 

	require_once('PHPAction/services/dbHelper.php');

	function addBook($bookId , $memberId){
		$time = ceil(microtime(true) * 1000);

		$sql = "insert into bookshelves(Id , BookId , MemberId , CreateTime) values(UUID() , '${bookId}' , '${memberId}' , ${time})";

		$flag = executeNonQuery($sql);

		return $flag;
	}

	function getBookShelf($memberId){
		$data = [];

		$sql = "select b.id , b.isbn , b.name , b.pinyin , b.publishDate , b.image , b.introduce , b.categoryId , c.name  , b.publisherId , p.name , b.authorId ,a.name , b.amount , (select count(*) from bookdetails where bookId = b.id and state = 1) from books b inner join categories c on c.id = b.categoryId inner join publishers p on p.id = b.PublisherId inner join authors a on a.id = b.AuthorId inner join bookshelves bs on b.id = bs.bookid where bs.memberId = '${memberId}'";

		$rs = executeQuery($sql);

		if($rs){
			foreach ($rs as $key => $value) {
				$data[] = [
					'id' => $value[0],
					'isbn' => $value[1],
					'name' => $value[2],
					'image' => $value[5],
					'publisherName' => $value[10],
					'authorName' => $value[12],
					'amount' => $value[13],
					'number' => $value[14],
				];
			}			
		}

		return $data;
	}

	function deleteBookById($bookId){
		$sql = "delete from bookshelves where bookId = '${bookId}'";

		return executeNonQuery($sql);
	}

	function clearShelf($memberId){
		$sql = "delete from bookshelves where memberId='${memberId}'";
		return executeNonQuery($sql);
	}
