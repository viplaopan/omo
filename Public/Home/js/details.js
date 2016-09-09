$(function() {

		$('.smallImg li').mouseover(function(event) {		
			var i=$(this).index();
			$('.bigImg li').eq(i).css('display', 'block').siblings().css('display', 'none');
		});
		/*var key=0;
		var liLenth=$('.smallImg li').length;
		function clickFn(){
			key++;
				if(key>liLenth-4){
					key=liLenth-4;
				}
				var b=key*-180;
				$('.smallImg').stop().animate({'left':b}, 400);
		}
		$('.down').click(clickFn);
		$('.up').click(function(event) {
			key--;
			if (key<0) {
				key=0;
			};
			var b=key*-180;
			$('.smallImg').stop().animate({'left':b}, 600);
		});*/
	//收起地址js
	var serviceolHeight = $(".serviceol").height();
    $(".serviceol").css('height','90px');
	var i=false;
	$('.pack').click(function(event) {
		if(i){
				$(".serviceol").animate({height:"90px"},200)
				$(this).html('展开更多信息+');
				i=false;
			}else{
				$(".serviceol").animate({height:serviceolHeight},200)
				$(this).html('收起');
				i=true;
			}
		
	});
/*	var imglength=$('.imgList li').length;
	$('.inCarousel ul').css('width', imglength*782+782);
	var imgKey=0;
	var timer;
	var firstLi=$('.imgList li:first').clone(true);
	$('.imgList').append(firstLi);*/

	/*function nextFn(){
		imgKey++;
			if(imgKey>imglength){
				imgKey=1;
				$('.imgList').css('left', 0);

			}
			var s=imgKey*-782;
			$('.imgList').stop(true).animate({'left':s}, 600);
	}*/
	/*$('.rightBtn').click(nextFn);
	$('.leftBtn').click(function(event) {
			imgKey--;
			if(imgKey<0){
				imgKey=imglength-1;
				$('.imgList').css('left', -imglength*782);
			}
			var s=imgKey*-782;
			$('.imgList').stop(true).animate({'left':s}, 600);

		});
	timer=setInterval(nextFn, 2500);

	$('.carousel').hover(function() {
		clearInterval(timer);
	}, function() {
		clearInterval(timer);
		timer=setInterval(nextFn, 2500);
	});*/
	
	
	var aImg=$('.mediumImg li');
		$('.mediumImg li').addClass('dis');
		$('.mediumImg li:first').removeClass('dis');
		$('.smallImg li').click(function(event) {		
			var i=$(this).index();
			aImg.eq(i).attr('class','current');
			aImg.eq(i).siblings().attr('class', 'dis');
			$(this).addClass('current').siblings('').removeClass('current');
		});

});