$(function() {
	$('.inWrapL .tabBd img'). hover(function() {
		 var i = $(this).index();
		$(this).parent().prev().children('img').hide().eq(i).show();
	}, function() {
	});
	//区域下拉菜单
	$('#area').mouseleave(function(event) {
		$(this).next().css('display', 'none');
	});
	$('.area ul').hover(function() {
		$(this).css('display', 'block');
	}, function() {
		$(this).css('display', 'none');
	});
	$('.area li').unbind();
	$('#area').click(function(event) {			
	    var obj = $(this);
	    var ulObj = $("#"+obj.attr('id')+'-ul');
	    ulObj.show();
	    ulObj.find('li').hover(function() {
	    	var liTop = $(this).offset().top;
	    	var fixedTop = liTop-$(document).scrollTop()
	    	$('.dropdownList dl').css({
	    		display: 'block',
	    		top: fixedTop-1
	    	});
	    }, function() {
	        $('.dropdownList dl').css({
	    		display: 'none'
	    	});
	    });
		
	});
	
	$('.dropdownList dl').hover(function() {
	 	$(this).css('display', 'block');
	 	$(this).parent().siblings('ul').css('display', 'block');
	}, function() {
	 	$(this).css('display', 'none');
	 	$(this).parent().siblings('ul').css('display', 'none');	
	});
	$('.dropdownList dl dd').click(function(event) {
	 	var thisBtn = $(this).parent().parent().siblings('button');
	 	thisBtn.html($(this).html());
	 	thisBtn.parent().find('ul').hide();
	 	$(this).parent().css('display', 'none');
	 	$(this).css('color', '#13aced').siblings().css('color', '#222');
	 	thisBtn.css({
			color: '#3d3d3d',
			borderColor: '#808080'
		});
	});

	//复选框
	$('.checkboxFive').click(function(event) {
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected');
			$(this).find('input').val(0)
		}else{
			$(this).addClass('selected');
			$(this).find('input').val(1)
		};
	});
});