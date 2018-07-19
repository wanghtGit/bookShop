<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<link rel="stylesheet" type="text/css" href="./lib/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./lib/css/normalize.css">
<link rel="stylesheet" type="text/css" href="./css/header.css">
<link rel="stylesheet" type="text/css" href="./css/footer.css">
<link rel="stylesheet" type="text/css" href="./css/bookshelf.css">
<body>
	<?php 
		include_once('PHPAction/inc/header.php');
	?>
	<?php 

		require_once('PHPAction/util/globalSettings.php');
		require_once('PHPAction/services/bookshelvesService.php');


		if(!array_key_exists('User' , $_SESSION)){
			header('location:login.php');
			exit;
		}

		$memberId = $_SESSION['User'][0]['id'];
		
		$bookshelf = getBookShelf($memberId);
	 ?>

	
	<div class="container">
		<div class="bookshelf-content">
			<table class="table table-hover table-striped">
				<thead class="thead">
					<tr>
						<!-- <td>选择</td> -->
						<td>封面</td>
						<td>书名</td>
						<td>作者</td>
						<td>出版社</td>
						<td>操作</td>
					</tr>
				</thead>
				<tbody class="tbody">
					<?php if(count($bookshelf) > 0){ foreach ($bookshelf as $key => $value) { ?>
						<tr class="single-book">
							<!-- <td></td> -->
							<td><img src="<?php echo IMAGE_URL . $value['image'] ?>"></td>
							<td><?php echo $value['name'] ?></td>
							<td><?php echo $value['authorName'] ?></td>
							<td><?php echo $value['publisherName'] ?></td>
							<td>
								<a href="deleteBookshelf.php?id=<?php echo $value['id'] ?>" class="btn btn-default" data-bookId="<?php echo $value['id'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 移除</a>
							</td>
						</tr>
					<?php }}else{ ?>
						<tr>
							<td colspan="6" class="bookshelf-empty-tip">您的借书架空空如也~ <a href="list.php">去逛逛</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if(count($bookshelf) > 0){ ?>
			<div class="operate-btns clearfix">
				<a href="submitOrder.php" class="btn submit-order-btn pull-right"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 提交订单</a>
			</div>
			<?php } ?>
			<div>
		</div>
		
	</div>
	</div>

	<?php 
		include_once('PHPAction/inc/footer.php'); 
	?>

</body>
<script src="./lib/js/jquery1.11.3.js"></script>
<script type="text/javascript">
	$(function(){
		$('.single-book button').on('click' , function(e){
			// console.log($(this).attr('data-bookId'));
			let bookId = $(this).attr('data-bookId');

			$.post('ajax/ajax-delete-bookshelf.php?id=' + bookId).then(res => {
				console.log(res);
				if(res.code == 100){
					$(this).parent().parent().remove();
				}
			})
		})
	})
</script>

</html>