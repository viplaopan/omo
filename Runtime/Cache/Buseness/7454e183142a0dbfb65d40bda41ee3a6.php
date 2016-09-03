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

	<link rel="stylesheet" type="text/css" href="/Public/Home/css/contactWay.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/uploadify.css">
	<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
	<script type="text/javascript" src="/Public/Home/js/jquery.checkbox.js"></script>
	
	
	
	<link href="/Public/static/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <link href="/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">
    <link href="/Public/Home/css/dropdown.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
	<script type="text/javascript" src="/Public/Home/js/jquery.validate.js"></script>
	
	
	<script type="text/javascript">
		$(function() {
			$('.checkbox').omoCheckbox();
			//会议室
			$('#typeDown .dropdown-menu li').click(function(){
				$v = $(this).attr('value');
				if($v == 4){
					$(".monthDiv").hide()
				}else{
					$(".monthDiv").show()
				}
			})
			$v = $("input[name='type']").attr('value');
			if($v == 4){
				$(".monthDiv").hide()
			}else{
				$(".monthDiv").show()
			}
		})
	</script>
	<style type="text/css">
		.proclass{display: none;}
	</style>

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
	

	<div class="contactWay main clearfix">
		<div class="contactLeft">
			<h2>添加房源</h2>
			<dl>
				<dt>有情有情提醒</dt>
				<dd>1、关闭的房源可重新发布，请勿重复发布统一房源</dd>
				<dd>2、新添房源完整填写后经审核后发布在平台上</dd>
				<dd>3、审核中的房源不影响“自我营销*”推广，但请注意真实性。</dd>
			</dl>
			<dl>
				<dt>关于发布与审核</dt>
				<dd>审核通过的房源信息在平台上可以被查询到，而未被审核通过只能自我营销在移动端朋友圈分享传播，而无法被查询并不被正式推荐在平台上。</dd>
			</dl>
			<dl>
				<dt>关于“自我营销”</dt>
				<dd>不管已经在平台上发布还是有待审核的信息，均可通过扫一扫对应的二维码生成移动端页面分享传播，且获得的浏览量均可积累称为平台优先推荐的考量之一。</dd>
			</dl>
		</div>
		<div class="contactCenter">
			<form action="/Buseness/Building/editPosition/id/10164.html" method="post">
				<ol>
					<li class="step">
						<div class="address">
							<div class="redact clearfix">
								<p id="typeError">类&nbsp;&nbsp;&nbsp;&nbsp;型<em>*</em></p>
								<div class="drop clearfix">
									<div class="dropdown clearfix" id="typeDown">
										<span class="caret"></span>
										<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo (get_res_type((isset($position['type']) && ($position['type'] !== ""))?($position['type']):"2")); ?></button>
										<input type="hidden" name="type" id="type" value="<?php echo ((isset($position["type"]) && ($position["type"] !== ""))?($position["type"]):'1'); ?>" />
										<ul class="dropdown-menu" aria-labelledby="dLabel">
											<?php if(is_array($typeList)): $i = 0; $__LIST__ = $typeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li value="<?php echo ($vo["type"]); ?>"><?php echo (get_res_type($vo["type"])); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="step clearfix">
						<p id="fyError" class="spec">房源动态<em>*</em><span> 可多选</span></p>
						<input class="checkbox" name="actual_time" label="实时房源" <?php if(($position['actual_time']) == "1"): ?>checked="checked"<?php endif; ?> type="checkbox">
						<input class="checkbox" name="promotion" label="促销房源" <?php if(($position['promotion']) == "1"): ?>checked="checked"<?php endif; ?> type="checkbox">
	
					</li>
					<li class="step">
						<div class="synthesis">
							<div class="addhous clearfix">
								<div class="redact in-min time proclass">
									<p>促销时间</p>
									<input type="text" class="time" name="start_time" value="<?php echo ($position["start_time"]); ?>" placeholder="开始时间">至
								</div>
								<div class="redact in-min time proclass">
									<p></p>
									<input type="text" class="time" name="end_time" value="<?php echo ($position["end_time"]); ?>" placeholder="结束时间">
								</div>
								<div class="redact in-min">
									<p>标准工位<em>*</em></p>
									<input name="workplace" type="text" value="<?php echo ($position["workplace"]); ?>">位
								</div>
								<div class="redact in-min">
									<p>可扩充至<em>*</em></p>
									<input name="addpace" type="text" value="<?php echo ($position["addpace"]); ?>">位
								</div>
								<div class="redact in-min monthDiv">
									<p id="error_month">按月收费<em>*</em></p>
									<input name="month" type="text" value="<?php echo ($position["month"]); ?>">元/月
								</div>
								<div class="redact in-min proclass monthDiv">
									<p>按月促销价格<em>*</em></p>
									<input name="mprom" type="text" value="<?php echo ($position["mprom"]); ?>">元/月
								</div>
								<div class="redact in-min">
									<p id="error_hour">按小时</p>
									<input name="hour" type="text" value="<?php echo ($position["hour"]); ?>">元/时
								</div>
								<div class="redact in-min proclass">
									<p>按小时促销价格</p>
									<input name="hprom" type="text" value="<?php echo ($position["hprom"]); ?>">元/月
								</div>
							</div>
							<div class="linkman clearfix">
								<p id="error_imgCount">添加房源照片<em>*</em></p>
								<span style="height: 17px;">
				推荐照片尺寸780X490像素，单张文件大小控制在1M以内。
			</span>
								<input type="text" style="width: 0; margin-top: -35px; height: 0; border: 0;" name="resourcesImagesCount" value="<?php echo (sizeof($outsides)); ?>">
								<input type="file" id="resourcesImages">
								<input type="hidden" name="imgCount" value="<?php echo (sizeof($pimgs)); ?>" />
							</div>
							<div class="clearfix" id="resourcesImagesInfo">
								<?php if(is_array($pimgs)): $k = 0; $__LIST__ = $pimgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="in-uploading <?php if(($k) == "1 "): ?>first<?php endif; ?>">
										<img src="<?php echo (grace_path($vo["path"],'Position')); ?>">
										<a class="delRimg" href="javascript:;">删除</a>
										<input type="hidden" name="resourcePosition[]" value="<?php echo ($vo["path"]); ?>">
									</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<script type="text/javascript">
								$(function() {
									//上传图片
									/* 初始化上传插件 */
									$("#resourcesImages").uploadify({
										"height": 35,
										"swf": "/Public/static/uploadify/uploadify.swf",
										"fileObjName": "download",
										"buttonText": "+上传图片",
										"uploader": "<?php echo U('File/uploadResourceImage',array('session_id'=>session_id(),'s'=>'PICTURE_POSITION'));?>",
										"width": 130,
										'removeTimeout': 1,
										'fileTypeExts': '*.jpg; *.png; *.gif;',
										"onUploadSuccess": uploadPicture,
										'onFallback': function() {
											alert('未检测到兼容版本的Flash.');
										}
									});
	
									function uploadPicture(file, data) {
										var data = $.parseJSON(data);
										var src = '';
										if(data.status) {
											src = data.url || '/Uploads/Resource/Position/' + data.savepath + data.savename;
											if($('#resourcesImagesInfo .in-uploading').length > 0) {
												var firstclass = '';
											} else {
												var firstclass = 'first';
											}
											var count = $("input[name='imgCount']").val();
											$("input[name='imgCount']").val(count + 1)
											$('#resourcesImagesInfo').append(
												'<div class="in-uploading ' + firstclass + '">' +
												'<img src="' + src + '">' +
												'<a class="delRimg" href="javascript:;">删除</a>' +
												'<input type="hidden" name="resourcePosition[]" value="' + data.savepath + data.savename + '" />' +
												'</div>'
											);
	
										} else {
											//报错
										}
									}
									$("#resourcesImagesInfo").on("click", ".delRimg", function() {
										$(this).parent().remove();
									});
								})
							</script>
							<div class="video">
								<button>+上传视频</button>
								<a href="javascript:;" class="upgrade">（需申请升级开通，点击申请）</a>
								<div class="in-video">
									<img src="/Public/Home/images/synthesis_ 02.jpg" height="200" width="265">
									<a href="javascript:;">删除</a>
								</div>
							</div>
							<input type="hidden" name="id" id="id" value="<?php echo ($position["id"]); ?>" />
							<button type="submit" class="next">保存房源</button>
						</div>
					</li>
				</ol>
			</form>
		</div>
		<div class="contactRight">
			<div class="contactBanner">
				<a href="javascript:;"></a>
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


	<script>
		$(document)
	    	.ajaxStart(function(){
	    		$("button:submit").attr("disabled", true);
	    	})
	    	.ajaxStop(function(){
	    		$("button:submit").attr("disabled", false);
	    	});
		$(function(){
			$('#typeDown .dropdown-menu li').click(function(){
				var value = $(this).attr('value');
				$("input[name='type']").val(value);
			})
			$("input[name='start_time']").datetimepicker({
                format: 'yyyy-mm-dd',
                language:"zh-CN",
                minView:3,
                autoclose:true
            });
            $("input[name='end_time']").datetimepicker({
                format: 'yyyy-mm-dd',
                language:"zh-CN",
                minView:3,
                autoclose:true
            });
            $("input[name= 'promotion']").change(function(){
            	if($(this).attr('checked') == 'checked'){
            		$('.proclass').show();
            		if($("input[name='type']").val() == 4){
            			$(".monthDiv").hide()
            		}
            	}else{
            		$('.proclass').hide();
            	}
            })
            if($("input[name= 'promotion']").attr('checked') == 'checked'){
        		$('.proclass').show();
        		if($("input[name='type']").val() == 4){
        			$(".monthDiv").hide()
        		}
        	}else{
        		$('.proclass').hide();
        	}
		})
		$("form").validate({
			rules: {
				imgCount: {
					min:1,
				},
				month:{  
	                required: {  
	                    depends:function(){ //二选一  
	                        return ($('input[name=hour]').val().length == 0 && $('input[name=month]').val().length == 0);  
	                    }  
	                }  
	            },  
	            hour:{  
	                required: {  
	                    depends:function(){ //二选一  
	                        return ($('input[name=hour]').val().length == 0 && $('input[name=month]').val().length == 0);  
	                    }  
	                }  
	            }  
			},
			messages: {
				imgCount: {
					min:'你必须上传3张以上图片',
				},
				month:"二选一",  
            	hour:"二选一"  
			},

			errorPlacement: function(error, element) { //错误信息位置设置方法
				var errorId = $(element).attr('name');
				
				error.appendTo( $("#error_" + errorId) );
			},
			debug: false,
			submitHandler: function(form) {
				$("button:submit").attr("disabled", true);
				var ajaxUrl = $('form').attr('action');
				$.post(ajaxUrl, $('form').serialize(), function(data) {
					if (data.status == 1) {
						window.location.href = data.url;
					}
					$("button:submit").attr("disabled", false);
				}, 'json');
				return false;
			}
		});

	</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>