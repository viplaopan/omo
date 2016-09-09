$(function() {
	//新JS 开始
		$('#search_city .dropdown .dropdown-menu li').click(function(){
			var city = $(this).html();
			var labelId = '#' + $(this).parent().attr('aria-labelledby');
			$(labelId).html(city);
			var inputVal = $(this).parent().prev().val(city);
			$('#searchForm').submit();
		})
		$('#search_area .dropdown .dropdown-menu li').click(function(){
			var areaLabel = $(this).html();
			var area_id = $(this).attr('value');
			
			var labelId = '#' + $(this).parent().attr('aria-labelledby');

			$(labelId).html(areaLabel);
			var inputVal = $(this).parent().prev().val(area_id);

			$(this).parent().parent().removeClass('open');
		
			$.each(trading,function(i,item){
				if(item.area == area_id){
					$('#search_trading .dropdown .dropdown-menu').append("<li value='" +item.id+ "'>" + item.name + "</li>");
				}
			})
			$('#searchForm').submit();
		})
		$("#search_trading").on("click","li",function(){
	　　　　 var trading = $(this).html();
			var tradingVar = $(this).attr("value");
			var labelId = '#' + $(this).parent().attr('aria-labelledby');
			$(labelId).html(trading);
			var inputVal = $(this).parent().prev().val(tradingVar);
	　　});
		//类型
		$("#search_type").on("click","li",function(){
	　　　　 var trading = $(this).html();
			var tradingVar = $(this).attr("value");
			var labelId = '#' + $(this).parent().attr('aria-labelledby');
			$(labelId).html(trading);
			var inputVal = $(this).parent().prev().val(tradingVar);
	　　});

		//类型
		$("#search_time").on("click","li",function(){
	　　　　 var trading = $(this).html();
			var tradingVar = $(this).attr("value");
			var labelId = '#' + $(this).parent().attr('aria-labelledby');
			$(labelId).html(trading);
			var inputVal = $(this).parent().prev().val(tradingVar);
	　　});

		$("#search_count").on("click","li",function(){
	　　　　 var trading = $(this).html();
			var tradingVar = $(this).attr("value");
			var labelId = '#' + $(this).parent().attr('aria-labelledby');
			$(labelId).html(trading);
			var inputVal = $(this).parent().prev().val(tradingVar);
	　　});
		$("#search_mianji").on("click","li",function(){
	　　　　 var trading = $(this).html();
			var tradingVar = $(this).attr("value");
			var labelId = '#' + $(this).parent().attr('aria-labelledby');
			$(labelId).html(trading);
			var inputVal = $(this).parent().prev().val(tradingVar);
	　　});

		_init();
		function _init(){
			var area_id = $("input[name='area']").val();
			
			if(area_id>0){
				$.each(trading,function(i,item){
					if(item.area == area_id){
						$('#search_trading .dropdown .dropdown-menu').append("<li value='" +item.id+ "'>" + item.name + "</li>");
					}
				})
			}
		}
	//END
	// $('.inWrapL .tabBd img'). hover(function() {
	// 	var i = $(this).index();
	// 	$(this).parent().prev().children('img').hide().eq(i).show();
	// }, function() {
	// });
	// //区域下拉菜单
	// $('#area').mouseleave(function(event) {
	// 	$(this).next().css('display', 'none');
	// });
	// $('.area ul').hover(function() {
	// 	$(this).css('display', 'block');
	// }, function() {
	// 	$(this).css('display', 'none');
	// });
	// $('.area li').unbind();
	// // $('#area').click(function(event) {			
	// //     var obj = $(this);
	// //     var ulObj = $("#"+obj.attr('id')+'-ul');
	// //     ulObj.show();
	// //     ulObj.find('li').hover(function() {
	// //     	var liTop = $(this).offset().top;
	// //     	var fixedTop = liTop-$(document).scrollTop()
	// //     	$('.dropdownList dl').css({
	// //     		display: 'block',
	// //     		top: fixedTop-1
	// //     	});
	// //     }, function() {
	// //         $('.dropdownList dl').css({
	// //     		display: 'none'
	// //     	});
	// //     });
		
	// // });
	
	// $('.dropdownList dl').hover(function() {
	//  	$(this).css('display', 'block');
	//  	$(this).parent().siblings('ul').css('display', 'block');
	// }, function() {
	//  	$(this).css('display', 'none');
	//  	$(this).parent().siblings('ul').css('display', 'none');	
	// });
	// $('.dropdownList dl dd').click(function(event) {
	//  	var thisBtn = $(this).parent().parent().siblings('button');
	//  	thisBtn.html($(this).html());
	//  	thisBtn.parent().find('ul').hide();
	//  	$(this).parent().css('display', 'none');
	//  	$(this).css('color', '#13aced').siblings().css('color', '#222');
	//  	thisBtn.css({
	// 		color: '#3d3d3d',
	// 		borderColor: '#808080'
	// 	});
	// });

	// //复选框
	// $('.checkboxFive').click(function(event) {
	// 	if ($(this).hasClass('selected')) {
	// 		$(this).removeClass('selected');
	// 		$(this).find('input').val(0)
	// 	}else{
	// 		$(this).addClass('selected');
	// 		$(this).find('input').val(1)
	// 	};
	// });
});