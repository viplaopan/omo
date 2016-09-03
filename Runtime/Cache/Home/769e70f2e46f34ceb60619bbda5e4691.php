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

    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
    <script type="text/javascript" src="/Public/Home/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/index.js"></script>
    <script>
        $(function(){
            $.post('<?php echo U("Index/index");?>',{data:'shanghai'},function(data){
                $(".zhang").html("")
                $.each(data,function(i,item){
                    $(".zhang").append("<dd>" + item.name + "</dd>");
                })
            },'json')
        })
    </script>

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
        <div class="banner" style="background: url(/Uploads/Images/<?php echo ($advlist['index_top']['data']); ?>) center no-repeat;">
            <div class="inBanner">
                <ul class="clearfix">
                    <li>
                        <p>
                            <span>地 址</span>
                            <input type="text" placeholder="上海市徐汇区宜山路">
                        </p>
                    </li>
                    <li>
                        <div class="tradeArea clearfix">
                            <span>商圈</span>
                            <div class="dropdown">
                                <div class="issue">请选择</div>
                                <dl class="zhang">
                                    <dd>1</dd>
                                    <dd>2</dd>
                                    <dd>3</dd>
                                    <dd>4</dd>
                                    <dd>5</dd>
                                    <dd>6</dd>
                                    <dd>7</dd>
                                    <dd>8</dd>
                                    <dd>9</dd>
                                    <dd>10</dd>
                                </dl>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="time clearfix">
                            <span>时间</span>
                            <div class="dropdown">
                                <div class="issue">请选择</div>
                                <dl>
                                    <dd>1</dd>
                                    <dd>2</dd>
                                    <dd>3</dd>
                                    <dd>4</dd>
                                    <dd>5</dd>
                                    <dd>6</dd>
                                    <dd>7</dd>
                                    <dd>8</dd>
                                    <dd>9</dd>
                                    <dd>10</dd>
                                </dl>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="number clearfix">
                            <span>人数</span>
                            <div class="dropdown">
                                <div class="issue">请选择</div>
                                <dl>
                                    <dd>1</dd>
                                    <dd>2</dd>
                                    <dd>3</dd>
                                    <dd>4</dd>
                                    <dd>5</dd>
                                    <dd>6</dd>
                                    <dd>7</dd>
                                    <dd>8</dd>
                                    <dd>9</dd>
                                    <dd>10</dd>
                                </dl>
                            </div>
                        </div>
                    </li>
                    <li>
                        <button>开始搜索</button>
                    </li>
                </ul>
                <div class="hotSearch">
                    <strong>热门搜索：</strong>
                    <ol>
                        <li><a href="javascript:;">徐汇 ,</a></li>
                        <li><a href="javascript:;">浦东 ,</a></li>
                        <li><a href="javascript:;">闵行 ,</a></li>
                        <li><a href="javascript:;">静安 ,</a></li>
                        <li><a href="javascript:;">闸北 ,</a></li>
                        <li><a href="javascript:;">青浦 </a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="introduce">
            <ul class="main clearfix">
                <li>
                    <img src="/Public/Home/images/introduce_01.png">
                    <h2>100%真实房源</h2>
                    <p>所有办公空间均为真实房源，真实实时呈现，保障决策准确高效。</p>
                </li>
                <li>
                    <img src="/Public/Home/images/introduce_02.png">
                    <h2>优质办公环境</h2>
                    <p>所有推荐的服务办公空间为高品质，核心商务区域。</p>
                </li>
                <li>
                    <img src="/Public/Home/images/introduce_03.png">
                    <h2>直接对接业主</h2>
                    <p>直接与房源业主对接互动，不存在差价土壤，让您得到最真优惠的实价。</p>
                </li>
                <li>
                    <img src="/Public/Home/images/introduce_04.png">
                    <h2>免佣金</h2>
                    <p>所有服务不花您一分钱，安心选择您所认可的服务即可。</p>
                </li>
            </ul>
        </div>
        <div class="serve main">
            <h3>最佳服务式办公推荐</h3>
            <ul>
                <li>
                    <a href="javascript:;">
                        <img src="/Public/Home/images/serve_01.jpg">
                        <div class="down">
                            <em>[ 浦东新区 ]</em>
                            <span>东方路 钱江大厦</span>
                            <p>所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <img src="/Public/Home/images/serve_02.jpg">
                        <div class="down">
                            <em>[ 普陀区 ]</em>
                            <span>金沙江路  环球港中心</span>
                            <p>所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <img src="/Public/Home/images/serve_03.jpg">
                        <div class="down">
                            <em>[ 徐汇区 ]</em><br/>
                            <span>宜山路  光启城</span>
                            <p>所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <img src="/Public/Home/images/serve_04.jpg">
                        <div class="down">
                            <em>[ 长宁区  ]</em><br/>
                            <span>延安西路  环球港</span>
                            <p>所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <img src="/Public/Home/images/serve_05.jpg">
                        <div class="down">
                            <em>[ 黄埔区  ]</em><br/>
                            <span>新天地  环球港中心</span>
                            <p>所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。所有服务式办公均为五星级以上高质量服务品质，位于高品质办公区域。</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="workFor">
            <div class="caption">
                <h3>他们随时为您效劳</h3>
                <p>来自各个商务中心负责人一对一贴心为您服务</p>
            </div>
            <div class="tab main">
                <div class="tabHd">
                    <ul class="clearfix">
                        <li class="current first">
                            <img src="/Public/Home/images/workFor_01.png">
                            <div class="down">
                                <h5>[ 光启城商务楼 ]</h5>
                                <em>孙悟空</em>
                            </div>
                        </li>
                        <li>
                            <img src="/Public/Home/images/workFor_02.png">
                            <div class="down">
                                <h5>[ 光启城商务楼 ]</h5>
                                <em>孙悟空</em>
                            </div>
                        </li>
                        <li>
                            <img src="/Public/Home/images/workFor_03.png">
                            <div class="down">
                                <h5>[ 光启城商务楼 ]</h5>
                                <em>孙悟空</em>
                            </div>
                        </li>
                        <li>
                            <img src="/Public/Home/images/workFor_04.png">
                            <div class="down">
                                <h5>[ 光启城商务楼 ]</h5>
                                <em>孙悟空</em>
                            </div>
                        </li>
                        <li>
                            <img src="/Public/Home/images/workFor_05.png">
                            <div class="down">
                                <h5>[ 光启城商务楼 ]</h5>
                                <em>孙悟空</em>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="tabBd">
                    <ol style="display:block">
                        <li>
                            <div class="workImg">
                                <img src="/Public/Home/images/work_01.png">
                                <img src="/Public/Home/images/work_02.png">
                                <img src="/Public/Home/images/work_03.png">
                            </div>
                            <div class="workRight">
                                <h6>给航空公司的感谢信</h6>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;内容摘要：南方航空公司，是我国运输飞机最多、航线网络最密集、客运量最大的航空公司。1999年至现在，南方航空公司创造了累计安全飞行1000万小时、并连续保证219个月的航空安全纪录，平安运输旅客5.4亿人次的成绩。这都离不开南方航空坚持“安全第一”的核心价值观，南方航空公司禀承“客户至上”的服务理念，通过提供“可靠、准点、便捷”…</p>
                            </div>
                        </li>
                    </ol>
                    <ol>
                        <li>
                            <div class="workImg">
                                <img src="/Public/Home/images/work_01.png">
                                <img src="/Public/Home/images/work_02.png">
                                <img src="/Public/Home/images/work_03.png">
                            </div>
                            <div class="workRight">
                                <h6>2</h6>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;内容摘要：南方航空公司，是我国运输飞机最多、航线网络最密集、客运量最大的航空公司。1999年至现在，南方航空公司创造了累计安全飞行1000万小时、并连续保证219个月的航空安全纪录，平安运输旅客5.4亿人次的成绩。这都离不开南方航空坚持“安全第一”的核心价值观，南方航空公司禀承“客户至上”的服务理念，通过提供“可靠、准点、便捷”…</p>
                            </div>
                        </li>
                    </ol>
                    <ol>
                        <li>
                            <div class="workImg">
                                <img src="/Public/Home/images/work_01.png">
                                <img src="/Public/Home/images/work_02.png">
                                <img src="/Public/Home/images/work_03.png">
                            </div>
                            <div class="workRight">
                                <h6>3</h6>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;内容摘要：南方航空公司，是我国运输飞机最多、航线网络最密集、客运量最大的航空公司。1999年至现在，南方航空公司创造了累计安全飞行1000万小时、并连续保证219个月的航空安全纪录，平安运输旅客5.4亿人次的成绩。这都离不开南方航空坚持“安全第一”的核心价值观，南方航空公司禀承“客户至上”的服务理念，通过提供“可靠、准点、便捷”…</p>
                            </div>
                        </li>
                    </ol>
                    <ol>
                        <li>
                            <div class="workImg">
                                <img src="/Public/Home/images/work_01.png">
                                <img src="/Public/Home/images/work_02.png">
                                <img src="/Public/Home/images/work_03.png">
                            </div>
                            <div class="workRight">
                                <h6>4</h6>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;内容摘要：南方航空公司，是我国运输飞机最多、航线网络最密集、客运量最大的航空公司。1999年至现在，南方航空公司创造了累计安全飞行1000万小时、并连续保证219个月的航空安全纪录，平安运输旅客5.4亿人次的成绩。这都离不开南方航空坚持“安全第一”的核心价值观，南方航空公司禀承“客户至上”的服务理念，通过提供“可靠、准点、便捷”…</p>
                            </div>
                        </li>
                    </ol>
                    <ol>
                        <li>
                            <div class="workImg">
                                <img src="/Public/Home/images/work_01.png">
                                <img src="/Public/Home/images/work_02.png">
                                <img src="/Public/Home/images/work_03.png">
                            </div>
                            <div class="workRight">
                                <h6>5</h6>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;内容摘要：南方航空公司，是我国运输飞机最多、航线网络最密集、客运量最大的航空公司。1999年至现在，南方航空公司创造了累计安全飞行1000万小时、并连续保证219个月的航空安全纪录，平安运输旅客5.4亿人次的成绩。这都离不开南方航空坚持“安全第一”的核心价值观，南方航空公司禀承“客户至上”的服务理念，通过提供“可靠、准点、便捷”…</p>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="share">
            <div class="caption">
                <h3>分享办公</h3><button type="button" class=" btn-primary" data-toggle="modal" data-target="#myModal"></button>
                <p>全新办公分享模式，适合刚起步的您</p>
            </div>
            <div class="inShare">
                <ul class="clearfix main">
                    <li>
                        <a href="javascript:;">
                            <img src="/Public/Home/images/share_list01.jpg">
                            <div class="down">
                                <div class="inDown">
                                    <h6>浦东新区  钱江大厦</h6>
                                    <em>意向于设计公司</em>
                                    <p>我们是一家IT公司，位于普陀区苏州河边上，现有至多6人的办公位闲置，有兴趣者可以一起来办公哦。</p>
                                </div>
                                <span>（会议室）可提供5人位</span>
                                <button>查看更多</button>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <img src="/Public/Home/images/share_list02.jpg">
                            <div class="down">
                                <div class="inDown">
                                    <h6>浦东新区  钱江大厦</h6>
                                    <em>意向于设计公司</em>
                                    <p>我们是一家IT公司，位于普陀区苏州河边上，现有至多6人的办公位闲置，有兴趣者可以一起来办公哦。</p>
                                </div>
                                <span>（会议室）可提供5人位</span>
                                <button>查看更多</button>
                            </div>
                        </a>
                    <li>
                        <a href="javascript:;">
                            <img src="/Public/Home/images/share_list03.jpg">
                            <div class="down">
                                <div class="inDown">
                                    <h6>浦东新区  钱江大厦</h6>
                                    <em>意向于设计公司</em>
                                    <p>我们是一家IT公司，位于普陀区苏州河边上，现有至多6人的办公位闲置，有兴趣者可以一起来办公哦。</p>
                                </div>
                                <span>（会议室）可提供5人位</span>
                                <button>查看更多</button>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <img src="/Public/Home/images/share_list04.jpg">
                            <div class="down">
                                <div class="inDown">
                                    <h6>浦东新区  钱江大厦</h6>
                                    <em>意向于设计公司</em>
                                    <p>我们是一家IT公司，位于普陀区苏州河边上，现有至多6人的办公位闲置，有兴趣者可以一起来办公哦。</p>
                                </div>
                                <span>（会议室）可提供5人位</span>
                                <button>查看更多</button>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="simple">
            <div class="sim">
                <div class="inSimple main">
                    <div class="caption">
                        <h3>简单  轻松  自由  舒适</h3>
                    </div>
                    <div class="mid_block">
                        <div class="count-item first">
                            <div class="count-number" id="count_1" style="width: 180px">9</div>
                            <div class="count-fonts">9年的坚持</div>
                        </div>
                        <div class="count-item">
                            <div class="count-number" id="count_2" style="width: 220px">100</div>
                            <div class="count-mc"></div>
                            <div class="count-fonts">100多位伙伴</div>
                        </div>
                        <div class="count-item">
                            <div class="count-number" id="count_3" style="width: 180px">4</div>
                            <div class="count-fonts">4大业务整合</div>
                        </div>
                        <div class="count-item">
                            <div class="count-number" id="count_4" style="width: 220px">100</div>
                            <div class="count-mc"></div>
                            <div class="count-fonts">服务100多家知名企业</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="imgTab">
            <div class="inTab main">
                <div class="imgTabHead">
                    <ol class="clearfix">
                        <li>
                            <img src="/Public/Home/images/imgTab01.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab02.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab03.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab04.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab05.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab06.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab07.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab08.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab09.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab10.jpg">
                        </li>
                    </ol>
                    <ol class="clearfix">
                        <li>
                            <img src="/Public/Home/images/imgTab01.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab02.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab03.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab04.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab05.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab06.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab07.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab08.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab09.jpg">
                        </li>
                        <li>
                            <img src="/Public/Home/images/imgTab10.jpg">
                        </li>
                    </ol>
                </div>
                <div class="imgTabFoot">
                    <ul class="clearfix">
                        <li class="first current"></li>
                        <li></li>
                    </ul>
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