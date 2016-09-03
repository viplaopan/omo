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

	<link rel="stylesheet" type="text/css" href="/Public/Home/css/housing.css">

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
	

	<div class="hous-main">
		<div class="main-top">
			<strong>您已发布的实时5房源</strong>
			<span>（实时：真实存在，且处于空置状态或明确告知开始空置时间）</span>
			<div class="filtrate clearfix">
				<div class="drop clearfix">
					<em>类型</em>
					<div class="dropdown clearfix">
						<span class="caret"></span>
						<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </button>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li>所有房源</li>
							<li>办公室</li>
							<li>会议室</li>
						</ul>
					</div>
				</div>
				<div class="drop clearfix">
					<em>状态</em>
					<div class="dropdown clearfix">
						<span class="caret"></span>
						<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </button>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li>所有房源</li>
							<li>审核中</li>
							<li>已完成</li>
						</ul>
					</div>
				</div>
				<div class="drop clearfix">
					<em>房源动态</em>
					<div class="dropdown clearfix">
						<span class="caret"></span>
						<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </button>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li>所有房源</li>
							<li>实时房源</li>
							<li>促销房源</li>
						</ul>
					</div>
				</div>
				<a class="addHous" href="<?php echo U('editPosition',array('rid'=>I('get.rid')));?>">新增房源</a>
			</div>
		</div>
		<div class="in-hous">
			<ul class="clearfix">
				<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 3 );++$i;?><li <?php if(($mod) == "0"): ?>class="first"<?php endif; ?>>
						<img src="<?php echo ($vo["imgPath"]); ?>">
						<div class="compile">
							<a class="editbtn" href="<?php echo U('editPosition',array('id'=>$vo['id']));?>">编辑</a>
							<button class="del" data-id='<?php echo ($vo["id"]); ?>'>删除</button>
						</div>
						<div class="li-down">
							<div class="btns">
								<button>编号：001</button>
								<button><?php echo ($vo["typeTitle"]); ?></button>
								<button>闲置中</button>
								<button><?php echo ($vo["promotionTitle"]); ?></button>
							</div>
							<div class="in-li">
								<span><?php echo ((isset($vo["monthTitle"]) && ($vo["monthTitle"] !== ""))?($vo["monthTitle"]):'暂无按月出租'); ?></span>
								<em><?php echo ((isset($vo["hourTitle"]) && ($vo["hourTitle"] !== ""))?($vo["hourTitle"]):'暂无小时出租'); ?></em>
							</div>
						</div>
					</li><?php endforeach; endif; else: echo "$empty" ;endif; ?>
				
				
			</ul>
		</div>
	</div>
	<div class="flipOver clearfix">
		<ul class="clearfix">
			<li>
				<a href="javascript:;"> 上一页</a>
			</li>
			<li class="current">
				<a href="javascript:;">1</a>
			</li>
			<li>
				<a href="javascript:;">2</a>
			</li>
			<li>
				<a href="javascript:;">3</a>
			</li>
			<li>
				<a href="javascript:;">4</a>
			</li>
			<li class="special">...</li>
			<li>
				<a href="javascript:;">80</a>
			</li>
			<li>
				<a href="javascript:;">下一页</a>
			</li>
		</ul>
		<span>共<em>80</em>页，到第<input type="text">页</span>
		<button>确定</button>
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
		$(function(){
			$('.del').click(function(){
				var id = $(this).attr('data-id');
				$.post('<?php echo U("del");?>', {id:id}, function(data) {
					if (data.status == 1) {
						window.location.href = '';
					}
				}, 'json');
			})
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