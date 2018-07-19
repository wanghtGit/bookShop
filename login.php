<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login</title>
</head>
<link rel="stylesheet" type="text/css" href="./lib/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./lib/css/normalize.css">
<link rel="stylesheet" type="text/css" href="./css/login.css">
<body>
	<?php 
		require_once('PHPAction/util/globalSettings.php');

	 ?>
	 <div class="container login-header">
	 	<img src="<?php echo IMAGE_URL . 'booklogo.jpg' ?>">
	 	<span class="welcome-title">欢迎注册</span>
	 	<ul class="login-header-links pull-right clearfix">
	 		<li><a href="#">关于我们</a></li>
	 		<li>|</li>
	 		<li><a href="#">联系我们</a></li>
	 		<li>|</li>
	 		<li><a href="#">广告服务</a></li>
	 		<li>|</li>
	 		<li><a href="#">销售联盟</a></li>
	 	</ul>
	 	<span class="go-back-btn">< 返回上一页</span>
	 </div>
	 <div class="login-content">
	 	<img src="<?php echo IMAGE_URL . 'loginbg2.jpg' ?>">
	 	<div class="login-form-outer container">
 			<div class="login-form">
		 		<div class="login-title">账户登录</div>
		 		<div class="input-group login-input">
					<span class="input-group-addon" id="basic-addon1">
				  		<span class="glyphicon glyphicon-user input-icon" aria-hidden="true"></span>
					</span>
					<input type="text" class="form-control" placeholder="请输入您的手机号码" aria-describedby="basic-addon1" id="userName" value="18205283656">
				</div>
				<div class="input-group login-input">
					<span class="input-group-addon" id="basic-addon1">
				  		<span class="glyphicon glyphicon-lock input-icon" aria-hidden="true"></span>
					</span>
					<input type="password" class="form-control" placeholder="请输入您的密码" aria-describedby="basic-addon1" id="password" value="3656">
				</div>
				<div class="login-err-tip">提示</div>
				<div class="forget-password">
					<a href="#">忘记密码?</a>
				</div>

				<button class="login-btn" type="button">登 录</button>
				
				<div class="other-login-way">
					<div class="other-login-way-content">
						<a href="#" title="QQ登录">
							<img src="<?php echo IMAGE_URL . 'tx.png' ?>" class="other-login-img"> QQ
						</a>
						<a href="#" title="微信登录">
							<img src="<?php echo IMAGE_URL . 'wx.png' ?>" class="other-login-img"> 微信
						</a>
						<a href="#" title="微博登录">
							<img src="<?php echo IMAGE_URL . 'wb.png' ?>" class="other-login-img" align="center"> 微博
						</a>
						<a href="#" class="go-regist">
							立即注册 >
						</a>
					</div>				
				</div>
		 	</div>	 		
	 	</div>
	 </div>
</body>
<script src="./lib/js/jquery1.11.3.js"></script>
<script type="text/javascript">
	$(function(){
		$('.login-btn').bind('click' , function(e){
			let userName = $('#userName').val();
			let password = $('#password').val();

			if(userName == '' || password == ''){
				$('.login-err-tip').css('display' , 'block');
				$('.login-err-tip').text('用户名或密码不能为空');
				return;
			}

			$.post('ajax/ajax-login.php?userName=' + userName + '&password=' + password).then(res => {
				if(res.code == 101){
					$('.login-err-tip').css('display' , 'block');
					$('.login-err-tip').text(res.message);
				}else if(res.code == 100){
					$('.login-err-tip').css('display' , 'none');
					location.href = document.referrer;
				}
			});
		});

		$('.go-back-btn').on('click' , function(){
			location.href = document.referrer;
		});
	});
</script>

</html>