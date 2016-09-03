$(function() {
	 $('.dropdown').mouseleave(function(event) {
		$(this).removeClass('open');
	});	
	//下拉菜单
	$('.dropdown li').click(function(event) {
			var obj=$(this)			
			var value = obj.html();
			var type = obj.attr('data-type');

			$(this).parent().siblings('button').html(value);
			$(this).parent().siblings('button').css({
				color: '#3d3d3d',
				borderColor: '#808080'
			});
			$(this).css('color', '#13aced').siblings().css('color', '#000');;
		});
	//tab切换hover
	$('.tabHd ul li'). hover(function() {
		$(this).addClass('current');
		$(this).siblings('').removeClass('current');
		$('.tabBd ol').hide().eq($('.tabHd ul li').index(this)).show();
	}, function() {
	});
	var num=0;
	//小点hover
	$('.imgTabFoot li').hover(function() {
		num=$(this).index();
		var s=num*-1100;
		$('.imgTabHead').stop(true).animate({'left':s}, 500);
		$('.imgTabFoot li').eq(num).addClass('current').siblings('li').removeClass('current');
	}, function() {
	});
	var scollnum;
	var turff = 1;
	$(window).scroll(function(){
		//判断滚轴滚到5像素时加载c3动画
		scollnum=$(document).scrollTop();
		if(scollnum>5){
			scrollshow()		
		}else{
			scrollfade()
		}
	})
//	$('.check').click(function(event) {
//		if ($(this).hasClass('selected')) {
//			$(this).removeClass('selected');
//		}else{
//			$(this).addClass('selected');
//			
//		};
//	});
});
//鼠标下拉top变化
function scrollshow(){
	$('.top').addClass('clist')
}
function scrollfade(){
	$('.top').removeClass('clist')
}