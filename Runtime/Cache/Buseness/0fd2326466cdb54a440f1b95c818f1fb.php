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
    <script type="text/javascript" src="/Public/Home/js/contactWay.js"></script>
    <script type="text/javascript" src="/Public/Home/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/Public/Home/js/building.js"></script>
    <script type="text/javascript" src="/Public/Home/js/jquery.checkbox.js"></script>

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
            <h2>添加/编辑楼宇信息</h2>
            <ul>
                <li class="<?php if(($_GET['step']) == "1"): ?>current<?php endif; ?> finish"><a href="<?php echo U('index',array('step'=>1,'id'=>I('get.id')));?>">位于哪里</a></li>
                <li class="<?php if(($_GET['step']) == "2"): ?>current<?php endif; ?> <?php if(($step) >= "1"): ?>finish<?php endif; ?>"><a href="<?php if(($step) >= "1"): echo U('index',array('step'=>2,'id'=>I('get.id'))); else: ?>javascript:;<?php endif; ?>">什么类型？</a></li>
                <li class="<?php if(($_GET['step']) == "3"): ?>current<?php endif; ?> <?php if(($step) >= "2"): ?>finish<?php endif; ?>"><a href="<?php if(($step) >= "2"): echo U('index',array('step'=>3,'id'=>I('get.id'))); else: ?>javascript:;<?php endif; ?>">综合描述</a></li>
                <li class="<?php if(($_GET['step']) == "4"): ?>current<?php endif; ?> <?php if(($step) >= "3"): ?>finish<?php endif; ?>"><a href="<?php if(($step) >= "3"): echo U('index',array('step'=>4,'id'=>I('get.id'))); else: ?>javascript:;<?php endif; ?>">详细描述</a></li>
                <li class="<?php if(($_GET['step']) == "5"): ?>current<?php endif; ?> <?php if(($step) >= "4"): ?>finish<?php endif; ?>"><a href="<?php if(($step) >= "4"): echo U('index',array('step'=>5,'id'=>I('get.id'))); else: ?>javascript:;<?php endif; ?>">联系方式</a></li>
            </ul>
        </div>
        <div class="contactCenter">
            <ol>
            	<?php if(($_GET['step']== '1') OR ($_GET['step']== '')): ?><li class="step">
	                	<form action="<?php echo U('step',array('s'=>1));?>" method="post" id="step1">
	                    	<script type="text/javascript" src="/Public/Home/js/jquery.actual.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.cityselect.js"></script>

<script type="text/javascript">
	//城市验证
	$(function() {
		var cityjson = jQuery.parseJSON('<?php echo ($city); ?>');
		var areajson = jQuery.parseJSON('<?php echo ($area); ?>');
		var tradingjson = jQuery.parseJSON('<?php echo ($trading); ?>');

		$("#address").citySelect({
			city_json: cityjson,
			area_json: areajson,
			trading_json: tradingjson,
		});
	})
</script>
<script>
	
</script>
<div class="address">
	<div class="redact">
		<p>国&nbsp;&nbsp;&nbsp;&nbsp;家<em>*</em></p>
		<span>暂时未开通其它国家</span>
		<i>中国</i>
	</div>
	<div class="redact clearfix" id="address">
		<p>城&nbsp;&nbsp;&nbsp;&nbsp;市<em id="errmsg">*</em></p>

		<div class="drop clearfix" id="city">
			<div class="dropdown clearfix">
				<span class="caret"></span>
				<button id="dLabel" type="button" data-toggle="dropdown">
                                    	<b class="labeli"></b>市
                                    </button>
				<input type="text" name="city" value="<?php echo ($info["city"]); ?>" />
				<ul class="dropdown-menu" aria-labelledby="dLabel">

				</ul>
			</div>
		</div>
		<div class="drop clearfix" id="area">
			<div class="dropdown clearfix">
				<span class="caret"></span>
				<button id="areaLabel" type="button" data-toggle="dropdown">
                                    	区
                                    </button>
				<input type="text" name="area" value="<?php echo ($info["area"]); ?>" />
				<div class="district dropdown-menu">
		                              	<div class="inDistrict">
						<ul class="dropdown-menu-ul" aria-labelledby="areaLabel">
							<li value="0">请选择</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="drop clearfix" id="trading">
			<div class="dropdown clearfix">
				<span class="caret"></span>
				<button id="tradingLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">商圈</button>
				<input type="text" name="trading" value="<?php echo ($info["trading_area"]); ?>" />
				<ul class="dropdown-menu" aria-labelledby="tradingLabel">

				</ul>
			</div>
		</div>
	</div>
	<div class="redact">
		<p>地&nbsp;&nbsp;&nbsp;&nbsp;址（例：XX路XX号）<em id="huang">*</em></p>
		<input name="address" value="<?php echo ($info["address"]); ?>" type="text">
	</div>
	<div class="redact">
		<p>楼宇名称<em id="hao">*</em></p>
		<input name="title" value="<?php echo ($info["title"]); ?>" type="text">
	</div>
	<div class="redact zip">
		<p>邮&nbsp;&nbsp;&nbsp;&nbsp;编</p>
		<input name="postcode" value="<?php echo ($info["postcode"]); ?>" type="text">
	</div>
	<button type="submit" class="next">保存并下一步</button>
</div>
	                    	<input type="hidden" name="id" value="<?php echo I('get.id');?>">
	                   </form>
	                </li><?php endif; ?>
                
                <?php if(($_GET['step']) == "2"): ?><li class="step">
	                	<form action="<?php echo U('Building/step',array('s' =>2));?>" method="post" id="step2">
	                    	<script>
	$(function(){
		$('.typeTitle').omoCheckbox();
		
	})
</script>
<div class="type">
	<div class="serve">
		
		    <div class="titleTig">
		    	<input class="typeTitle" type="checkbox" <?php if(empty($typeinfo)): ?>checked="checked"<?php endif; ?> <?php if(!empty($type1)): ?>checked="checked"<?php endif; ?> value="1" name="type[]" label='服务式办公' />
		    </div>

	</div>
	<div class="serve">
		
		<div class="titleTig">
	    	<input class="typeTitle" type="checkbox" <?php if(!empty($type2)): ?>checked="checked"<?php endif; ?> value="2" name="type[]" label='联合办公' />
	   </div>

	</div>
	<div class="serve">
		
		<div class="titleTig">
	    	<input class="typeTitle" type="checkbox" <?php if(!empty($type3)): ?>checked="checked"<?php endif; ?> value="3" name="type[]" label='传统办公' />
	   </div>
		
	</div>
	<div class="serve">
		
			<div class="titleTig">
		    	<input class="typeTitle" type="checkbox" <?php if(!empty($type4)): ?>checked="checked"<?php endif; ?> value="4" name="type[]" label='会议室（会场）' />
		    </div>
		
	</div>
	<div class="serve">
		
		    <div class="titleTig">
		    	<input class="typeTitle" type="checkbox" <?php if(!empty($type5)): ?>checked="checked"<?php endif; ?> value="5" name="type[]" label='门面店铺类' />
		    </div>
		
	</div>
	<div class="serve">
		
		<div class="titleTig">
		    	<input class="typeTitle" type="checkbox" <?php if(!empty($type6)): ?>checked="checked"<?php endif; ?> value="6" name="type[]" label='分享闲置办公位' />
		</div>
		
	</div>
	<input type="hidden" name="id" id="id" value="<?php echo I('get.id');?>">
	<button type="submit" ajax-url="<?php echo U('Building/step',array('s' =>2));?>" class="next">保存并下一步</button>
</div>

	                    	
	                    </form>
	                </li><?php endif; ?>
                <?php if(($_GET['step']) == "3"): ?><li class="step">
	                	<form action="<?php echo U('step',array('s'=>3));?>" method="post" id="step3">
	                    	
	<link href="/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/uploadify.css">
	<link href="/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
	<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>

<script type="text/javascript">
	$(function() {
		$("#step3").submit(function() {
				return false;
			})
			//step1
		$("#step3").validate({
			rules: {

				desc: {
					required: true,
					maxlength:100
				},
				serNum: {
					min: 2,
				},
				resourcesImagesCount: {
					min: 1,
				},
				resInsideImagesCount: {
					min: 1,
				},
			},
			messages: {
				build_time: {
					required: "必填!",
				},
				desc: {
					required: "必填!",
					maxlength: "100字以内"
				},
				serNum: {
					min: "至少选择2项服务设施！",
				},
				resourcesImagesCount: {
					min: "必需添加楼宇照片！",
				},
				resInsideImagesCount: {
					min: "必需添加内部照片！",
				},
			},
			errorPlacement: function(error, element) { //错误信息位置设置方法
				var name = element.attr('name');
				error.appendTo($('#error_' + name));
			},
			debug: false,
			submitHandler: function(form) {

				var ajaxUrl = $('#step3').attr('action');
				$.post(ajaxUrl, $('#step3').serialize(), function(data) {
					if (data.status == 1) {
						window.location.href = data.url;
					}
				}, 'json');
			}
		});
		$('.build_time').datetimepicker({
			startView: 'decade',
			format: 'yyyy',
			language: "zh-CN",
			minView: 'decade',
			autoclose: true
		});

	})
</script>
<div class="synthesis">
	<div class="redact short">
		<p id='error_build_time'>楼宇的建成时间<em>*</em></p>
		<input type="text" name="build_time" class="build_time" value="<?php echo ($resources["build_time"]); ?>">年
	</div>
	<div class="redact wh">
		<p id="error_desc">简洁扼要的描述楼宇特点（100字内）<em>*</em></p>
		<span>例如：地铁上盖甲级写字楼，市中心CBD区域，核心金融圈，毗邻黄浦江滨江公园</span>
		<textarea name="desc"><?php echo ($resources["desc"]); ?></textarea>
	</div>

	<div class="linkman clearfix">
		<p id="error_resourcesImagesCount">添加图片信息<em>*</em></p>
		<span style="height: 45px;">
			建议第一张为楼宇照片，推荐照片尺寸为700×500像素，单张照片大小控制在1M以内，最少添加3张图片。
		</span>
		<input type="text" style="width: 0; margin-top: -35px; height: 0; border: 0;" name="resourcesImagesCount" value="<?php echo (sizeof($outsides)); ?>">
		<input type="file" id="resourcesImages">
	</div>
	<div class="clearfix" id="resourcesImagesInfo">
		<?php if(is_array($outsides)): $k = 0; $__LIST__ = $outsides;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="in-uploading <?php if(($k) == "1"): ?>first<?php endif; ?>">
				<img src="<?php echo (grace_path($vo["path"],'Outside')); ?>">
				<a class="delRimg" href="javascript:;">删除</a>
				<input type="hidden" name="resourceOutside[]" value="<?php echo ($vo["path"]); ?>">
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
				"uploader": "<?php echo U('File/uploadResourceImage',array('session_id'=>session_id(),'s'=>'PICTURE_RESOURCE'));?>",
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
				if (data.status) {
					var rint = Number($("input[name='resourcesImagesCount']").val()) + 1;

                    if(rint > 8){
                    	$("#error_resourcesImagesCount").html('添加图片信息<em>*</em><label for="resourcesImagesCount" class="error">楼宇图片最多添加8张！</label>')
                    	return false;
                    }
                    $("input[name='resourcesImagesCount']").val(rint)
					//改变验证状态valid();
					$("#step3").valid();

					src = data.url || '/Uploads/Resource/Outside/' + data.savepath + data.savename;
		
					if((rint - 1)%4 == 0){
						var firstclass ='first';
					} else {
						var firstclass = '';
					}
					

					$('#resourcesImagesInfo').append(
						'<div class="in-uploading ' + firstclass + '">' +
						'<img src="' + src + '">' +
						'<a class="delRimg" href="javascript:;">删除</a>' +
						'<input type="hidden" name="resourceOutside[]" value="' + data.savepath + data.savename + '" />' +
						'</div>'
					);

				} else {
					//报错
				}
			}
			$("#resourcesImagesInfo").on("click", ".delRimg", function() {
				var rint = Number($("input[name='resourcesImagesCount']").val()) - 1;
				$("input[name='resourcesImagesCount']").val(rint)
				$(this).parent().remove();
			});
		})
	</script>

	<!--<div class="linkman clearfix">
		<p id="error_resInsideImagesCount">添加内部照片<em>*</em></p>
		<span>请上传至少8张室内空间的照片，请不要包含水印及品牌，电话等信息，否则我们将不给予审核通过。推荐照片尺寸780X490像素，单张文件大小控制在1M以内。</span>
		<input type="text" style="width: 0; margin-top: -35px; height: 0; border: 0;" name="resInsideImagesCount" value="<?php echo (sizeof($insides)); ?>">
		<input type="file" id="resInsideImages">
	</div>-->

	<!--<div class="clearfix" id="resInsideImagesInfo">
		<?php if(is_array($insides)): $k = 0; $__LIST__ = $insides;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="in-uploading <?php if(($k) == "1"): ?>first<?php endif; ?>">
				<img src="<?php echo (grace_path($vo["path"],'Inside')); ?>">
				<a class="delRimg" href="javascript:;">删除</a>
				<input type="hidden" name="resourceInside[]" value="<?php echo ($vo["path"]); ?>">
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<script type="text/javascript">
		$(function() {
			//上传图片
			/* 初始化上传插件 */
			$("#resInsideImages").uploadify({
				"height": 35,
				"swf": "/Public/static/uploadify/uploadify.swf",
				"fileObjName": "download",
				"buttonText": "+上传图片",
				"uploader": "<?php echo U('File/uploadResourceImage',array('session_id'=>session_id(),'s'=>'PICTURE_RESOURCE_INSIDE'));?>",
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
				if (data.status) {
					var rint = $("input[name='resInsideImagesCount']").val() + 1;
					$("input[name='resInsideImagesCount']").val(rint)

					//改变验证状态valid();
					$("#step3").valid();

					src = data.url || '/Uploads/Resource/Inside/' + data.savepath + data.savename;
					if ($('#resInsideImagesInfo .in-uploading').length > 0) {
						var firstclass = '';
					} else {
						var firstclass = 'first';
					}

					$('#resInsideImagesInfo').append(
						'<div class="in-uploading ' + firstclass + '">' +
						'<img src="' + src + '">' +
						'<a class="delRimg" href="javascript:;">删除</a>' +
						'<input type="hidden" name="resourceInside[]" value="' + data.savepath + data.savename + '" />' +
						'</div>'
					);

				} else {
					//报错
				}
			}
			$("#resInsideImagesInfo").on("click", ".delRimg", function() {
				$(this).parent().remove();
			});
		})
	</script>-->

	<div class="video clearfix">
		<input type="file" id="resourcesVadio">
		<a href="javascript:;" class="upgrade">（需申请升级开通，点击申请）</a>
		<div class="videos">
			<?php if(!empty($resources['vadio'])): ?><div class="in-video">
				  <video src="<?php echo ($resources["vadio"]); ?>" style="width: 264px;" controls>您的浏览器不支持 video 标签。</video>
				  <a href="javascript:;" class="delRimg">删除</a>
				  <input type="hidden" name="vadio" value="<?php echo ($resources["vadio"]); ?>">
				</div><?php endif; ?>
		</div>
	</div>
	<script type="text/javascript">
		$(function() {
			//上传图片
			/* 初始化上传插件 */
			$("#resourcesVadio").uploadify({
				"height": 35,
				"swf": "/Public/static/uploadify/uploadify.swf",
				"fileObjName": "download",
				"buttonText": "+上传视频",
				"uploader": "<?php echo U('File/uploadResourceVadio',array('session_id'=>session_id(),'s'=>'PICTURE_RESOURCE'));?>",
				"width": 130,
				'removeTimeout': 1,
				'fileTypeExts': '*.mp4; *.flv;',
				"onUploadSuccess": uploadPicture,
				'onFallback': function() {
					alert('未检测到兼容版本的Flash.');
				}
			});

			function uploadPicture(file, data) {
				var data = $.parseJSON(data);
				var src = data.url || '/Uploads/Resource/Inside/' + data.savepath + data.savename;

				if (data.status) {
					$('.videos').append(
						'<div class="in-video">' +
						'<video src="' + src + '" style="width: 264px;" controls="controls">' +
						'您的浏览器不支持 video 标签。' +
						'</video>' +
						'<a href="javascript:;" class="delRimg">删除</a>' +
						'<input type="hidden" name="vadio" value="' + data.savepath + data.savename + '" />' +
						'</div>'
					);
				} else {
					//报错
				}
			}
			$(".video").on("click", ".delRimg", function() {
				$(this).parent().remove();
			});
			$('.service').omoCheckbox();
			$('.service').change(function() {
				var sernum = $("input[class='service'][checked='checked']").length;
				$("input[name='serNum']").val(sernum);

				$("input[name='serNum']").blur()
			})
		})
	</script>

	<!--<div class="redact wh">
		<p>更多详细介绍下您提供的办公空间</p>
		<span>字数在360以内，请勿包含电话，品牌等讯息，否则审核将不给予通过。</span>
		<textarea name="more_desc"><?php echo ($resources["more_desc"]); ?></textarea>
	</div>-->
	<div class="redact short clearfix">
		<p id="error_serNum">服务设施<em>*</em></p>
		<span>至少选择2项</span>
		<?php if(is_array($services)): $k = 0; $__LIST__ = $services;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><input class="service" type="checkbox" <?php if(($rservice[$vo['id']]) == "1"): ?>checked="checked"<?php endif; ?> value="<?php echo ($vo["id"]); ?>" name="service[]" label='<?php echo ($vo["title"]); ?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
		<!--记录选中服务设施多少个-->
		<input type="text" value="<?php echo (sizeof($rservice)); ?>" name="serNum" style="height: 0; width: 0; display: none;" />
	</div>
	<button type="submit" class="next">保存并下一步</button>
</div>
	                    	<input type="hidden" name="id" value="<?php echo I('get.id');?>">
	                    </form>
	        
	                </li><?php endif; ?>
                <?php if(($_GET['step']) == "4"): ?><li class="step">
	                    <form action="<?php echo U('step',array('s'=>4));?>" method="post" id="step4">
	                    	<script type="text/javascript">
	$(function(){
		$("#step4").submit(function(){
			return false;
		})
		//step1
		$("#step4").validate({
			rules: {
				traffic_desc: {
					required: true,
					maxlength:300,
				},
				metro: {
					required: true,
				},
				metro_dist: {
					required: true,
					digits:true,
				},
				train: {
					required: true,
				},
				train_dist: {
					required: true,
					digits:true,
				},
				airport: {
					required: true,
				},
				airport_dist: {
					required: true,
					digits:true,
				}
			},
			messages: {
				traffic_desc: {
					required: "必填!",
					maxlength:"300个字以内 ",
				},
				metro: {
					required: "必填!",
				},
				metro_dist: {
					required: "必填!",
					digits: "只能输入整数!",
				},
				train: {
					required: "必填!",
				},
				train_dist: {
					required: "必填!",
					digits: "只能输入整数!",
				},
				airport: {
					required: "必填!",
				},
				airport_dist: {
					required: "必填!",
					digits: "只能输入整数!",
				}
			},
			errorPlacement: function(error, element) { //错误信息位置设置方法
				var name = element.attr('name');
				error.appendTo($('#error_' + name));
			},
			debug: false,
			submitHandler: function(form) {
				
				var ajaxUrl = $('#step4').attr('action');
				$.post(ajaxUrl, $('#step4').serialize(), function(data) {
					if (data.status == 1) {
						window.location.href = data.url;
					}
				}, 'json');
			}
		});
	})
</script>
<div class="minute clearfix">
	<div class="redact wh">
		<p id="error_traffic_desc">更详细的描述<em>*</em></p>
		<span>更详细的描述周边等讯息，有利于吸引更多伙伴，包括周边交通，住宿，商务服务支持等。300字内</span>
		<textarea name="traffic_desc"><?php echo ($traffic["traffic_desc"]); ?></textarea>
	</div>
	<div class="redact">
		<p>交通位置描述<em>*</em></p>
		<span>请详细真实描述交通距离位置等信息，如果是你们的优势的话。</span>
	</div>
	<div class="redact in-min">
		<p id="error_metro">轨道交通（站点名）<em>*</em></p>
		<input type="text" name="metro" value="<?php echo ($traffic["metro"]); ?>">
	</div>
	<div class="redact in-min">
		<p id="error_metro_dist">距离（米）：<em>*</em></p>
		<input type="text" name="metro_dist" value="<?php echo ($traffic["metro_dist"]); ?>">
	</div>
	<div class="redact in-min">
		<p id="error_train">火车站<em>*</em></p>
		<input type="text" name="train" value="<?php echo ($traffic["train"]); ?>">
	</div>
	<div class="redact in-min">
		<p id="error_train_dist">距离（米）：<em>*</em></p>
		<input type="text" name="train_dist" value="<?php echo ($traffic["train_dist"]); ?>">
	</div>
	<div class="redact in-min">
		<p id="error_airport">机场<em>*</em></p>
		<input type="text" name="airport" value="<?php echo ($traffic["airport"]); ?>">
	</div>
	<div class="redact in-min">
		<p id="error_airport_dist">距离（米）：<em>*</em></p>
		<input type="text" name="airport_dist" value="<?php echo ($traffic["airport_dist"]); ?>">
	</div>
	<button type="submit" class="next">保存并下一步</button>
</div>
	                    	<input type="hidden" name="id" id="id" value="<?php echo I('get.id');?>">
	                    </form>
	                    
	                </li><?php endif; ?>
                <?php if(($_GET['step']) == "5"): ?><li class="step">
	                    
	                    	<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/uploadify.css">
<script type="text/javascript">
	$(function(){

		$("#step5").submit(function(){
			return false;
		})
		$("#contactsForm").submit(function(){

			return false;
		})
		//step1
		$("#step5").validate({
			rules: {
				company: {
					required: true,
				},
				website: {
					required: true,
				},
				contacts_count: {
					min: 1,
				},
				agree: {
					required: true,
				},
			},
			messages: {
				company: {
					required: "必填!",
				},
				website: {
					required: "必填!",
				},
				contacts_count: {
					min: "必须添加联系人！",
				},
				agree: {
					required: "必须用意真我办公的合作协议",
				},
			},
			errorPlacement: function(error, element) { //错误信息位置设置方法
				var name = element.attr('name');
				error.appendTo($('#error_' + name));
			},
			debug: false,
			submitHandler: function(form) {
				
				var ajaxUrl = $('#step5').attr('action');
				$.post(ajaxUrl, $('#step5').serialize(), function(data) {
					if (data.status == 1) {
						window.location.href = data.url;
					}
				}, 'json');
			}
		});
		$("#contactsForm").validate({
			rules: {
				chinese_name: {
					required: true,
				},
				english_name: {
					required: true,
				},
				sex: {
					required: true,
				},
				email: {
					required: true,
					checkEmail:true,
				},
				mobile: {
					required: true,
					checkMobile:true,
				},
				tel: {
					required: true,
				},
			},
			messages: {
				chinese_name: {
					required: "中文名必须填写!",
				},
				english_name: {
					required: "英文名必须填写!",
				},
				sex: {
					required: "必须选择性别!",
				},
				email: {
					required: "邮箱必须填写!",
					checkEmail:"请填写正确的邮箱地址!",
				},
				mobile: {
					required: "手机必须填写!",
					checkMobile:"请填写正确的手机号！"
				},
				tel: {
					required: "座机号必须填写!",
				},
			},
			errorPlacement: function(error, element) { //错误信息位置设置方法
				$('#contacts_error').html('')
				error.appendTo($('#contacts_error'));
			},
			debug: false,
			submitHandler: function(form) {
	
				$obj = $('#contactsForm');
				var ajaxUrl = $obj.attr('action');

				$.post(ajaxUrl, $obj.serialize(), function(data) {
					alert(data)
					if (data.status == 1) {
						$('#contentForm').hide()
						$("#contentList").show()
						if(data.isEdit == 1){
							var cnum = $("input[name='contacts_count']").val();
							$("input[name='contacts_count']").val(cnum + 1)
							var chinese_name = $("input[name='chinese_name']").val();
							var english_name = $("input[name='english_name']").val();
							var email = $("input[name='email']").val();
							var mobile = $("input[name='mobile']").val();
							$("#contentList ul #rlist" + data.id).html('')
							$("#contentList ul #rlist" + data.id).prepend(
	                   		'<div class="check "><input class="agree" data-id="10247" type="checkbox" value="" name="agree" label="潘" style="display: none;"><label for="checkboxFiveInput"></label><span>' +chinese_name+ '</span></div>'  + 
		    				'<span>' + english_name + '</span>' + 
		    				'<em>' + mobile + '</em>' + 
		    				'<strong>' +email+ '</strong>' + 
		    				'<div class="icons clearfix">' + 
			        				'<button type="button" class="icon-compile btn-primary contentEdit" data-id="10247"></button>' + 
			        				'<a href="javascript:;" data-id="" class="icon-delete"></a>' + 
			        			'</div>');
						}else{
							var cnum = $("input[name='contacts_count']").val();
							$("input[name='contacts_count']").val(cnum + 1)
							var chinese_name = $("input[name='chinese_name']").val();
							var english_name = $("input[name='english_name']").val();
							var email = $("input[name='email']").val();
							var mobile = $("input[name='mobile']").val();
							$("#contentList ul").prepend('<li>' + 
	                   		'<div class="check "><input class="agree" data-id="10247" type="checkbox" value="" name="agree" label="潘" style="display: none;"><label for="checkboxFiveInput"></label><span>' +chinese_name+ '</span></div>'  + 
		    				'<span>' + english_name + '</span>' + 
		    				'<em>' + mobile + '</em>' + 
		    				'<strong>' +email+ '</strong>' + 
		    				'<div class="icons clearfix">' + 
			        				'<button type="button" class="icon-compile btn-primary contentEdit" data-id="10247"></button>' + 
			        				'<a href="javascript:;" data-id="" class="icon-delete"></a>' + 
			        			'</div>' + 
	                        '</li>');
						}
					}
				}, 'json');
			}
		});
		//判断手机号码
		 jQuery.validator.addMethod( "checkMobile",function(value,element){       
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
            if(!myreg.test(value)) 
            { 
                return false; 
            }else{
                 return true;
             }
        } ,  "您手机号码错误"); 
		//判断邮箱
		 jQuery.validator.addMethod( "checkEmail",function(value,element){       
            var myreg = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/; 
            if(!myreg.test(value)) 
            { 
                return false; 
            }else{
                 return true;
             }
        } ,  "您手机号码错误"); 
		
		//性别选择
		$("#sex ul li").click(function(){
			var val = $(this).attr('value');
			$("input[name='sex']").val(val);
		})
		//打开联系人模态框
    	$("#myModal").on('shown.bs.modal', function (e) {
    		var dt = $(e.relatedTarget).attr('data-type');
			$("#contentList input[name='type']").val(dt);
			$('#contentForm').hide()
			$("#contentList").show()
		})
		//删除事件
		$(document).on("click",".icon-delete",function(){
			var id = $(this).attr('data-id');
			$.post("<?php echo U('delContacts');?>", {id:id})
			$(this).parent().parent().fadeOut(350);
		})
		//编辑事件
		$(document).on("click",".edit-btn",function(){
			//判断联系人类型
			var dt = $(this).attr('data-type');
			$("input[name='type']").val(dt);
			var id = $(this).attr('data-id');
			$.post("<?php echo U('editContacts');?>", {id:id,type:dt}, function(data) {
				
				$("input[name='chinese_name']").val(data.chinese_name);
				$("input[name='english_name']").val(data.english_name);
				var sexes = new Array();
				    sexes[1] = '男';
				    sexes[0] = '女';
				$("#sexLabel").html(sexes[data.sex]);
				$("input[name='sex']").val(data.sex);
				$("input[name='cid']").val(data.id);
				$("input[name='email']").val(data.email);
				$("input[name='mobile']").val(data.mobile);
				$("input[name='tel']").val(data.tel);
				$("input[name='type']").val(data.type);
				//赋值头像
				if(data.head){
					src = '/Uploads/Head/' + data.head;
			    	$("input[name='head']").val(data.head)
			        $('#headimageDiv img').attr('src',src);
				}else{
					var defaultHead = '/Public/Home/images/uploading_img.jpg';
					$("input[name='head']").val('')
					$('#headimageDiv img').attr('src',defaultHead);
				}
				
			})
			
		})
		//编辑事件
		$(document).on("click",".contentEdit",function(){
			$('#contentForm').show()
			$("#contentList").hide()
			//判断联系人类型
			var id = $(this).attr('data-id');
		
			$.post("<?php echo U('editContacts');?>", {id:id}, function(data) {
				
				$("input[name='chinese_name']").val(data.chinese_name);
				$("input[name='english_name']").val(data.english_name);
				var sexes = new Array();
				    sexes[1] = '男';
				    sexes[0] = '女';
				$("#sexLabel").html(sexes[data.sex]);
				$("input[name='sex']").val(data.sex);
				$("#contentForm input[name='id']").val(data.id);
				$("input[name='email']").val(data.email);
				$("input[name='mobile']").val(data.mobile);
				$("input[name='tel']").val(data.tel);
				$("input[name='type']").val(data.type);
				//赋值头像
				if(data.head){
					src = '/Uploads/Head/' + data.head;
			    	$("input[name='head']").val(data.head)
			        $('#headimageDiv img').attr('src',src);
				}else{
					var defaultHead = '/Public/Home/images/uploading_img.jpg';
					$("input[name='head']").val('')
					$('#headimageDiv img').attr('src',defaultHead);
				}
				
			})
			
		})
		//删除头像
		$(document).on("click","#delHead",function(){
			var defaultHead = '/Public/Home/images/uploading_img.jpg';
			$("input[name='head']").val('')
			$('#headimageDiv img').attr('src',defaultHead);
		})
	})
</script>
<script type="text/javascript">
	$(function(){
		$('.agree').omoCheckbox();
	})
</script>
<form action="<?php echo U('step',array('s'=>5));?>" method="post" id="step5">
	<div class="inContact">
		<div class="redact">
			<p id="error_company">您公司名<em>*</em></p>
			<input type="text" name="company" value="<?php echo ($resources["company"]); ?>">
		</div>
		<div class="redact">
			<p id="error_website">网址<em>*</em></p>
			<input type="text" name="website" value="<?php echo ($resources["website"]); ?>">
		</div>
		<div class="linkman">
			<p id="error_contacts_count">首选商务销售联系人<em>*</em></p>
			<span>对接客户</span>
			<button type="button" class="icon-compile btn-primary contacts" data-backdrop='static' data-toggle="modal" data-target="#myModal" data-type='1'>+增加联系人</button>
			<div style="height: 0px; overflow: hidden;position: relative;">
				<input type="text" width="0" height="0" style="width: 0px; height: 0px;" value="<?php echo sizeof($carr[1]);?>" name="contacts_count" />
			</div>
			<div id="conDiv1">
				<?php if(is_array($carr[1])): $i = 0; $__LIST__ = $carr[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="inLinkman" id="con_<?php echo ($vo["id"]); ?>">
						<input type="text" placeholder="<?php echo ($vo["chinese_name"]); ?>" readonly="readonly">
						<div class="icons clearfix">
							<!--<button type="button" class="icon-compile btn-primary edit-btn" data-backdrop="static" data-type="1" data-id="<?php echo ($vo["id"]); ?>" data-toggle="modal" data-target="#myModal"></button>-->
							<a href="javascript:;" class="icon-delete" data-id="<?php echo ($vo["rcid"]); ?>"></a>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="linkman">
			<p>备选商务销售联系人<em>*</em></p>
			<button type="button" class="icon-compile btn-primary contacts" data-backdrop='static' data-toggle="modal" data-target="#myModal" data-type='2'>+增加联系人</button>
			<div id="conDiv2">
				<?php if(is_array($carr[2])): $i = 0; $__LIST__ = $carr[2];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="inLinkman" id="con_<?php echo ($vo["id"]); ?>">
						<input type="text" placeholder="<?php echo ($vo["chinese_name"]); ?>" readonly="readonly">
						<div class="icons clearfix">
							<!--<button type="button" class="icon-compile btn-primary edit-btn" data-backdrop="static" data-type="1" data-id="<?php echo ($vo["id"]); ?>" data-toggle="modal" data-target="#myModal"></button>-->
							<a href="javascript:;" class="icon-delete" data-id="<?php echo ($vo["rcid"]); ?>"></a>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="linkman">
			<p>费用结算联系人<em>*</em></p>
			<span>发票等财务工作</span>
			<button type="button" class="icon-compile btn-primary contacts" data-backdrop='static' data-toggle="modal" data-target="#myModal" data-type='3'>+增加联系人</button>
			<div id="conDiv3">
				<?php if(is_array($carr[3])): $i = 0; $__LIST__ = $carr[3];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="inLinkman" id="con_<?php echo ($vo["id"]); ?>">
						<input type="text" placeholder="<?php echo ($vo["chinese_name"]); ?>" readonly="readonly">
						<div class="icons clearfix">
							<!--<button type="button" class="icon-compile btn-primary edit-btn" data-backdrop="static" data-type="1" data-id="<?php echo ($vo["id"]); ?>" data-toggle="modal" data-target="#myModal"></button>-->
							<a href="javascript:;" class="icon-delete" data-id="<?php echo ($vo["rcid"]); ?>"></a>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="linkman">
			<p>营销推广联系人<em>*</em></p>
			<span>市场营销推广，准备文案图文等工作</span>
			<button type="button" class="icon-compile btn-primary contacts" data-backdrop='static' data-toggle="modal" data-target="#myModal" data-type='4'>+增加联系人</button>
			<div id="conDiv4">
				<?php if(is_array($carr[4])): $i = 0; $__LIST__ = $carr[4];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="inLinkman" id="con_<?php echo ($vo["id"]); ?>">
						<input type="text" placeholder="<?php echo ($vo["chinese_name"]); ?>" readonly="readonly">
						<div class="icons clearfix">
							<!--<button type="button" class="icon-compile btn-primary edit-btn" data-backdrop="static" data-type="1" data-id="<?php echo ($vo["id"]); ?>" data-toggle="modal" data-target="#myModal"></button>-->
							<a href="javascript:;" class="icon-delete" data-id="<?php echo ($vo["rcid"]); ?>"></a>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="linkbottom">
			<input class="agree" type="checkbox" value="" name="agree" label='我阅读并同意真我办公的<a href="javascript:;">合作协议</a>' />
		</div>
		<div id="error_agree"></div>
		<input type="hidden" name="id" value="<?php echo I('get.id');?>">
		<button type="submit" class="sub">提交</button>
		<strong>您提交后，我们预计在一个工作日内给予审核结果。</strong>
	</div>
</form>
<div class="modal fade contacts" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="contentList">
    	<form action="<?php echo U('addContentTores');?>" id="addContentTores">
        <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-label="Close"><span  aria-hidden="true"><img src="/Public/Home/images/shareModal_icon02.png"></span></button>
            <h3>选择联系人</h3>
        </div>
        <div class="modal-body">
           <ul>
           	<?php if(is_array($resConts)): $i = 0; $__LIST__ = $resConts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="rlist<?php echo ($vo["id"]); ?>">
	                   		<input class="agree" data-id="<?php echo ($vo["id"]); ?>" type="checkbox" value="<?php echo ($vo["id"]); ?>" name="agree[]" label='<?php echo ($vo["chinese_name"]); ?>' />
		    				<span><?php echo ($vo["english_name"]); ?></span>
		    				<em><?php echo ($vo["mobile"]); ?></em>
		    				<strong><?php echo ($vo["email"]); ?></strong>
		    				<div class="icons clearfix">
			        				<button type="button" class="icon-compile btn-primary contentEdit" data-id="<?php echo ($vo["id"]); ?>"></button>
			        				<a href="javascript:;" data-id="" class="icon-delete"></a>
			        			</div>
	                   	</li><?php endforeach; endif; else: echo "" ;endif; ?>
           </ul>
	            </div>
	            <div class="modal-foot clearfix">
       		<button class="btn1" id="selectContent">选择</button>
       		<button class="btn2" id="addContent">新建</button>
       		<input type="hidden" value="<?php echo ($resources["id"]); ?>" name="rid" />
       		<input type="hidden" value="" name="type" />
       		<button class="btn3" data-dismiss="modal" aria-label="Close">关闭</button>
       </div>
       </form>
	</div>
			
		<div class="modal-content" style="display:none;" id="contentForm">
        	<form action="<?php echo U('doContacts');?>" id="contactsForm" method="post">
	            <div class="modal-header">
	                <button type="button" data-dismiss="modal" aria-label="Close"><span  aria-hidden="true"><img src="/Public/Home/images/shareModal_icon02.png"></span></button>
	                <h3>联系人信息</h3>
	            </div>
	            <div class="modal-body clearfix">
	                <div class="sort">
	                    <span>中&nbsp;&nbsp;文&nbsp;&nbsp;名</span>
	                    <input type="text" name="chinese_name">
	                </div>
	                <div class="sort  m-left">
	                    <span>英&nbsp;&nbsp;文&nbsp;&nbsp;名</span>
	                    <input type="text" name="english_name">
	                </div>
	                <div class="mf clearfix" id="sex">
	                    <div class="drop clearfix">
	                        <em>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</em>
	                        <div class="dropdown clearfix">
	                            <span class="caret"></span>
	                            <button id="sexLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
	                            <ul class="dropdown-menu" aria-labelledby="sexLabel">
	                                <li value="1">男</li>
	                                <li value="0">女</li>
	                            </ul>
	                            <input type="hidden" value="" name="sex" />
	                        </div>
	                    </div>
	                </div>
	                <div class="mailbox">
	                    <span>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</span>
	                    <input type="text" name="email">
	                </div>
	                <div class="sort">
	                    <span>移动电话</span>
	                    <input type="text" name="mobile">
	                </div>
	                <div class="sort m-left">
	                    <span>座&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机</span>
	                    <input type="text" name="tel">
	                </div>
	                <div class="uploading">
	                    <div class="headBtn clearfix">
	                    	<span class="headLabel">上传头像</span>
		                    <input type="file" id="headimage">
		                    <em>头像尺寸为500×500</em>
	                    </div>
	                    <div class="in-uploading" id="headimageDiv">
	                        <img src="/Public/Home/images/uploading_img.jpg">
	                        <input type="hidden" name="head" id="" value="" />
	                        <a href="javascript:;" id="delHead">删除</a>
	                    </div>
	                </div>
	                <script type="text/javascript">
					    $(function(){
					    	//上传图片
						    /* 初始化上传插件 */
						    $("#headimage").uploadify({
						        "height"          : 35,
						        "swf"             : "/Public/static/uploadify/uploadify.swf",
						        "fileObjName"     : "download",
						        "buttonText"      : "+上传图片",
						        "uploader"        : "<?php echo U('File/uploadHead',array('session_id'=>session_id()));?>",
						        "width"           : 130,
						        'removeTimeout'	  : 1,
						        'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
						        "onUploadSuccess" : uploadHeader,
							    'onFallback' : function() {
							        alert('未检测到兼容版本的Flash.');
							    }
						    });
						    function uploadHeader(file, data){
						    	var jsonData = $.parseJSON(data);
						    	src = jsonData.url || '/Uploads/Head/' + jsonData.savepath + jsonData.savename;
						    	$("input[name='head']").val(jsonData.savepath + jsonData.savename)
						        $('#headimageDiv img').attr('src',src);
						    }
				
					    })
					</script>
	            </div>
	            <div id="contacts_error"></div>
	            <div class="modal-foot clearfix">
	            	<input type="hidden" value="" name="id" />
	                <button type="submit" class="btn1">提交</button>
	                <button type="button" class="btn2" data-dismiss="modal">关闭</button>
	            </div>

            </form>
        </div>	
  </div>
</div>
<script type="text/javascript">
	$(function(){
		$("#addContent").click(function(){
			$('#contentForm').show()
			$("#contentList").hide()
	
			return false;
		})
		$("#selectContent").click(function(){
			var self = $("#addContentTores");
			$.post(self.attr('action'),self.serialize(),success,'json');
			return false;
			function success(data){
				if(data.status){
					location.href=''
				}else{
					alert('请选择数据');
				}
			}
			
		})
	})
</script>

	                   
	                </li><?php endif; ?>
            </ol>
        </div>
        <div class="contactRight">
            <div>
                <button type="submit">取消保存</button>
                <button>保存退出</button>
            </div>
            <div class="contactBanner"><a href="javascript:;"></a></div>
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

 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>