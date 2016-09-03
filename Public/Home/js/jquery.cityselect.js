(function($){
	
	$.fn.citySelect=function(settings){		
		//if(this.length<1){return;};

		// 默认值
		settings=$.extend({
			city_json:null,
			area_json:null,
			trading_json:null
		},settings);
		var box_obj=this;
		//城市默认值
		var city_obj=box_obj.find("#city");
		var area_obj=box_obj.find("#area");
		var trading_obj=box_obj.find("#trading");
		
		//读取城市JSON
		var city_json = settings.city_json;
		var area_json = settings.area_json;
		var trading_json = settings.trading_json;
		//设置默认值
		var city_val = box_obj.find("input[name='city']").val();
		var area_val = box_obj.find("input[name='area']").val();
		var trading_val= box_obj.find("input[name='trading']").val();
		//给城市复制Click
		city_obj.find('.dropdown-menu').on("click","li", function() {
		    var self = $(this);
			var labelId = self.parent().attr('aria-labelledby');			
			var labelInfo = self.attr('label');
			var labelValue = self.attr('value');
			//更新 城市选择
			box_obj.find("input[name='city']").val(labelValue);
			city_val = labelValue;
			$('#' + labelId).html(labelInfo);
			//地区
			areaStart();
			
			//删除其他选中值
			area_obj.find("input[name='area']").val(0);
			area_obj.find("button[type='button']").html('区');
			
			trading_obj.find("input[name='trading']").val(0);
			trading_obj.find("button[type='button']").html('商圈');
			
			trading_obj.find('.dropdown-menu li').remove();
			
		});
		//给区复制Click
		area_obj.find('.dropdown-menu').on("click","li", function() {
			
			
		    var self = $(this);
			var labelId = self.parent().attr('aria-labelledby');			
			var labelInfo = self.attr('label');
			var labelValue = self.attr('value');
			//更新 城市选择
			box_obj.find("input[name='area']").val(labelValue);
			area_val = labelValue;
			$('#' + labelId).html(labelInfo);
			//城市
			tradingStart();
			
			trading_obj.find("input[name='trading']").val(0);
			trading_obj.find("button[type='button']").html('商圈');
		});
		//给商圈复制Click
		trading_obj.find('.dropdown-menu').on("click","li", function() {
		    var self = $(this);
			var labelId = self.parent().attr('aria-labelledby');			
			var labelInfo = self.attr('label');
			var labelValue = self.attr('value');
			//更新 城市选择
			box_obj.find("input[name='trading']").val(labelValue);
			trading_val = labelValue;
			$('#' + labelId).html(labelInfo);
			//城市
			tradingStart();			
		});
		// 赋值市级函数
		var cityStart=function(){
			//输出城市
			city_obj.find('.dropdown-menu').html('')
			$.each(city_json,function(i,item){
				//设置默认值
				if(city_val == item.region_id){
					var labelId = city_obj.find('.dropdown-menu').attr('aria-labelledby');			
					$('#' + labelId).html(item.region_name);
				}
				city_obj.find('.dropdown-menu').append('<li value="' + item.region_id + '" label="' + item.region_name + '">' + item.region_name + '</li>');					
			})
		};
		// 赋值区级函数
		var areaStart=function(){
			
			area_obj.find('.dropdown-menu-ul').html('')
			$.each(area_json,function(i,item){
				if(city_val == item.parent_id){
					//设置默认值
					if(area_val == item.region_id){
						var labelId = area_obj.find('.dropdown-menu-ul').attr('aria-labelledby');			
						$('#' + labelId).html(item.region_name);
					}
					area_obj.find('.dropdown-menu-ul').append('<li value="' + item.region_id + '" label="' + item.region_name + '">' + item.region_name + '</li>');			
				}
			})
			
			var ulheight = area_obj.find('.dropdown-menu-ul').actual('height');
			console.log(ulheight)
			if(ulheight>=300){
				area_obj.find('.dropdown-menu').addClass('district');
			}else{
				area_obj.find('.dropdown-menu').removeClass('district');
			}
		};
		// 赋值商圈函数
		var tradingStart=function(){
			trading_obj.find('.dropdown-menu').html('')
			$.each(trading_json,function(i,item){
				if(area_val == item.area){
					//设置默认值
					if(trading_val == item.id){
						var labelId = trading_obj.find('.dropdown-menu').attr('aria-labelledby');			
						$('#' + labelId).html(item.name);
					}
					trading_obj.find('.dropdown-menu').append('<li value="' + item.id + '" label="' + item.name + '">' + item.name + '</li>');					
				}

			})
		};

		
		var init=function(){
			//默认载入城市
			cityStart();	
			//设置默认值
			if(city_val>0){
				areaStart();
				tradingStart();
			}
		};
		//执行函数
		init();
	};
})(jQuery);