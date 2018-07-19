<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>detail</title>
</head>
<link rel="stylesheet" type="text/css" href="./lib/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./lib/css/normalize.css">
<link rel="stylesheet" type="text/css" href="./css/header.css">
<link rel="stylesheet" type="text/css" href="./css/footer.css">
<link rel="stylesheet" type="text/css" href="./css/detail.css">
<body>
	<?php 
		require_once('PHPAction/util/globalSettings.php');
		require_once('PHPAction/services/bookService.php');

		$id = '';
		if(array_key_exists('id' , $_REQUEST)){
			$id = $_REQUEST['id'];
		}else{
			header('location:index.php');
			exit;
		}

		$singleBookData = getBookDetailById($id);

		// print_r($singleBookData);
	 ?>

	<?php 
		include_once('PHPAction/inc/header.php');
	?>
	
	<div class="container detail-outer">
		<div class="detail-title">
			<div class="clearfix detail-title-content">
				<div class="pull-left detail-title-txt">基本详情</div>
				<a href="list.php" class="pull-right btn btn-default other-book-btn">看看其他书<i class="glyphicon glyphicon-share-alt" aria-hidden="true"></i></a>
			</div>
			
		</div>
		<div class="detail-base-info clearfix">
			<div class="detail-base-info-image">
				<img src="<?php echo IMAGE_URL . $singleBookData[0]['image']; ?>" alt="">
			</div>
			<div class="detail-base-info-left">
				<div><span class="detail-base-info-title">书名：</span><?php echo $singleBookData[0]['name']; ?></div>
				<div><span class="detail-base-info-title">出版社：</span><?php echo $singleBookData[0]['publisherName']; ?></div>
				<div><span class="detail-base-info-title">出版日期：</span><?php echo $singleBookData[0]['publishDate']; ?></div>
			</div>
			<div class="detail-base-info-right">
				<div><span class="detail-base-info-title">作者：</span><?php echo $singleBookData[0]['authorName']; ?></div>
				<div><span class="detail-base-info-title">类别：</span><?php echo $singleBookData[0]['categoryName']; ?></div>
				<div><span class="detail-base-info-title">可借/库存：</span><?php echo $singleBookData[0]['number']; ?>/</span><?php echo $singleBookData[0]['amount']; ?></div>
			</div>
			<div class="detail-base-info-operate">
				<a class="btn add-bookshelf" data-bookId="<?php echo $singleBookData[0]['id']; ?>"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>加入借书架</a>
				<a href="bookshelf.php" class="btn mine-bookshelf"><i class="glyphicon glyphicon-book" aria-hidden="true"></i>我的借书架</a>
			</div>
		</div>
		<div class="brief-intro-title">
			<div class="brief-intro-title-content">
				《<?php echo $singleBookData[0]['name'] ?>》简介：
			</div>
		</div>
		<div class="brief-intro-content">
			<?php echo $singleBookData[0]['introduce'] ?>
		</div>
		<div class="author-intro-title">
			<div class="author-intro-title-content">
				作者：<?php echo $singleBookData[0]['authorName'] ?>
			</div>
		</div>
		<div class="author-intro-content">
			<?php echo $singleBookData[0]['authorIntroduce'] ?>
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
		$('.detail-base-info-operate .add-bookshelf').bind('click' , function(e){
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