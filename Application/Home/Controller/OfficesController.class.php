<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/7
 * Time: 21:04
 */
namespace Home\Controller;
use Think\Controller;


class OfficesController extends Controller {
    /*办公室列表页面*/
    public function index (){
    	//获取选中的地区
		$se_region = session('region');
		if(!$se_region){
			$se_region = 321;//默认上海
			session('region',$se_region);
		}

		//读取数据
		$lists = D('Resources')->lists($se_region);
		if ($lists) {
			
		}
		unset($v);
		$this->assign('lists', $lists);
        $this->display();
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