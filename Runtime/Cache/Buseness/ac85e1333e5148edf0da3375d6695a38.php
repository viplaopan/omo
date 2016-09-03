<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<?php $map['b.status'] = 1; $map['b.type'] = 1; $map['b.path'] = MODULE_NAME."/".CONTROLLER_NAME."/".ACTION_NAME; $advs = D("Adv")->join('__ADV_POS__ as b ON __ADV__.pos_id = b.id','LEFT')->where($map)->select(); $advlist = array(); foreach($advs as $v){ $advlist[$v['name']] = $v; } ?>
<meta charset="UTF-8">
<?php if(!$oneplus_seo_meta){ $oneplus_seo_meta = get_seo_meta($vars,$seo); } ?>
<?php if($oneplus_seo_meta['title']): ?><title><?php echo ($oneplus_seo_meta['title']); ?></title>
    <?php else: ?>
    <title><?php echo C('WEB_SITE_TITLE');?></title><?php endif; ?>
<?php if($oneplus_seo_meta['keywords']): ?><meta name="keywords" content="<?php echo ($oneplus_seo_meta['keywords']); ?>"/><?php endif; ?>
<?php if($oneplus_seo_meta['description']): ?><meta name="description" content="<?php echo ($oneplus_seo_meta['description']); ?>"/><?php endif; ?>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Public/Home/css/base.css">
<script type="text/javascript" src="/Public/Home/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/common.js"></script>
<script type="text/javascript" src="/Public/Home/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/Public/Home/css/landing.css">
	<script type="text/javascript" src="/Public/Home/js/jquery.validate.js"></script>
	<script type="text/javascript" src="/Public/Home/js/jquery.checkbox.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#remember').omoCheckbox();
		})
	</script>

<?php echo hook('pageHeader');?>

</head>
<body>
	<!-- 头部 -->
	<header>
	<div class="inHeader main clearfix">
		<h1>
			<a href="javascript:;"><img src="/Public/Home/images/logo.png" height="63" width="182"></a>
		</h1>
	</div>
</header>
<nav>

		<ul <?php if(in_array((ACTION_NAME), explode(',',"login,register"))): ?>style="display:none;"<?php endif; ?> class="clearfix main">
			<li class="current"><a href="<?php echo U('Building/lists');?>">总览</a></li>
			<li><a href="article.html">楼宇讯息</a></li>
			<li><a href="javascript:;">房源信息</a></li>
			<li><a href="javascript:;">实时&促销</a></li>
			<li><a href="javascript:;">专员与客服</a></li>
			<div class="in-nav-r">
				<span>消息</span><a class="unread" href="javascript:;">[ 2条未读 ]</a>|
				<a href="javascript:;" class="logout" data-url="<?php echo U('Buseness/User/logout');?>">退出</a>
			</div>
		</ul>

</nav>
<script type="text/javascript">
	$(function(){
		$(".logout").click(function(){
			var self = $(this);
			$.post(self.attr('data-url'),self.serialize(), success , "json");
			return false;

			function success(data){
                if(data.status == 1){
                	location.href="<?php echo U('Buseness/User/login');?>";  
                }else{
                	alert('未知错误');
                }
			}
			
		})
	})
</script>
	<!-- /头部 -->

	<!-- 主体 -->
	

	<div class="lading main">
		<h2>欢迎加入真我办公（OhMyOffice.COM）</h2>
		<h3>您与我们的合作将会打开一个全新的市场领域！</h3>
		<div class="inLading">
			<div class="ladingLeft">
				<form action="<?php echo U('User/login');?>" method="post">
					<h4>登陆</h4>
					<div class="name">
						<p>手机号 Mobile:<em style="color: #e20c0c;"></em> </p>
						<input name="username" type="text">

					</div>
					<div class="password">
						<p>密码 Password: <em style="color: #e20c0c;"></em></p>
						<input name="password" id="inputEmail" type="password">

					</div>
					<div class="remember clearfix">
						<input  id="remember" name="" label="同意注册协议" checked="checked" type="checkbox">
						<em>忘记密码？</em>
					</div>
					<p class="error"></p>
					<button type="submit">登 陆</button>
				</form>
			</div>
			<div class="ladingRight">
				<h4>注册</h4>
				<dl>
					<dt>为什么与我们合作？</dt>
					<dd>全球同步推广和全线推送为您带来更高品质的客户</dd>
					<dd>全新的智能技术应用与体验设计跟上时代趋势</dd>
					<dd>与客户直接对接保障主动权并有利提高销售效率</dd>
					<dd>与客户成功签单才收取服务费</dd>
					<dd>加入我们，你会发现更多… …</dd>
				</dl>
				<a href="<?php echo U('User/register');?>"><button>立即注册</button></a>
			</div>
		</div>
	</div>

	<!-- /主体 -->

	<!-- 底部 -->
	
<footer>
	<div class="inFooter main">
		<ul class="clearfix">
			<li>
				<a href="javascript:;">服务条款</a>
			</li>
			<li>
				<a href="javascript:;">分享奖励</a>
			</li>
			<li>
				<a href="javascript:;">联系我们</a>
			</li>
			<li>
				<a href="javascript:;">隐私权条例</a>
			</li>
			<li>
				<a href="javascript:;">加入我们</a>
			</li>
			<li>
				<a href="javascript:;">分享您的办公</a>
			</li>
		</ul>
		<p class="copy">2004-2012 Shanghai Suntech Computer Technology Co., Ltd. All Rights Reserved</p>
	</div>
</footer>

<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "", //当前网站地址
		"APP"    : "", //当前项目地址
		"PUBLIC" : "/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>


	<script type="text/javascript">

    	$(document)
	    	.ajaxStart(function(){
	    		$("button:submit").addClass("log-in").attr("disabled", true);
	    	})
	    	.ajaxStop(function(){
	    		$("button:submit").removeClass("log-in").attr("disabled", false);
	    	});
		$(function(){
			$("form").validate({
				focusInvalid: true,

				rules:{
					username:{
						required:true,
						minlength:5,
						maxlength:16,
					},
					password:{
						required:true,
					},

				},
				messages:{
					username:{
						required:"请输入正确的手机号!",
						minlength:"用户名不得低于6位!",
						maxlength:"用户名不得高于16位!",
					},
					password:{
						required:"请输入登录密码!",
					}
				},
				errorPlacement: function(error, element) { //错误信息位置设置方法
					error.appendTo( element.prev() ); //这里的element是录入数据的对象

				},
				debug: false,
				submitHandler: function(form) {
					var self = $("form");
					$.post(self.attr("action"), self.serialize(), success, "json");
					return false;

					function success(data){
						if (data.status == 1) {
							window.location.href = data.url;
						} else if(data.info=='密码错误！'){
							$('.password p em').text(data.info);
						} else if(data.info == '用户不存在或被禁用！') {
							$('.name p em').text(data.info);
						}
					}

				},
			});

		});


		$(function(){
			var verifyimg = $(".verifyimg").attr("src");
            $(".reloadverify").click(function(){
                if( verifyimg.indexOf('?')>0){
                    $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
            });
		});
		$(".check").click(function(){
			if ($(this).hasClass('selected')) {
				$('input[name="remember"]').val(0);
			} else {
				$('input[name="remember"]').val(1);
			}
		})
	</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>