<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/7
 * Time: 21:04
 */
namespace Home\Controller;
use Think\Controller;


class OfficesController extends HomeController {
    /*办公室列表页面*/
    public function index (){
    	$resourcesModel = D('Resources');

    	//搜索条件
    	$area = I('get.area');//地区
    	if(!empty($area)){
    		$tradingArea_ids = D('tradingArea')->where('area = ' . $area)->getField('id',true);
    		$map['trading_area'] = array('in', $tradingArea_ids);
    		$region = D('Region')->find($area);
    		$this->assign('_region',$region);
    	}
    	$trading = I('get.trading');//商圈
    	if(!empty($trading)){
    		$map['trading_area'] = $trading;
    		$tradingArea = D('tradingArea')->find($trading);
    		$this->assign('_trading',$tradingArea);
    	}
    	//类型
    	$type = I('get.type');
        if(!empty($type)){
        	$map['b.type'] = $type;
    		$resourcesModel = $resourcesModel->join('__RESOURCES_TYPE__ AS b ON __RESOURCES__.id = b.rid','RIGHT');
    		$this->assign('_type',$type);
    	}
    	//时间
		$time = I('get.time');
        if(!empty($time)){
        	
    	}


		//人数
		$count = I('get.count');
        if(!empty($count)){
        	//人数小于5为
        	if($count == 1){
        		$map['b.workplace'] = array('lt', 5);
        	}
        	//人数在5-15
        	if($count == 2){
        		$map['b.workplace']  = array('between',array('1','15'));
        	}
        	//人数在5-15
        	if($count == 3){
        		$map['b.workplace']  = array('gt', 15);
        	}
    	
    	}
        //面积
        $mianji = I('get.mianji');
        if(!empty($mianji)){
            if($mianji == 1){
                
            }
        }
    	//搜索END
    	//获取选中的地区
		$se_region = session('region');
		if(!$se_region){
			$se_region = 321;//默认上海
			session('region',$se_region);
		}

        if($count or $mianji){
            $resourcesModel = $resourcesModel->join('__RESOURCES_POSITION__ AS b ON ' .C('DB_PREFIX') .  'resources.id = b.rid','RIGHT');
        }
		//读取数据
		$lists = $resourcesModel->field(C('DB_PREFIX') . 'resources.*')->where($map)->lists($se_region);

		if ($lists) {
			
		}
		unset($v);
		$this->assign('lists', $lists);

		//读取城市地区商圈
        $trading_area = D('TradingArea')->getField('area',true);
        $regmap['region_id'] = array('in',$trading_area);
        $regmap['region_type'] = 3;
        $regmap['parent_id'] = 321;
        $area = D('region')->where($regmap)->select();
        $this->assign('area', $area);
		$trading = D('TradingArea')->where('city = 321 and status = 1')->select();
		$this->assign('trading', json_encode($trading));
		//获取城市
		$city = D('region')->where('region_type = 2 and status = 1')->select();
		$this->assign('city', $city);

		//获取类型
		$resTypes = C('RES_TYPE');
		$this->assign('resTypes',$resTypes);
        $this->display();
    }
    public function get_trading($area_id = 0){

    	$trading = D('TradingArea')->where('area = ' + $area_id + ', status = 1')->select();
    	$this->ajaxReturn ($trading,'JSON');

    }
    /*办公室详情页面*/
    public function detail($id = 0){
    	//获取楼宇信息
		$info = D('Resources')->detail($id);
		$this->assign('info',$info);
		
		//获取楼宇外部图片
		$outSide = D('ResourcesImages')->where(array('rid' => $id))->select();
		$this->assign('outSide',$outSide);
		
		//获取楼宇服务设施
		$services = D('ResourcesService')->where(array('rid' => $id))->getField('service_name', true);
		
		$this->assign('services',$services);
		
		//获取促销工位信息
		$promotions = D('Resources')->position_lists($id,1);
		$this->assign('promotions',$promotions);
		
		//获取促销工位信息
		$actuals = D('Resources')->position_lists($id);
		$this->assign('actuals',$actuals);
		
		
		$empty = '<div class="in-no-office">' . '<img src="../images/not_office.jpg">' . '<a href="javascript:;">查看其他</a>' . '</div>';
                        
        $this->assign('empty',$empty);  
                      
		
        $this->display();
    }
}