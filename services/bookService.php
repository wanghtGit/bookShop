<?php 
	require_once('dbHelper.php');

	function getBooksBySectionId($sectionId){
		$data = [];
		$sql = "select b.id , b.isbn , b.name , b.pinyin , b.publishDate , b.image , b.introduce , b.categoryId , c.name  , b.publisherId , p.name , b.authorId ,a.name , b.amount , (select count(*) from bookdetails where bookId = b.id and state = 1) , a.introduce from books b inner join categories c on c.id = b.categoryId inner join publishers p on p.id = b.PublisherId inner join authors a on a.id = b.AuthorId inner join bookinsections bs on b.Id = bs.BookId where b.state = 0 and bs.SectionId = '${sectionId}'";

		$rs = executeQuery($sql);

		if($rs){
			foreach ($rs as $value) {
				$data[] = fetch_book($value);
			}
		}

		return $data;
	}


	function getBooks($categoryId = '' , $publisherId = '' , $keywords = '' , $startIndex = 0 , $pageSize = 10){
		$list = [];
		$sql1 = "select b.id , b.isbn , b.name , b.pinyin , b.publishDate , b.image , b.introduce , b.categoryId , c.name  , b.publisherId , p.name , b.authorId ,a.name , b.amount , (select count(*) from bookdetails where bookId = b.id and state = 1) , a.introduce from books b inner join categories c on c.id = b.categoryId inner join publishers p on p.id = b.PublisherId inner join authors a on a.id = b.AuthorId where b.state = 0";

		$sql2 = "select count(*) from books where state = 0";

		if(!empty($categoryId)){
			$sql1 = $sql1 . " and b.categoryId = '${categoryId}'";
			$sql2 = $sql2 . " and categoryId = '${categoryId}'";
		}

		if(!empty($publisherId)){
			$sql1 = $sql1 . " and b.publisherId = '${publisherId}'";
			$sql2 = $sql2 . " and publisherId = '${publisherId}'";
		}
		if(!empty($keywords)){
			$sql1 = $sql1 . " and b.name like '%${keywords}%'";
			$sql2 = $sql2 . " and keywords = '${keywords}'";
		}

		$sql1 = $sql1 . " limit ${startIndex} , ${pageSize}";

		$sql = $sql1 . ";" . $sql2;

		$rs = exeMultiQuery($sql);

		$data = [];
		if($rs){
			foreach ($rs[0] as $value) {
				$data[] = fetch_book($value);
			}
			$list['bookList'] = $data;
			$list['bookCount'] = $rs[1][0][0];
		}

		return $list;
	}

	function getBookDetailById($id){
		$data = [];
		$sql = "select b.id , b.isbn , b.name , b.pinyin , b.publishDate , b.image , b.introduce , b.categoryId , c.name  , b.publisherId , p.name , b.authorId ,a.name , b.amount , (select count(*) from bookdetails where bookId = b.id and state = 1) , a.introduce from books b inner join categories c on c.id = b.categoryId inner join publishers p on p.id = b.PublisherId inner join authors a on a.id = b.AuthorId where b.state = 0";

		$sql = $sql . " and b.id = '${id}'";

		$rs = executeQuery($sql);

		if($rs){
			foreach ($rs as $value) {
				$data[] = fetch_book($value);
			}
		}
		return $data;
	}

	function getBookDetail($bookId){
		$sql = "select id , bookId , Number , state from bookdetails where bookId = '${bookId}'";

		$data = executeQuery($sql);
		$detailList = [];
		if($data){
			foreach ($data as $key => $value) {
				
				$detailList[] = [
					"id" => $value[0],
					"bookId" => $value[1],
					"number" => $value[2],
					"state" => $value[3]
				];
			}
		}

		return $detailList;
	}

	function updateBookDetailState($detailId , $state){
		$sql = "update bookdetails set state = ${state} where id = '${detailId}'";

		return executeNonQuery($sql);
	}


	function fetch_book($value){
		return [
					'id' => $value['0'],
					'isbn' => $value['1'],
					'name' => $value['2'],
					'pinyin' => $value['3'],
					'publishDate' => $value['4'],
					'image' => $value['5'],
					'introduce' => $value['6'],
					'categoryId' => $value['7'],
					'categoryName' => $value['8'],
					'publisherId' => $value['9'],
					'publisherName' => $value['10'],
					'authorId' => $value['11'],
					'authorName' => $value['12'],
					'amount' => $value['13'],
					'number' => $value['14'],
					'authorIntroduce' => $value['15'],
				];
	}