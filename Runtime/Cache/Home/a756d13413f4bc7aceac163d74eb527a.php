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

    <link rel="stylesheet" type="text/css" href="/Public/Home/css/article.css">
    <script type="text/javascript" src="/Public/Home/js/article.js"></script>

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
        <div class="wrapTop main">
            <h2><?php echo count($list); ?> offices in 上海上海区域办公空间</h2>
            <p>上海是世界上最繁忙的集装箱港口，也是亚洲最主要的金融中心。找到您理想的办公空间与我们的上海地区指南</p>
        </div>
        <div class="wrapCen">
            <div class="inCen main clearfix">
                <ol class="clearfix">
                    <li class="current">
                        <a href="javascript:;">列表视图</a>
                    </li>
                    <li>
                        <a href="javascript:;">地图视图</a>
                    </li>
                </ol>
                <div class="search">搜索</div>
            </div>
        </div>
        <div class="wrapDown main clearfix ">
            <div class="inWrapL">
                <ul class="list">
                    <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <div class="tab">
                                <div class="tabHd">
                                    <?php if(is_array($vo["img"])): $key = 0; $__LIST__ = $vo["img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ivo): $mod = ($key % 2 );++$key;?><!--<a href="<?php echo (grace_path($ivo["path"],'Outside')); ?>" class="cloud-zoom" rel="position: 'inside' , showTitle: false, adjustX:0, adjustY:0">--><img src="<?php echo (grace_path($ivo["path"],'Outside')); ?>"><!--</a>--><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                                <div class="tabBd clearfix">
                                    <?php if(is_array($vo["img"])): $i = 0; $__LIST__ = $vo["img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ivo): $mod = ($i % 2 );++$i;?><img src="<?php echo (grace_path($ivo["path"],'Outside')); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <div class="liCen">
                                <h3><?php echo (get_region($vo["area"])); ?>  <?php echo (msubstr($vo["address"],0,6,'utf-8',false)); ?>  <?php echo (msubstr($vo["title"],0,6,'utf-8',false)); ?></h3>
                                <p><?php echo ($vo["desc"]); ?></p>
                                <dl class="clearfix">
                                	<?php if(is_array($vo["server"])): $i = 0; $__LIST__ = $vo["server"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$service_name): $mod = ($i % 2 );++$i;?><dd><?php echo ($service_name); ?></dd><?php endforeach; endif; else: echo "" ;endif; ?>
                                </dl>
                            </div>
                            <div class="liR">
                            	<?php if(($vo["zanwu"]) == "0"): if(($vo["minMonth"]) != ""): ?><div><strong>¥<?php echo ($vo["minMonth"]); ?></strong> 起<br/><span>工位/月</span></div>
		                                	<?php else: ?>
		                                	<div><strong>¥<?php echo ($vo["minHour"]); ?></strong> 起<br/><span>工位/时</span></div><?php endif; ?>
	                                <?php else: ?>
	                                	<p style="font-size: 18px; text-align: center; width: 100%; color: #FBAD1E;">暂无房源</p><?php endif; ?>
                                <div class="pDetail">
                                    <?php if(($vo["actual_time"]) != "0"): ?><b>实时房源</b><?php endif; ?>
                                    <?php if(($vo["actual_time"]) != "0"): ?><b>促销房源</b><?php endif; ?>
                                </div>
                                <div class="btns">                                                                                                                                                                                                                                                                                                                 
                                    <a href="<?php echo U('Offices/detail',array('id'=>$vo['id']));?>"> <button class="btn1">详 情</button></a>
                                    <button class="btn2">收 藏</button>
                                </div>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="flipOver clearfix">
                    <ul class="clearfix">
                        <li><a href="javascript:;"> 上一页</a></li>
                        <li class="current"><a href="javascript:;">1</a></li>
                        <li><a href="javascript:;">2</a></li>
                        <li><a href="javascript:;">3</a></li>
                        <li><a href="javascript:;">4</a></li>
                        <li class="special">...</li>
                        <li><a href="javascript:;">80</a></li>
                        <li><a href="javascript:;">下一页</a></li>
                    </ul>
                    <span>共<em>80</em>页，到第<input type="text">页</span>
                    <button>确定</button>
                </div>
            </div>
            <div class="inWrapR">
                <div class="city pad">
                    <h5>城市</h5>
                    <div class="dropdown">
                        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">上海</button><span class="caret"></span>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li>北京</li>
                            <li>上海</li>
                            <li>杭州</li>
                            <li>广州</li>
                            <li>深圳</li>
                        </ul>
                    </div>
                </div>
                <div class="location pad">
                    <h5>地理位置</h5>
                    <input type="text" placeholder="徐汇区宜山路425号光启城商务楼">
                </div>
                <div class="rapid pad">
                    <h5>快速搜索</h5>
                    <div class="drop clearfix">
                        <em>类 型</em>
                        <div class="dropdown clearfix">
                            <span class="caret"></span>
                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">不限</button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li>0</li>
                                <li>0</li>
                                <li>0</li>
                                <li>0</li>
                                <li>0</li>
                                <li>0</li>
                            </ul>
                        </div>
                    </div>
                    <div class="drop clearfix">
                        <em>时 间</em>
                        <div class="dropdown clearfix">
                            <span class="caret"></span>
                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">不限</button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                            </ul>
                        </div>
                    </div>
                    <div class="drop clearfix">
                        <em>人 数</em>
                        <div class="dropdown clearfix">
                            <span class="caret"></span>
                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">不限</button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li>2</li>
                                <li>2</li>
                                <li>2</li>
                                <li>2</li>
                                <li>2</li>
                                <li>2</li>
                            </ul>
                        </div>
                    </div>
                    <div class="drop clearfix area">
                        <em>区 域</em>
                        <div class="dropdown clearfix">
                            <span class="caret"></span>
                            <button id="area" type="button" aria-haspopup="true" aria-expanded="false">不限</button>
                            <ul class="dropdown-menu" id="area-ul">
                                <li>浦  东</li>
                                <li>徐  汇</li>
                                <li>静  安</li>
                                <li>长  宁</li>
                                <li>普  陀</li>
                                <li>黄  浦</li>
                                <li>虹  口</li>
                                <li>闵  行</li>
                                <li>闸  北</li>
                                <li>杨  浦</li>
                                <li>青  浦</li>
                                <li>松  江</li>
                                <li>嘉  定</li>
                                <li>宝  山</li>
                                <li>奉  贤</li>
                            </ul>
                            <div class="dropdownList">
                                <dl>
                                    <dd>申/老闵行</dd>
                                    <dd>华漕</dd>
                                    <dd>虹桥镇</dd>
                                    <dd>龙柏</dd>
                                    <dd>南方商城</dd>
                                    <dd>浦江</dd>
                                    <dd>七宝</dd>
                                    <dd>莘庄</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="drop clearfix">
                        <em>面 积</em>
                        <div class="dropdown clearfix">
                            <span class="caret"></span>
                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">不限</button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                            </ul>
                        </div>
                    </div>
                    <div class="drop clearfix">
                        <em>价 位</em>
                        <div class="dropdown clearfix">
                            <span class="caret"></span>
                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">不限</button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                            </ul>
                        </div>
                    </div>
                    <div class="drop clearfix">
                        <em>装 修</em>
                        <div class="dropdown clearfix">
                            <span class="caret"></span>
                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">不限</button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                                <li>1</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="facility pad clearfix">
                    <h5>设施支持</h5>
                    <div class="checkboxFive">
                        <input type="hidden" value="1" name="" />
                        <label for="checkboxFiveInput"></label>
                        <span>会议室</span>
                    </div>
                    <div class="checkboxFive">
                        <input type="hidden" value="1" name="" />
                        <label for="checkboxFiveInput"></label>
                        <span>24小时开放</span>
                    </div>
                    <div class="checkboxFive">
                        <input type="hidden" value="1" name="" />
                        <label for="checkboxFiveInput"></label>
                        <span>WIFI</span>
                    </div>
                    <div class="checkboxFive">
                        <input type="hidden" value="1" name="" />
                        <label for="checkboxFiveInput"></label>
                        <span>茶水间</span>
                    </div>
                    <div class="checkboxFive">
                        <input type="hidden" value="1" name="" />
                        <label for="checkboxFiveInput"></label>
                        <span>查询</span>
                    </div>
                    <div class="checkboxFive">
                        <input type="hidden" value="1" name="" />
                        <label for="checkboxFiveInput"></label>
                        <span>活动室</span>
                    </div>
                    <div class="checkboxFive">
                        <input type="hidden" value="1" name="" />
                        <label for="checkboxFiveInput"></label>
                        <span>休息区</span>
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
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>