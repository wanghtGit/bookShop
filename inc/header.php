<?php 
	session_start();
	require_once('PHPAction/util/globalSettings.php');
?>

<div class="header">
	<div class="container clearfix">
		<div class="pull-left header-left">
			欢迎来到 爱图书， <?php if(!array_key_exists('User', $_SESSION)){ ?><a href="login.php">请登录</a> <a href="#" class="header-regist">免费注册</a>
			<?php }else{ ?>
				<a href="#"><?php print_r($_SESSION['User'][0]['name']); ?></a> <a href="logout.php">注销</a>
			<?php } ?>
		</div>
		<ul class="pull-right clearfix header-menu">
			<li>我的订单</li>
			<li>|</li>
			<li>会员中心</li>
			<li>|</li>
			<li>移动端</li>
			<li>|</li>
			<li>客服服务</li>
		</ul>
	</div>
</div>
<div class="container clearfix tools">
	<!-- LOGO -->
	<div class="logo">
		<a href="index.php"><img src=<?php echo IMAGE_URL . 'booklogo.jpg'; ?> class="logo-img"></a>
	</div>
	<!-- 搜索 -->
	<div class="search">
	    <form method="get" action="list.php" class="input-group" id="inputGroup">
	      <input type="text" name="keywords" class="form-control" placeholder="请输入书名" value="<?php echo isset($keywords) ? $keywords : ''; ?>">
	      <span class="input-group-btn">
	        <button class="btn" id="searchBtn">查找</button>
	      </span>
	    </form>
	    <div class="hot-search">
	    	<strong>热门搜索：</strong>
	    	<span>三国演义</span>
	    	<span>论语</span>
	    </div>
	</div>
	<!-- 链接 -->
	<div class="links">
		<ul class="clearfix tools-link">
			<li class="link">
				<a href="order.php" class="my-order">
					<span class="glyphicon glyphicon-shopping-cart tools-link-icon" aria-hidden="true"></span>我的订单
				</a>
			</li>
			<li>|</li>
			<li class="link">
				<a href="bookshelf.php" class="my-bookshelf">
					<span class="glyphicon glyphicon-book tools-link-icon" aria-hidden="true"></span>借书架
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="nav">
	<!-- 菜单导航 -->
	<div class="container">
		<ul class="nav-content">
			<li><a href="index.php" id="nav-index">首页</a></li>
			<li><a href="list.php" id="nav-bookshop">图书商城</a></li>
			<li><a href="#" id="nav-bookinfo">商品简介</a></li>
		</ul>
	</div>
</div>

