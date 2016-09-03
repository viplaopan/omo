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

    <link rel="stylesheet" type="text/css" href="/Public/Home/css/pandect.css">

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
	

<div class="pandect main clearfix">
    <ul class="clearfix">
        <li class="first">
            <a href="javascript:;">
                <em></em>
                <b style="font-size: 18px;">暂无</b>
                <p>楼宇信息</p>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <em></em>
                <b style="font-size: 18px;">暂无</b>
                <p>登记房源</p>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <em></em>
                <b style="font-size: 18px;">暂无</b>
                <p>实时房源</p>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <em></em>
                <b style="font-size: 18px;">暂无</b>
                <p>促销活动</p>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <em></em>
                <b style="font-size: 18px;">暂无</b>
                <p>本月意向
</p>
            </a>
        </li>
        <li class="first">
            <a href="javascript:;">
                <em></em>
                <b style="font-size: 18px;">暂无</b>
                <p>楼宇信息</p>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <em></em>
                <b style="font-size: 18px;">暂无</b>
                <p>客户跟踪</p>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <em></em>
                <p>申请升级高级应用</p>
            </a>
        </li>
    </ul>
    <div class="inPandect">
        <h3>您已发布<?php echo ($count); ?>个楼宇（中心）</h3>
        <a href="<?php echo U('Building/index',array('step'=>1));?>" ><button class="add">新增楼宇</button></a>
        <ol>
            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="item_<?php echo ($vo["id"]); ?>">
                    <img src="<?php echo (cover($vo["id"])); ?>">
                    <div class="pan-li-cen">
                        <dl class="clearfix">
                            <dt><span>编号：</span><em><?php echo ($vo["id"]); ?></em></dt>
                            <dd><?php echo ($vo["status_info"]); ?></dd>
                            <dd><?php echo (get_region($vo["city"])); ?></dd>
                            <dd><?php echo (get_region($vo["area"])); ?></dd>
                            <dd><?php echo ($vo["title"]); ?></dd>
                        </dl>
                        <dl class="clearfix in-pan-li">
                            <dd><span>会议室</span><em><?php echo (count_office_type($vo["id"],'5')); ?></em></dd>
                            <dd><span>登记工位</span><em><?php echo (count_all_office($vo["id"])); ?></em></dd>
                            <dd><span>闲置工位</span><em><?php echo (count_all_office($vo["id"],'1')); ?></em></dd>
                            <dd><span>促销工位</span><em><?php echo (count_all_office($vo["id"],'2')); ?></em></dd>
                        </dl>
                    </div>
                    <div class="btns">
                        <a href="#"><button class="btn1"></button></a>
                        <a href="<?php echo U('Buseness/Building/index',array('step'=>1,id=>$vo['id']));?>"><button class="btn2"></button></a>
                        <button onclick="javascript:del(<?php echo ($vo["id"]); ?>, this)" class="btn3"></button>
                    </div>
                    <?php if(($vo["step"]) == "5"): ?><a href="<?php echo U('position',array('rid'=>$vo['id']));?>" class="btn4">添加工位</a>
                    <?php else: ?>
                    	<p>未完成楼宇信息</p><?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ol>
    </div>
    <button class="all">浏览所有</button>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-label="Close"><span  aria-hidden="true"><img src="/Public/Home/images/shareModal_icon02.png"></span></button>
            <h3>选择联系人</h3>
        </div>
        <div class="modal-body">
           <ul>
                           <li>
                               <div class="check  selected">
                                <label></label>
                                <input type="text">
                                <span>Tom</span>
                            </div>
                            <span>Suntech</span>
                            <em>021-64888888</em>
                            <strong>Tom@suntech.cc</strong>
                           </li>
                           <li>
                               <div class="check  selected">
                                <label></label>
                                <input type="text">
                                <span>Tom</span>
                            </div>
                            <span>Suntech</span>
                            <em>021-64888888</em>
                            <strong>Tom@suntech.cc</strong>
                           </li>
           </ul>
                </div>
                <div class="modal-foot clearfix">
               <button class="btn1">选择</button>
               <button class="btn2">新建</button>
               <button class="btn3">关闭</button>
       </div>
            </div>
  </div>
</div> -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Close"><span  aria-hidden="true"><img src="/Public/Home/images/shareModal_icon02.png"></span></button>
                <h3>联系人信息</h3>
            </div>
            <div class="modal-body clearfix">
                <div class="sort">
                    <span>中&nbsp;&nbsp;文&nbsp;&nbsp;名</span>
                    <input type="text">
                </div>
                <div class="sort  m-left">
                    <span>英&nbsp;&nbsp;文&nbsp;&nbsp;名</span>
                    <input type="text">
                </div>
                <div class="mf clearfix">
                    <div class="drop clearfix">
                        <em>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</em>
                        <div class="dropdown clearfix">
                            <span class="caret"></span>
                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li>男</li>
                                <li>女</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mailbox">
                    <span>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</span>
                    <input type="text">
                </div>
                <div class="sort">
                    <span>移动电话</span>
                    <input type="text">
                </div>
                <div class="sort m-left">
                    <span>座&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机</span>
                    <input type="text">
                </div>
                <div class="uploading">
                    <span>上传头像</span>
                    <button>+上传图片</button>
                    <em>头像尺寸为500×500</em>
                    <div class="in-uploading">
                        <img src="/Public/Home/images/uploading_img.jpg">
                        <a href="javascript:;">删除</a>
                    </div>
                </div>
            </div>
            <div class="modal-foot clearfix">
                <button class="btn1">提交</button>
                <button class="btn2">关闭</button>
            </div>
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
        function del(id) {
            if (confirm('你确定要删除吗?')) {
                $.post("<?php echo U('Building/lists');?>",{id:id},function(data){
                    if (data == 1) {
                        $('#item_'+id).remove();
                    }
                },'json');
            }
        }
    </script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>