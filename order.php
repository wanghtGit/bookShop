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
<link rel="stylesheet" type="text/css" href="./css/order.css">
<body>
	<?php 
		include_once('PHPAction/inc/header.php');
	?>
	
	<?php 
		require_once('PHPAction/util/globalSettings.php');
		require_once('PHPAction/services/borrowRecordsService.php');

		if(!array_key_exists('User' , $_SESSION)){
			header('location:login.php');
			exit;
		}

		$memberId = $_SESSION['User'][0]['id'];

		$oneOrders = getOrders($memberId , 1);
		$twoOrders = getOrders($memberId , 2);
		$threeOrders = getOrders($memberId , 3);
		$fourOrders = getOrders($memberId , 4);
		$zeroOrders = getOrders($memberId , 0);

		// $historyOrders = [];


	 ?>

	<div class="container orders">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs order-nav" role="tablist">
		  	<li role="presentation" class="active"><a href="#one" aria-controls="home" role="tab" data-toggle="tab">待配送</a></li>
		  	<li role="presentation"><a href="#two" aria-controls="profile" role="tab" data-toggle="tab">待收货</a></li>
		  	<li role="presentation"><a href="#three" aria-controls="profile" role="tab" data-toggle="tab">待归还</a></li>
		  	<li role="presentation"><a href="#four" aria-controls="profile" role="tab" data-toggle="tab">已完成</a></li>
		  	<li role="presentation"><a href="#zero" aria-controls="profile" role="tab" data-toggle="tab">已取消</a></li>
		</ul>

		 <!-- Tab panes -->
		<div class="tab-content">
			<!-- 待配送 1 -->
		  	<div role="tabpanel" class="tab-pane active order-content" id="one">
		  		<?php if(count($oneOrders) > 0){foreach ($oneOrders as $key => $value) { ?>
			  		<div class="single-order">
			  			<div class="clearfix single-order-orderinfo">
			  				<div class="pull-left">订单号: <?php echo $value['borrowNumber'] ?></div>
			  				<div class="pull-right">创建时间: <?php echo date('Y-m-d H:i:s' , ($value['createTime']/1000)) ?></div>
			  			</div>
			  			<div class="single-order-bookinfo">
			  				<div>
			  					<img src="<?php echo IMAGE_URL . $value['bookImage'] ?>">
			  				</div>
			  				<div><?php echo $value['bookName'] ?></div>
			  				<div><?php echo $value['authorName'] ?></div>
			  				<div><?php echo $value['publisherName'] ?></div>
			  				<div><?php echo $value['ookNumber'] ?></div>
			  				<div>订单等待配送中</div>	
			  			</div>
			  			<div class="clearfix single-order-operate">
			  				<div class="pull-left">收货地址 :  苏州高新软件园</div>
			  				<a href="updateOrderState.php?orderId=<?php echo $value['orderId'] ?>&state=<?php echo $value['orderState'] ?>" class="btn btn-default pull-right">取消订单</a>
			  			</div>
			  			
			  		</div>
			  	<?php }}else{ ?>
					<div class="empty-order-tip">您还没有当前订单记录~</div>
			  	<?php } ?>
		  	</div>
		  	<!-- 待收货 2 -->
		  	<div role="tabpanel" class="tab-pane order-content" id="two">
		  		<?php if(count($twoOrders) > 0){foreach ($twoOrders as $key => $value) { ?>
			  		<div class="single-order">
			  			<div class="clearfix single-order-orderinfo">
			  				<div class="pull-left">订单号: <?php echo $value['borrowNumber'] ?></div>
			  				<div class="pull-right">创建时间: <?php echo date('Y-m-d H:i:s' , ($value['createTime']/1000)) ?></div>
			  			</div>
			  			<div class="single-order-bookinfo">
			  				<div>
			  					<img src="<?php echo IMAGE_URL . $value['bookImage'] ?>">
			  				</div>
			  				<div><?php echo $value['bookName'] ?></div>
			  				<div><?php echo $value['authorName'] ?></div>
			  				<div><?php echo $value['publisherName'] ?></div>
			  				<div><?php echo $value['ookNumber'] ?></div>
			  				<div>订单等待收货中</div>	
			  			</div>
			  			<div class="clearfix single-order-operate">
			  				<div class="pull-left">收货地址 :  苏州高新软件园</div>
			  				<a href="updateOrderState.php?orderId=<?php echo $value['orderId'] ?>&state=<?php echo $value['orderState'] ?>" class="btn btn-success pull-right">确认收货</a>
			  			</div>
			  		</div>
			  	<?php }}else{ ?>
					<div class="empty-order-tip">您还没有当前订单记录~</div>
			  	<?php } ?>
		  	</div>
		  	<!-- 待归还 3 -->
		  	<div role="tabpanel" class="tab-pane order-content" id="three">
		  		<?php if(count($threeOrders) > 0){foreach ($threeOrders as $key => $value) { ?>
			  		<div class="single-order">
			  			<div class="clearfix single-order-orderinfo">
			  				<div class="pull-left">订单号: <?php echo $value['borrowNumber'] ?></div>
			  				<div class="pull-right">创建时间: <?php echo date('Y-m-d H:i:s' , ($value['createTime']/1000)) ?></div>
			  			</div>
			  			<div class="single-order-bookinfo">
			  				<div>
			  					<img src="<?php echo IMAGE_URL . $value['bookImage'] ?>">
			  				</div>
			  				<div><?php echo $value['bookName'] ?></div>
			  				<div><?php echo $value['authorName'] ?></div>
			  				<div><?php echo $value['publisherName'] ?></div>
			  				<div><?php echo $value['ookNumber'] ?></div>
			  				<div>订单等待收货中</div>	
			  			</div>
			  			<div class="clearfix single-order-operate">
			  				<div class="pull-left">收货地址 :  苏州高新软件园</div>
			  				<a href="updateOrderState.php?orderId=<?php echo $value['orderId'] ?>&state=<?php echo $value['orderState'] ?>" class="btn btn-warning pull-right">归还图书</a>
			  			</div>
			  		</div>
			  	<?php }}else{ ?>
					<div class="empty-order-tip">您还没有当前订单记录~</div>
			  	<?php } ?>
		  	</div>
		  	<!-- 已完成 4 -->
		  	<div role="tabpanel" class="tab-pane order-content" id="four">
		  		<?php if(count($fourOrders) > 0){foreach ($fourOrders as $key => $value) { ?>
			  		<div class="single-order">
			  			<div class="clearfix single-order-orderinfo">
			  				<div class="pull-left">订单号: <?php echo $value['borrowNumber'] ?></div>
			  				<div class="pull-right">创建时间: <?php echo date('Y-m-d H:i:s' , ($value['createTime']/1000)) ?></div>
			  			</div>
			  			<div class="single-order-bookinfo">
			  				<div>
			  					<img src="<?php echo IMAGE_URL . $value['bookImage'] ?>">
			  				</div>
			  				<div><?php echo $value['bookName'] ?></div>
			  				<div><?php echo $value['authorName'] ?></div>
			  				<div><?php echo $value['publisherName'] ?></div>
			  				<div><?php echo $value['ookNumber'] ?></div>
			  				<div>订单等待收货中</div>	
			  			</div>
			  			<div class="clearfix single-order-operate">
			  				<div class="pull-left">收货地址 :  苏州高新软件园</div>
			  				<a href="list.php" class="btn btn-default pull-right continue-borrow-btn">继续借阅 >></a>
			  			</div>
			  		</div>
			  	<?php }}else{ ?>
					<div class="empty-order-tip">您还没有当前订单记录~</div>
			  	<?php } ?>
		  	</div>
		  	<!-- 已取消 0 -->
		  	<div role="tabpanel" class="tab-pane order-content" id="zero">
		  		<?php if(count($zeroOrders) > 0){foreach ($zeroOrders as $key => $value) { ?>
			  		<div class="single-order">
			  			<div class="clearfix single-order-orderinfo">
			  				<div class="pull-left">订单号: <?php echo $value['borrowNumber'] ?></div>
			  				<div class="pull-right">创建时间: <?php echo date('Y-m-d H:i:s' , ($value['createTime']/1000)) ?></div>
			  			</div>
			  			<div class="single-order-bookinfo">
			  				<div>
			  					<img src="<?php echo IMAGE_URL . $value['bookImage'] ?>">
			  				</div>
			  				<div><?php echo $value['bookName'] ?></div>
			  				<div><?php echo $value['authorName'] ?></div>
			  				<div><?php echo $value['publisherName'] ?></div>
			  				<div><?php echo $value['ookNumber'] ?></div>
			  				<div>订单等待收货中</div>	
			  			</div>
			  			<div class="clearfix single-order-operate">
			  				<div class="pull-left">收货地址 :  苏州高新软件园</div>
			  				<a href="list.php" class="btn btn-default pull-right continue-borrow-btn">继续借阅 >></a>
			  			</div>
			  		</div>
			  	<?php }}else{ ?>
					<div class="empty-order-tip">您还没有当前订单记录~</div>
			  	<?php } ?>
		  	</div>
	</div>
	</div>

	<?php 
		include_once('PHPAction/inc/footer.php'); 
	?>
	
</body>
<script src="./lib/js/jquery1.11.3.js"></script>
<script src="./lib/js/bootstrap.min.js"></script>


</html>