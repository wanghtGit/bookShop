<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index</title>
</head>
<link rel="stylesheet" type="text/css" href="./lib/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./lib/css/normalize.css">
<link rel="stylesheet" type="text/css" href="./css/header.css">
<link rel="stylesheet" type="text/css" href="./css/footer.css">
<link rel="stylesheet" type="text/css" href="./css/index.css">
<body>
	<?php 
		require_once('PHPAction/util/globalSettings.php');
		require_once('PHPAction/services/advertsService.php');
		require_once('PHPAction/services/sectionsService.php');

		$advertsData = getAdverts();

		$sectionsData = getSections();

	 ?>
	
	<!-- 顶部 -->
	<?php 
		include_once('PHPAction/inc/header.php');
	 ?>

	 
	<div class="container index-content">
		<!-- 轮播 -->
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
		  </ol>

		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <a href="<?php echo $advertsData['0']['link'] ?>">
		      	<img src="<?php echo IMAGE_URL . $advertsData['0']['image'] ?>" alt="" id="ad-img">
		      </a>
		      
		    </div>
		    <?php foreach (array_splice($advertsData, 1) as $value) { ?>
			    <div class="item">
			      <a href="<?php echo $value['link'] ?>">
			      	<img src="<?php echo IMAGE_URL . $value['image']; ?>" alt="" id="ad-img">
			      </a>
			      
			    </div>
			<?php } ?>
		    <!-- 可以加文字描述 -->
		  </div>

		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>

		<!-- 栏目 -->
		<?php foreach ($sectionsData as $key => $value) { ?>
			<div class="section">
				<div class="section-title">
					<i class="section-title-bg"></i>
					<h3 class="section-name"><?php echo $value['sectionName']; ?></h3>
				</div>
				<div class="section-books">
					<?php foreach (array_splice($value['bookList'] , 0 , 5) as $k => $v) { ?>
						<a href="detail.php?id=<?php echo $v['id'] ?>" class="section-single-book" title="查看详情">
							<div class="section-single-book-name">《<?php echo $v['name']; ?>》</div>
							<div class="section-single-book-authorName">作者：<?php echo $v['authorName']; ?></div>
							<div class="section-single-book-image">
								<img src="<?php echo IMAGE_URL . $v['image'] ?>" alt="">
							</div>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>

	<?php 
		include_once('PHPAction/inc/footer.php'); 
	?>
</body>

<script src="./lib/js/jquery1.11.3.js"></script>
<script src="./lib/js/bootstrap.min.js"></script>
</html>