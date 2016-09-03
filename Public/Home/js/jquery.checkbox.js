(function($){
	
	$.fn.omoCheckbox=function(settings){

		if(this.length<1){return;};

		// 默认值
		settings=$.extend({
			
		},settings);
		var cbox = this;
		//替换元素 check事件
		$(document).on("click",".check",function(){  
          	if ($(this).hasClass('selected')) {
          		$(this).find("input[type='checkbox']").removeAttr('checked');
          		
				$(this).removeClass('selected');
			}else{
				$(this).find("input[type='checkbox']").attr('checked',true);
				$(this).addClass('selected');
				
			};
			$(this).find("input[type='checkbox']").change()
        })  
        var cityStart=function(){
			alert()
		};
		var init=function(){
			//循环网页中 所有checkbox
			$.each($(cbox),function(i,item){
				//获取checkbox 本身
	
				//初查看checkbox是否被选中
				var checked = $(item).attr('checked');
				var label = $(item).attr('label');
				
				//隐藏本身
				$(item).hide();
				//获取本身html元素 checkbox 
				var cboxSelfHtml = $(item).prop('outerHTML');
				
				//判断默认是否选中
				var selected = '';
				if(checked == 'checked'){
					selected = 'selected';
				}else{
					selected = '';
				}
				//替换html元素
				$(item).replaceWith(
					'<div class="check ' + selected + '">' +
					cboxSelfHtml +
					'<label for="checkboxFiveInput"></label>' +
					'<span>' + label + '</span>' +
					'</div>'
				);
			})
		};
		//执行函数
		init();
	};
})(jQuery);