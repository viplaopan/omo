$(function() {
	//step1
	$("#step1").validate({
		rules: {
			city: {
				required: true,
			},
			area: {
				required: true,
			},
			address: {
				required: true,
			},

			title: {
				required: true,
			}

		},
		messages: {
			city: {
				required: " *必填!",
			},
			area: {
				required: " *必填!",

			},
			address: {
				required: "必填!",
			},

			title: {
				required: "必填!",
			}
		},
		errorPlacement: function(error, element) { //错误信息位置设置方法
			if (element.attr('name') == 'city' || element.attr('name') == 'area' || element.attr('name') == 'trading') {
				$('#errmsg').html('');
				error.appendTo($('#errmsg'));
			} else if (element.attr('name') == 'address') {
				error.appendTo($("#huang")); //这里的element是录入数据的对象
			} else if (element.attr('name') == 'title') {
				error.appendTo($("#hao")); //这里的element是录入数据的对象
			} else {
				error.appendTo($("#wei"));
			}
		},
		debug: false,
		submitHandler: function(form) {
			var self = $('#step1');
			$.post(self.attr("action"), self.serialize(), success, "json");
			return false;

			function success(data) {
				if (data.status == 1) {
					//window.location.href = '{:U("Building/index",array(id=>"+data+"))}';
					window.location.href = data.url;
				}
			}
		}
	});

})
var titleArray = new Array();
titleArray[1] = {
	in_serve_all: '总共<em>*</em>',
	in_serve_low_price:'每工位最低月单价（元）<em class="err">*</em>',
	in_serve_small:'最小房间<em>*</em>',
	in_serve_height_price:'每工位最高单价（元）<em>*</em>',
	in_serve_big:'最大房间<em>*</em>',
}
titleArray[2] = {
	in_serve_all: '总面积<em>*</em>',
	in_serve_low_price:'每平方米每天（元）<em>*</em>',
	in_serve_small:'最小房间<em>*</em>',
	in_serve_height_price:'每平方米每天（元）<em>*</em>',
	in_serve_big:'最大房间<em>*</em>',
}
$(function() {
	//step2
	//规则定义
	var rules = new Array();
	var message = {
		all: {
			required: '必填!',
			number: '必须是数字',
		},
		low_price: {
			required: '必填!',
			number: '必须是数字',
		},
		small: {
			required: '必填!',
			number: '必须是数字',
		},
		height_price: {
			required: '必填!',
			number: '必须是数字',
		},
		big: {
			required: '必填!',
			number: '必须是数字',
		},
		meeting_most: {
			required: '必填!',
			number: '必须是数字',
		},
		meeting_price: {
			required: '必填!',
			number: '必须是数字',
		},
		shopfront: {
			required: '必填!',
			number: '必须是数字',
		},
		store_price: {
			required: '必填!',
			number: '必须是数字',
		},
		biggest: {
			required: '必填!',
			number: '必须是数字',
		},
		share_price: {
			required: '必填!',
			number: '必须是数字',
		},
		share_purpose: {
			required: '必填!',
			number: '必须是数字',
		},
		share_desc: {
			required: '必填!',
			number: '自我描述必须填写！',
		},
	};
	rules[1] = {
		focusInvalid: true,
		rules: {
			all: {
				required: true,
				number: true,
			},
			low_price: {
				required: true,
				number: true,
			},
			small: {
				required: true,
				number: true,
			},
			height_price: {
				required: true,
				number: true,
			},
			big: {
				required: true,
				number: true,
			}
		},
		messages: message,
		errorPlacement: function(error, element) { //错误信息位置设置方法
			error.appendTo(element.prev('p').find('em')); //这里的element是录入数据的对象

		},
	};
	rules[2] = {
		focusInvalid: true,
		rules: {
			all: {
				required: true,
				number: true,
			},
			low_price: {
				required: true,
				number: true,
			},
			small: {
				required: true,
				number: true,
			},
			height_price: {
				required: true,
				number: true,
			},
			big: {
				required: true,
				number: true,
			}
		},
		messages: message,
		errorPlacement: function(error, element) { //错误信息位置设置方法
			error.appendTo(element.prev('p').find('em')); //这里的element是录入数据的对象

		},
	};
	rules[3] = {
		focusInvalid: true,
		rules: {
			all: {
				required: true,
				number: true,
			},
			low_price: {
				required: true,
				number: true,
			},
			small: {
				required: true,
				number: true,
			},
			height_price: {
				required: true,
				number: true,
			},
			big: {
				required: true,
				number: true,
			}
		},
		messages: message,
		errorPlacement: function(error, element) { //错误信息位置设置方法
			error.appendTo(element.prev('p').find('em')); //这里的element是录入数据的对象

		},
	};
	rules[4] = {
		focusInvalid: true,
		rules: {
			meeting_most: {
				required: true,
				number: true,
			},
			meeting_price: {
				required: true,
				number: true,
			}
		},
		messages: message,
		errorPlacement: function(error, element) { //错误信息位置设置方法
			error.appendTo(element.prev('p').find('em')); //这里的element是录入数据的对象

		},
	};
	rules[5] = {
		focusInvalid: true,
		rules: {
			shopfront: {
				required: true,
				number: true,
			},
			store_price: {
				required: true,
				number: true,
			}
		},
		messages: message,
		errorPlacement: function(error, element) { //错误信息位置设置方法
			error.appendTo(element.prev('p').find('em')); //这里的element是录入数据的对象

		},
	};
	rules[6] = {
		focusInvalid: true,
		rules: {
			biggest: {
				required: true,
				number: true,
			},
			share_price: {
				required: true,
				number: true,
			},
			share_purpose: {
				required: true,
				number: true,
			},
			share_desc: {
				required: true,
				number: true,
			}
		},
		messages: message,
		errorPlacement: function(error, element) { //错误信息位置设置方法
			error.appendTo(element.prev('p').find('em')); //这里的element是录入数据的对象

		},
	};
	//提交并验证表单
	$("#step2").submit(function() {
		var ajaxUrl = $(this).attr('action');

		$.post(ajaxUrl, $(this).serialize(), function(dd) {
			if (dd.status == 1) {
				window.location.href = dd.url;
			}
		}, 'json');
		return false;

		
	});
	
	function checkData() {
		var leng = $("input[class='typeTitle'][checked='checked']").length;
		if (leng <= 0) {
			var allmsg = '请选择办公类型!';
			alert(allmsg);
			return false;
		}
		return true;
	}
	//下拉菜单
	$('.in-serve-space.dropdown li').click(function(event) {
		var self = $(this);
		var refItem = self.parent().parent();
		var ref = refItem.attr('ref');//分辨表单
		
		var inserve = $('#in-serve-' + ref);//表单

		var value = $(this).attr('value');
		
		$.each(titleArray[value], function(i,item) {
			inserve.find('.' + i).html(item);
		});
		
		
		
	});
})