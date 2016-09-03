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
<script type="text/javascript" src="/Public/Home/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/common.js"></script>

	<link rel="stylesheet" type="text/css" href="/Public/Home/css/details.css">
	<script type="text/javascript" src="/Public/Home/js/details.js"></script>

<?php echo hook('pageHeader');?>

</head>
<body>
	<!-- 头部 -->
	<div class="top">
        	<header>
        		<div class="inHeader main">
        			<h1>
    	    			<a href="<?php echo U('Index/index');?>"><img src="/Public/Home/images/logo.png" height="63" width="182"></a>
    	    		</h1>
    	    		<div class="phone">021-60487602 / 13817236352</div>
    	    		<div class="col">
    	    			<a href="javascript:;" class="collectNum">0</a>
    	    			<a href="javascript:;" class="collectYour">您的<br/>收藏</a>
    	    		</div>
        		</div>
        	</header>
            <nav>
                <ul class="clearfix main">
                    <li><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
                    <li><a href="<?php echo U('Home/Offices/index');?>">找办公空间</a></li>
                    <li><a href="javascript:;">怎么帮助到您</a></li>
                    <li><a href="javascript:;">关于我们</a></li>
                    <li><a href="javascript:;">行业动态</a></li>
                </ul>
            </nav>
        </div>
	<!-- /头部 -->
	
	<!-- 主体 -->
	

	<div class="wrap">
		<div class="bread">
			<div class="inBread main">
				<span><a href="javascript:;">首页</a></span><span> > </span><span><a href="javascript:;">找办公空间</a></span><span> > </span><span class="current"><?php echo ($info["title"]); ?></span>
			</div>
		</div>
		<div class="inWrap main clearfix">
			<div class="wrapL">
				<div class="work bd">
					<p><?php echo ($info["region"]); ?></p>
					<p><?php echo ($info["title"]); ?></p>
				</div>
				<div class="serve bd">
					<?php if(($info["zanwu"]) == "0"): ?><h4>服务式办公</h4>
						<?php if(($info["minMonth"]) != ""): ?><strong>¥<?php echo ($info["minMonth"]); ?></strong>
								<span>起/工位/月</span>
								<p>价格会受到一些因素影响，包括所需工位数，租期长短等</p>
							
							<?php else: ?>
								<strong>¥<?php echo ($info["minHour"]); ?></strong>
								<span>起/工位/时</span>
								<p>价格会受到一些因素影响，包括所需工位数，租期长短等</p><?php endif; ?>
					<?php else: ?>
					<h4 style="color: #FBAD1E;">暂无房源</h4><?php endif; ?>
				</div>
				<div class="peple bd">
					<h4>此中心顾问</h4>
					<img src="<?php echo ($info["contact"]["head"]); ?>">
					<p><span><?php echo ($info["contact"]["chinese_name"]); ?></span></p>
					<div class="btns">
						<button>视频观看</button>
						<button>在线预约</button>
						<button>点击收藏</button>
					</div>
					<!--<img src="/Public/Home/images/code.jpg">
					<p>轻扫二维码分享给小伙伴</p>-->''
				</div>
			</div>
			<div class="wrapR">
				<?php if(($promotions != '') OR ($actuals != '') ): ?><div class="tab">
					
					<div class="tabHd">
						<ul class="clearfix">
							<?php if(!empty($promotions)): ?><li  class="current"><a href="javascript:;">促销讯息</a></li><?php endif; ?>
							<?php if(!empty($actuals)): ?><li><a href="javascript:;">实时讯息</a></li><?php endif; ?>
						</ul>
					</div>
					
					<div class="tabBd clearfix">
						<?php if(!empty($promotions)): ?><ol>
							<?php if(is_array($promotions)): $i = 0; $__LIST__ = $promotions;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 6 );++$i;?><script type="text/javascript">
									var actuals<?php echo ($vo['id']); ?> = <?php echo json_encode($vo); ?>
								</script>
								<li class="<?php if(($mod) == "4"): ?>first<?php endif; ?> marks" data-toggle="modal" data-target="#myModal" data-id='<?php echo ($vo['id']); ?>'>
									<div class="imagesLists" style="display: none;">
										<?php if(is_array($vo["images"])): $k = 0; $__LIST__ = $vo["images"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ivo): $mod = ($k % 2 );++$k;?><div class="item <?php if(($k) == "1"): ?>active<?php endif; ?>">
											    <img src="<?php echo (grace_path($ivo["path"],'Position')); ?>">
										    </div><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
									</div>
									<a href="javascript:;"  class=" btn-primary">
										<img src="<?php echo ($vo["cover"]); ?>">
										<div class="img-down">
											<div class="in-down">
												<span><?php echo ((isset($vo["monthTitle"]) && ($vo["monthTitle"] !== ""))?($vo["monthTitle"]):'暂无'); ?></span>
												<s><?php echo ((isset($vo["promMonthTitle"]) && ($vo["promMonthTitle"] !== ""))?($vo["promMonthTitle"]):'无'); ?></s>
											</div>
											<div class="in-down in-down2">
												<span><?php echo ((isset($vo["hourTitle"]) && ($vo["hourTitle"] !== ""))?($vo["hourTitle"]):'暂无'); ?></span>
												<s><?php echo ((isset($vo["promHourTitle"]) && ($vo["promHourTitle"] !== ""))?($vo["promHourTitle"]):'无'); ?></s>
											</div>
											<p><?php echo (date("Y年m月d日",$vo["start_time"])); ?>至<?php echo (date("Y年m月d日",$vo["end_time"])); ?>
												<br/>
												可扩充为<?php echo ($vo["addpace"]); ?>人工位</p>
										</div>
										<strong><?php echo ($vo["typeTitle"]); ?></strong>
									</a>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php if(empty($promotions)): ?><li class="empty"><div class="in-no-office">
			                    <img src="/Public/Home/images/not_office.jpg">
			                    <p>SORRY，没有促销房源!</p>
			                    <a href="<?php echo U("Home/Offices/index");?>">查看其他</a>
			                </div>
							</li><?php endif; ?>
						</ol><?php endif; ?>
						<?php if(!empty($actuals)): ?><ol>
							<?php if(is_array($actuals)): $i = 0; $__LIST__ = $actuals;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 4 );++$i;?><script type="text/javascript">
									var actuals<?php echo ($vo['id']); ?> = <?php echo json_encode($vo); ?>
								</script>
								
								<li class="<?php if(($mod) == "0"): ?>first<?php endif; ?> marks" data-toggle="modal" data-target="#myModal" data-id='<?php echo ($vo['id']); ?>'>
									<div class="imagesLists" style="display: none;">
										<?php if(is_array($vo["images"])): $k = 0; $__LIST__ = $vo["images"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ivo): $mod = ($k % 2 );++$k;?><div class="item <?php if(($k) == "1"): ?>active<?php endif; ?>">
											    <img src="<?php echo (grace_path($ivo["path"],'Position')); ?>">
										    </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
									</div>
									<a href="javascript:;"  class=" btn-primary">
										<img src="<?php echo ($vo["cover"]); ?>">
										<div class="img-down">
											<div class="in-down">
												<span><?php echo ((isset($vo["monthTitle"]) && ($vo["monthTitle"] !== ""))?($vo["monthTitle"]):'暂无'); ?></span>
												
											</div>
											<div class="in-down in-down2">
												<span><?php echo ((isset($vo["hourTitle"]) && ($vo["hourTitle"] !== ""))?($vo["hourTitle"]):'暂无'); ?></span>
												
											</div>
											<p><?php echo (date("Y年m月d日",$vo["start_time"])); ?>至<?php echo (date("Y年m月d日",$vo["end_time"])); ?>
												<br/>
												可扩充为<?php echo ($vo["addpace"]); ?>人工位</p>
										</div>
									</a>
									<strong><?php echo ($vo["typeTitle"]); ?></strong>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php if(empty($actuals)): ?><li class="empty"><div class="in-no-office">
				                    <img src="/Public/Home/images/not_office.jpg">
				                    <p>SORRY， 没有实时房源!</p>
				                    <a href="<?php echo U("Home/Offices/index");?>">查看其他</a>
				                </div>
								</li><?php endif; ?>
						</ol><?php endif; ?>
						
					</div>
					
				</div>
				<?php else: ?>
				
						<h1 style="padding: 50px;width: 100%;text-align: center;font-size: 22px;color: #FBAD1E;">此中心暂无房源信息</h1><?php endif; ?>
				<div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
					<div class="imgShade"><p><?php echo ($info["desc"]); ?></p></div>
					<div class="carousel-inner" role="listbox">
						<?php if(is_array($outSide)): $k = 0; $__LIST__ = $outSide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ivo): $mod = ($k % 2 );++$k;?><div class="item <?php if(($k) == "1"): ?>active<?php endif; ?>" data-toggle="modal" data-target="#openImg">
							    <img class="myimg" src="<?php echo (grace_path($ivo["path"],'Outside')); ?>">
						    </div><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</div>
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</a>
				</div>
				<!--<script type="text/javascript">
					$(function(){
						$('#openImg').on('shown.bs.modal', function (e) {
						  // do something...
						  var i = $(e.relatedTarget).index();
						  $("#openImg .item").removeClass('active')
						  $("#openImg .item").eq(i).addClass('active')
						  
						  $("#openImg ol li").removeClass('active')
						  $("#openImg ol li").eq(i).addClass('active')
						  
						  
						})
					})
				</script>-->
				<div class="carDown">
					<ol class="clearfix serviceol" style=" overflow: hidden;">
						<?php if(is_array($services)): $i = 0; $__LIST__ = $services;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($vo); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ol>

					<button class="pack">展开更多信息+</button>
				</div>
				<!--<div class="office clearfix">
					<div class="workRight">
						<h4>办公空间</h4>
						<p>钱江大厦地处浦电路东方路区域建筑群的中心位置，地铁浦电路站近在咫尺，地段优势明显。大厦楼体方正，外立面选用钢化中空镀膜玻璃幕墙，外观简洁现代，楼内办公环境静雅怡人，近旁就是张家浜河道，无论工作休闲，均可享受到商务交流的便利和自然环境的清新。</p>
					</div>
					<div class="workImg">
						<img src="/Public/Home/images/work_01.png">
						<img src="/Public/Home/images/work_02.png">
						<img src="/Public/Home/images/work_03.png">
					</div>
				</div>-->
				<div class="rim clearfix">
					<h4>周边商业配套服务</h4>
					<ul>
						<li class="first">
							<img src="/Public/Home/images/rim_icon01.jpg">
							<h5>地铁/公交站</h5>
							<p class="star star10"></p>
							<span>约<strong>3</strong>个站点</span>
							<dl>
								<dd>桂平路钦州南路</dd>
								<dd>虹梅路东兰路</dd>
								<dd>漕宝路桂平路</dd>
								<dd>漕宝路虹梅路</dd>
								<dd>桂平路漕宝路</dd>
							</dl>
						</li>
						<li>
							<img src="/Public/Home/images/rim_icon02.jpg">
							<h5>快餐</h5>
							<p class="star star9"></p>
							<span>约<strong>3</strong>个站点</span>
							<dl>
								<dd>桂平路钦州南路</dd>
								<dd>虹梅路东兰路</dd>
								<dd>漕宝路桂平路</dd>
								<dd>漕宝路虹梅路</dd>
								<dd>桂平路漕宝路</dd>
							</dl>
						</li>
						<li>
							<img src="/Public/Home/images/rim_icon03.jpg">
							<h5>餐厅</h5>
							<p class="star star9"></p>
							<span>约<strong>3</strong>个站点</span>
							<dl>
								<dd>桂平路钦州南路</dd>
								<dd>虹梅路东兰路</dd>
								<dd>漕宝路桂平路</dd>
								<dd>漕宝路虹梅路</dd>
								<dd>桂平路漕宝路</dd>
							</dl>
						</li>
						<li>
							<img src="/Public/Home/images/rim_icon04.jpg">
							<h5>银行</h5>
							<p class="star star8"></p>
							<span>约<strong>3</strong>个站点</span>
							<dl>
								<dd>桂平路钦州南路</dd>
								<dd>虹梅路东兰路</dd>
								<dd>漕宝路桂平路</dd>
								<dd>漕宝路虹梅路</dd>
								<dd>桂平路漕宝路</dd>
							</dl>
						</li>
					</ul>
				</div>
				<div class="map">
					<h4>地理位置</h4>
					<p>钱江大厦地处浦电路东方路区域建筑群的中心位置，地铁浦电路站近在咫尺，地段优势明显。</p>
					<img src="/Public/Home/images/map_bg.jpg">
				</div>
				<div class="around">
					<h4>周边办公间</h4>
					<ul class="clearfix">
						<li class="first">
							<a href="javascript:;">
								<img src="/Public/Home/images/around_list01.jpg">
								<h5>东苑丽宝广场</h5>
								<p>钱江大厦地处浦电路东方路区域建筑群的中心位置......</p>
								<strong>¥8000 起/工位/月</strong>
							</a>
						</li>
						<li>
							<a href="javascript:;">
								<img src="/Public/Home/images/around_list02.jpg">
								<h5>东苑丽宝广场</h5>
								<p>钱江大厦地处浦电路东方路区域建筑群的中心位置......</p>
								<strong>¥8000 起/工位/月</strong>
							</a>
						</li>
						<li>
							<a href="javascript:;">
								<img src="/Public/Home/images/around_list03.jpg">
								<h5>东苑丽宝广场</h5>
								<p>钱江大厦地处浦电路东方路区域建筑群的中心位置......</p>
								<strong>¥8000 起/工位/月</strong>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
			  <div class="modal-content">
				  <div class="modal-header">
					  <div id="carousel-generic" class="carousel slide" data-ride="carousel">
						  <div class="carousel-inner" id="imagesModal" role="listbox">
							  <div class="item active">
								  <img src="/Public/Home/images/details_big01.jpg">
							  </div>
							  <div class="item">
								  <img src="/Public/Home/images/details_small02.jpg">
							  </div>
							  <div class="item">
								  <img src="/Public/Home/images/details_small03.jpg">
							  </div>
						  </div>
						  <a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">
							  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						  </a>
						  <a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">
							  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						  </a>
					  </div>
				  </div>
				  <div class="modal-body clearfix">
					  <div class="bodyLeft">
						  <ul>
							  <li>
								  <span>按月：<a class="monthTitle"></a></span>
								  <s>按月：<a class="promMonthTitle"></a></s>
							  </li>
							  <li>
								  <span>按时：<a class="hourTitle"></a> </span>
								  <s>按时：<a class="promHourTitle"></a> </s>
							  </li>
						  </ul>
						  <ol>
							  <li>
								  <span>房源类型：</span>
								  <em class="typeTitle">办公室</em>
							  </li>
							  <li>
								  <span>标准工位：</span>
								  <em class="workplace">5位</em>
							  </li>
							  <li>
								  <span>至多工位：</span>
								  <em class="addpace">7位</em>
							  </li>
						  </ol>
					  </div>
					  <div class="bodyRight">
					  </div>
					  <div class="btn">
						  <button class="btn1">在线预约</button>
						  <button class="btn2">视频观看</button>
						  <button class="btn3" data-dismiss="modal" aria-label="Close" aria-hidden="true">关闭</button>
					  </div>
				  </div>
			  </div>
            </div>
          </div>
          <div class="modal fade open" id="openImg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	          <div class="modal-dialog openclass" role="document">
	            <div class="modal-content">
	              <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel"  data-interval="false"f>
	                  <div class="carousel-bottom">
	                  	<div class="warpOl">
	                  <ol class="carousel-indicators">

	                   <?php if(is_array($outSide)): $k = 0; $__LIST__ = $outSide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ivo): $mod = ($k % 2 );++$k;?><li class="<?php if(($k) == "1"): ?>active<?php endif; ?>"><img data-target="#carousel" data-slide-to="<?php echo ($k-1); ?>" src="<?php echo (grace_path($ivo["path"],'Outside')); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
					    
	                  </ol>
	                  </div>
	                  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
	                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	                  </a>
	                  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
	                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	                  </a>
	                  
	                  </div>
	                  <div class="carousel-inner" role="listbox">
	                    <?php if(is_array($outSide)): $k = 0; $__LIST__ = $outSide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ivo): $mod = ($k % 2 );++$k;?><div class="item <?php if(($k) == "1"): ?>active<?php endif; ?>">
							    <img src="<?php echo (grace_path($ivo["path"],'Outside')); ?>" >
						    </div><?php endforeach; endif; else: echo "" ;endif; ?>
	                  </div>
	                  
	              </div>
	            </div>
	          </div>
	        </div>

	<!-- /主体 -->

	<!-- 底部 -->
	
	<footer>
		<div class="inFooter main">
			<h4><a href="javascript:;"></a></h4>
			<div class="find">
				<input type="text" placeholder="输入您的联系电话">
				<button>委托找场地</button>
			</div>
			<p class="telephone">400-820-4416</p>
			<p class="hour">（早9:00-晚10:00）sun@71servivr.com</p>
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
        		$('#carousel').carousel({
				  interval: 0
				});
				var carLiLength = $('.carousel-indicators li').length;
				$('.carousel-indicators').width(carLiLength*105);
				$('#carousel').on('slide.bs.carousel', function (e) {
				  // 获取当前图片
				  $('#openImg .modal-content').hide()
				})
        		$('#carousel').on('slid.bs.carousel', function (e) {
        		  $('#openImg .modal-content').fadeIn();
        		  // 获取当前图片
				  var itemImg = $(e.relatedTarget).find('img');
        		  changeImageSize(itemImg);
        		 
        		  var i = $(".warpOl .active").index();
        		  //ol宽度
        		  var oW = $('.warpOl ol').width();
        		  //显示宽度
        		  var sW = 100*(i +1) + i*5 ;
        		  
        		  var imgW = $('#openImg .item.active img').width();
        		  
				  //var cW = $('#openImg .carousel-control').width();
				  
				  var warpOl = imgW - 220;
				  if(sW > (warpOl - 100)){
				  	   var smNum = $("#openImg .carousel-indicators li").length;
				  
				  	   if(i == (smNum-1)){
				  	   	$('.warpOl ol').css('margin-left',warpOl-sW)
				  	   }else{
				  	   	$('.warpOl ol').css('margin-left',warpOl-sW-100)
				  	   }
				  	   
				  }else{
				  	   $('.warpOl ol').css('margin-left','auto')
				  }
        			
				})
        		$('#openImg').on('show.bs.modal', function (e) {
        			
					  //判断第几个Item
					  var i = $(e.relatedTarget).index();
					  var itemImg = $("#openImg .item").eq(i).find('img');
					  itemImg.hide();
					  $('#openImg .carousel-bottom').hide()
				})
				$('#openImg').on('shown.bs.modal', function (e) {
					
				  // do something...
				  var i = $(e.relatedTarget).index();
				  $("#openImg .item").removeClass('active')
				  $("#openImg .item").eq(i).addClass('active')
				  
				  $("#openImg ol li").removeClass('active')
				  $("#openImg ol li").eq(i).addClass('active')
				  var itemImg = $("#openImg .item").eq(i).find('img');
			      itemImg.show();
			      $('#openImg .carousel-bottom').show()
			      
				  changeImageSize(itemImg)
				 
				  changeSimgMarginLeft(itemImg);
				})
			    function changeSimgMarginLeft(itemImg){
			    	var i = $(".warpOl .active").index();
        		  //ol宽度
        		  var oW = $('.warpOl ol').width();
        		  //显示宽度
        		  var sW = 100*(i +1) + i*5 ;
        		  
        		  var imgW = itemImg.width();
        		  
				  //var cW = $('#openImg .carousel-control').width();
				  
				  var warpOl = imgW - 220;
				  if(sW > (warpOl - 100)){
				  	   var smNum = $("#openImg .carousel-indicators li").length;
				  
				  	   if(i == (smNum-1)){
				  	   	$('.warpOl ol').css('margin-left',warpOl-sW)
				  	   }else{
				  	   	$('.warpOl ol').css('margin-left',warpOl-sW-100)
				  	   }
				  	   
				  }else{
				  	   $('.warpOl ol').css('margin-left','auto')
				  }
			    }
				function changeImageSize(obj){
					
					//获取图片宽高
					  var imgW = obj.width();
					  var imgH = obj.height();
		
				      //$("#openImg .modal-dialog").width(imgW)
				      //$("#openImg .modal-dialog").height(imgH)
					  //获取浏览器现实宽高
					  var winW = $(window).width();
					  var winH = $(window).height();

			
					   if(imgW < winW && imgH < winH){
					   	  	
					   return false;
					   }
					  if(imgW > winW && imgH > winH){
					  
					  	if(imgW>imgH){
					  		obj.width(imgW);
					  	}else{
					  		obj.height(winH);
					  	}
					  	return false;
					  }
					  if(imgW > winW){
					
					  	obj.width(winW);
					  	return false;
					  }
					  if(imgH > winH){
					  	
					  	obj.height(winH);
					  	return false;
					  }
					  
				}
        	})
        </script>
	<script type="text/javascript">
		$(function(){
			
			$('#myModal').on('show.bs.modal', function (e) {
			    var id = $(e.relatedTarget).attr('data-id');
                var data = eval('actuals' + id);
                $('.monthTitle').html(data.monthTitle);
                $('.promMonthTitle').html(data.promMonthTitle);
                $('.hourTitle').html(data.hourTitle);
                $('.promHourTitle').html(data.promHourTitle);
                $('.typeTitle').html(data.typeTitle);
                $('.workplace').html(data.workplace);
                $('.addpace').html(data.addpace);
                var imageslists = $(e.relatedTarget).find('.imagesLists').html();
      
                $('#imagesModal').html(imageslists);
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