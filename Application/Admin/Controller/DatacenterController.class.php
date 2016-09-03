<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-14
 * Time: AM10:59
 */

namespace Admin\Controller;

use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;
use Admin\Builder\AdminSortBuilder;

class DatacenterController extends AdminController
{
	/* 商圈列表 */
	public function index($page = 1, $r = 20)
    {
		$se_region = session('region');
        $map['status'] = array('EGT', 0);
		$map['region'] = array('EQ', $se_region);
        $model = M('TradingArea');
        $lists = $model->where($map)->page($page, $r)->order('id asc')->select();
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('商圈列表')
            ->buttonNew(U('editTrading'))
            ->buttonDelete()
            ->setStatusUrl(U('setTradingStatus'))
            ->buttonEnable()
            ->buttonDisable()
            ->keyId()
            ->keyText('name', '商圈名称')
            ->keyText('sort', '排序')
            ->keyStatus()->keyDoActionEdit('editTrading?id=###')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
    }
	//商圈状态
	public function setTradingStatus($ids, $status){
		$builder = new AdminListBuilder();
        $builder->doSetStatus('TradingArea', $ids, $status);
	}
	//编辑商圈
	public function editTrading($id = 0){
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		if(IS_POST){
			if ($isEdit) {
				$data = D('TradingArea')->create();
	            $res = D('TradingArea')->save($data);
	        } else {
	            $data = D('TradingArea')->create();
				$se_region = session('region');
				$data['city'] = $se_region;
				$res = D('TradingArea')->add($data);
	        }
			if(!$res){
				$this->error($isEdit ? '编辑失败' : '创建失败');
			}
			//显示成功信息，并返回规则列表
            $this->success($isEdit ? '编辑成功' : '创建成功', U('index'));
		}else{
			//读取商圈内容
	        if ($isEdit) {
	            $TradingArea = M('TradingArea')->where('id = ' . $id)->find();
				$se_region = $TradingArea['city'];
	        } else {
	        	//读取地区地址
				$se_region = session('region');
	            $TradingArea['status'] = 1;
	        }
			
			$this->assign('info',$TradingArea);
			

			$area = M('Region')->where('parent_id = ' . $se_region)->select();
			$this->assign('area',$area);
			
			$this->display();
		}
	}
	
	
	
	/* 商圈列表 */
	public function citylists($page = 1, $r = 20)
    {
        $map['status'] = array('EQ', 1);
        $model = M('Region');
        $lists = $model->where($map)->page($page, $r)->select();
		foreach($lists as &$val){
			$val['id'] = $val['region_id'];
		}
		unset($val);
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('商圈列表')
            ->buttonNew(U('editCity'))
            ->buttonDelete()
            ->setStatusUrl(U('setCityStatus',array('status'=>0)))
            ->buttonEnable()
            ->buttonDisable()
            ->keyId()
            ->keyText('region_id', '商圈名称')
            ->keyText('region_name', '城市名称')
            ->keyStatus()
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
    }
	//添加城市
	public function editCity(){
		if(IS_POST){
			$area = I('post.area');
			if($area){				
				$data['status'] = 1;
				M('Region')->where('region_id = '.$area)->save($data);
				$this->success('编辑成功');
			}
			else{
				$this->error('编辑失败');
			}
		}else{
			//读取城市
			$regions = M('Region')->select();
			$this -> assign('regions',json_encode($regions));
			$this -> display();
		}
	}
	//设置默认城市
	public function setCityStatus($ids, $status){
		$builder = new AdminListBuilder();
		$data['status'] = 0;
        M('Region')->where(array('region_id'=>array('in',$ids)))->save($data);
		$this->success('编辑成功');
	}
	
	


	//服务列表
    public function service($page = 1, $r = 20, $cate = 0)
    {
        //读取规则列表
        $map = array('status' => array('EGT', 0));
		$map['cate'] = $cate;
        $model = M('Service');
        $lists = $model->where($map)->page($page, $r)->order('sort asc')->select();
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('服务列表')
            ->setStatusUrl(U('setRuleStatus'))->buttonEnable()->buttonDisable()->buttonDelete()
            ->buttonNew(U('editService'))
            ->keyId()->keyText('title','服务名称')->keyText('sort','排序')
            ->keyStatus()->keyDoActionEdit('editService?id=###')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
    }
	//编辑商圈
	public function editService($id = 0){
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		if(IS_POST){
			if ($isEdit) {
				$data = D('Service')->create();
	            $res = D('Service')->save($data);
	        } else {
	            $data = D('Service')->create();
				$res = D('Service')->add($data);
	        }
			if(!$res){
				$this->error($isEdit ? '编辑失败' : '创建失败');
			}
			//显示成功信息
            $this->success($isEdit ? '编辑成功' : '创建成功', U('index'));
		}else{
			//读取楼宇内容
	        if ($isEdit) {
	            $data = M('Service')->where(array('id' => $id))->find();
	        } else {
	            $data['status'] = 1;
	        }
			
			//显示页面
	        $builder = new AdminConfigBuilder();
	        $builder->title($isEdit ? '编辑规则' : '添加规则')
	            ->keyId()
                ->keyText('title', '服务名称')
				->keyText('sort', '排序')
	            ->keyStatus()
	            ->data($data)
	            ->buttonSubmit(U('editService'))->buttonBack()
	            ->display();
			
		}
	}
}