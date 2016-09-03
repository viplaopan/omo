$(function() {

//	$('.contactLeft ul li').click(function(event) {
//		if ($(this).hasClass('disabled')) {
//			$(this).children('a').css('cursor', 'default');
//		}else{
//			$(this).addClass('current').siblings().removeClass('current');
//			var index = $('.contactLeft ul li').index(this);
//			$('.contactCenter ol li').hide()
//			$('.contactCenter ol li.step').eq(index).show();
//		};
//		
//	});

	
//	$('.check').click(function(event) {
//		
//		var self = $(this);
//		if (self.hasClass('selected')) {
//			self.next().show();
//			var data = self.attr('data-type');
//			self.find("input[type='hidden']").val(data);
//		}else{
//			self.find("input[type='hidden']").val('');
//			self.next().hide();
//		};
//	});	

//	//点击城市
//	$('#city .dropdown-menu li').click(function(){
//		var city = $(this).attr('value');
//		$('#area .dropdown-menu').html('');
//		//输出地区
//		$.each(areajson,function(i,item){
//			if(item.parent_id == city){
//				$('#area .dropdown-menu').append('<li value="' + item.region_id + '" label="' + item.region_name + '">' + item.region_name + '</li>')
//			}
//		})
//		//点击地区
//		$('#area .dropdown-menu li').click(function(){
//			var self = $(this);
//			var label = self.parent().attr('aria-labelledby');
//			
//			var city = self.attr('label');
//			$('#' + label).html(city)
//			//输出商圈
//			var area = $(this).attr('value');
//			$('#trading .dropdown-menu').html('')
//			$.each(tradingjson,function(i,item){
//				if(item.area == area){
//					$('#trading .dropdown-menu').append('<li value="' + item.id + '" label="' + item.name + '">' + item.name + '</li>')
//				}
//			})
//			
//			//商圈点击
//			$('#trading .dropdown-menu li').click(function(){
//				var self = $(this);
//				var label = self.parent().attr('aria-labelledby');
//				
//				var city = self.attr('label');
//				$('#' + label).html(city)
//			})
//			
//		})
//	})
	$('.dropdown-menu li').click(function(){
		var v = $(this).attr('value');
		$(this).parent().next().val(v);
	})

	
	

});