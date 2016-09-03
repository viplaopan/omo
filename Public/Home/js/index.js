$(function() {
	$('.issue').click(function(event) {
		$(this).addClass('is')
		var obj = $(this);
		obj.next().show();
		obj.next().find('dd').click(function(){
			var value = $(this).html();
			obj.html(value);
			obj.css('color', '#111');
			obj.next().find('dd').css({
				backgroundColor: '#fff',
				color: '#000',
			});
			$(this).css({
				backgroundColor: '#13aced',
				color: '#fff'
			});

			obj.next().hide();
		});
		
		obj.next().mouseleave(function(event) {
			obj.next().hide();
			obj.unbind('mouseenter')
			$('.issue').removeClass('is')
		});
		$('.dropdown').hover(function() {
			$(this).children('dl').css('display', 'none');
		}, function() {
			$(this).children('dl').css('display', 'none');
			$(this).children('.issue').removeClass('is')
		});		obj.mouseenter(function(event) {
			obj.next().show();
		});
		

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
		//判断滚轴滚到simple位置时进行数字变化
		var simTop=$('.simple').offset().top;
		if (scollnum>simTop-400 && turff == 1) {
				turff = 0;
				numrun();
		};
		if (scollnum<simTop-400 && turff == 0) {
				turff = 1;
		};
	})

	//数字动态变化
	

	function numrun(){
		var a_num=$("#count_1").text();
		var b_num=$("#count_2").text();
		var c_num=$("#count_3").text();
		var d_num=$("#count_4").text();
		var a=0,b=0,c=0,d=0;
		var change_a=function(){
			$("#count_1").text(a);
			if(a<a_num){
				a++;
			}else{
				clearInterval(crear_a)
			}
		}
		var change_b=function(){
			$("#count_2").text(b);
			if(b<b_num){
				b++;
			}else{
				b==0;
				clearInterval(crear_b)
			}
		}
		var change_c=function(){
			$("#count_3").text(c);
			if(c<c_num){
				c++;
			}else{
				clearInterval(crear_c)
			}
		}
		var change_d=function(){
			$("#count_4").text(d);
			if(d<d_num){
				d++;
			}else{
				d==0;
				clearInterval(crear_d)
			}
		}
		var crear_a=setInterval(change_a,(1200/a_num));
		var crear_b=setInterval(change_b,(1500/b_num));
		var crear_c=setInterval(change_c,(1000/c_num));
		var crear_d=setInterval(change_d,(1500/d_num));
			
	}


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
		//判断滚轴滚到simple位置时进行数字变化
		var simTop=$('.simple').offset().top;
		if (scollnum>simTop-400 && turff == 1) {
				turff = 0;
				numrun();
		};
		if (scollnum<simTop-400 && turff == 0) {
				turff = 1;
		};
	})
	

});
