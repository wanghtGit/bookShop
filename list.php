<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>list</title>
</head>
<link rel="stylesheet" type="text/css" href="./lib/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./lib/css/normalize.css">
<link rel="stylesheet" type="text/css" href="./css/header.css">
<link rel="stylesheet" type="text/css" href="./css/footer.css">
<link rel="stylesheet" type="text/css" href="./css/list.css">

<body>
	<?php 
		require_once('PHPAction/util/globalSettings.php');
		require_once('PHPAction/services/categoriesService.php');
		require_once('PHPAction/services/publishersService.php');
		require_once('PHPAction/services/bookService.php');

		$categoryData = getCategories();
		$publisherData = getPublishers();

		array_unshift($categoryData , ['id' => '' , 'name' => '全部']);
		array_unshift($publisherData , ['id' => '' , 'name' => '全部']);

		$keywords = '';
		$categoryId = '';
		$publisherId = '';

		$pageIndex = 0;
		$pageSize = 10;

		if(array_key_exists('keywords' , $_REQUEST)){
			$keywords = $_REQUEST['keywords'];
		}
		if(array_key_exists('categoryId' , $_REQUEST)){
			$categoryId = $_REQUEST['categoryId'];
		}
		if(array_key_exists('publisherId' , $_REQUEST)){
			$publisherId = $_REQUEST['publisherId'];
		}
		if(array_key_exists('pageIndex' , $_REQUEST)){
			$pageIndex = $_REQUEST['pageIndex'];
		}

		$bookData = getBooks($categoryId , $publisherId , $keywords , $pageIndex * 10 , $pageSize);
		$bookListLength = count($bookData['bookList']);

		$bookCount = $bookData['bookCount'];
		$total = ceil($bookCount/$pageSize);

		// print_r($bookData);

		
		
	?>

	<?php 
		include_once('PHPAction/inc/header.php');
	?>

	<div class="site-nav">
		<div class="container">
			<a href="index.php">首页</a> > <span>图书商城</span>
		</div>
	</div>
	<div class="container">
		<div class="filter-title">
			<strong>图书筛选 ></strong>
		</div>
		<div class="category">
			<span class="category-title">分 类：</span>
			<?php foreach ($categoryData as $key => $value) { ?>
				<a class="<?php echo $categoryId == $value['id'] ? 'actived' : '' ?>" href="list.php?categoryId=<?php echo $value['id']; ?>&publisherId=<?php echo $publisherId; ?>"><?php echo $value['name'] ?></a>
			<?php } ?>
		</div>
		<div class="publisher">
			<span class="publisher-title">出版社：</span>
			<?php foreach ($publisherData as $key => $value) { ?>
				<a class="<?php echo $publisherId == $value['id'] ? 'actived' : '' ?>" href="list.php?categoryId=<?php echo $categoryId; ?>&publisherId=<?php echo $value['id']; ?>"><?php echo $value['name'] ?></a>
			<?php } ?>
		</div>

		<!-- <div class="booklist-title">
			<strong>图书列表 ></strong>
		</div> -->
		<div class="booklist clearfix">
			<?php if($bookListLength > 0){ foreach ($bookData['bookList'] as $key => $value) { ?>
				<a href="detail.php?id=<?php echo $value['id'] ?>" class="booklist-single-book" title="查看图书详情">
					<div class="booklist-single-book-name"><?php echo $value['name'] ?></div>
					<div class="booklist-single-book-image">
						<img src="<?php echo IMAGE_URL . $value['image']; ?>">
					</div>
					
					<div class="booklist-single-book-info"><strong>作者：</strong><?php echo $value['authorName'] ?></div>
					<div class="booklist-single-book-info"><strong>类别：</strong><?php echo $value['categoryName'] ?></div>
					<div class="booklist-single-book-info"><strong>出版社：</strong><?php echo $value['publisherName'] ?></div>
					<div class="booklist-single-book-info"><strong>可借/库存：</strong><?php echo $value['number'] ?>/<?php echo $value['amount'] ?></div>
					<div class="booklist-single-book-btns">
						<span class="glyphicon glyphicon-heart-empty" aria-hidden="true" title="加入借书架" data-bookId="<?php echo $value['id'] ?>" id="addBookshelf"></span>
					</div>
				</a>
			<?php } }else{ ?>
				<div class="no-book-tip">抱歉，暂无该种书籍~~</div>			
			<?php } ?>
		</div>
		<div class="page-code">
			<?php for($i = 0 ; $i < $total ; $i++) { ?>
				<a href="list.php?&categoryId=<?php echo $categoryId; ?>&publisherId=<?php echo $publisherId; ?>&pageIndex=<?php echo $i; ?>" class="<?php echo $pageIndex == $i ? 'actived' : ''; ?>"><?php echo $i + 1; ?></a>
			<?php } ?>		
		</div>
	</div>
	<div class="add-tip-container">
		<div class="add-tip-content"></div>
	</div>

	<?php 
		include_once('PHPAction/inc/footer.php'); 
	?>
</body>
<script src="./lib/js/jquery1.11.3.js"></script>
<script type="text/javascript">
	$(function(){
		$('.booklist-single-book-btns span').bind('click' , function(e){
			e.preventDefault();

			let bookId = $(this).attr('data-bookId');

			$.post('ajax/ajax-addBookshelf.php?bookId=' + bookId).then(res => {
				if(res.code == 102){
					location.href = 'login.php';
					return;
				}
				$('.add-tip-container').css('display' , 'block');
				$('.add-tip-content').text(res.message);
				window.setTimeout(function(){
					$('.add-tip-container').css('display' , 'none');
				} , 700);
				// console.log(location.href);
			});

			
		});

	})

</script>

</html>