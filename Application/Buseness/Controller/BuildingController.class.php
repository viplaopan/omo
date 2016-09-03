<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/6/28
 * Time: 9:23
 */
namespace Buseness\Controller;
class BuildingController extends HomeController {
    public function index($id = 0,$step = 0){
    	//楼宇信息
        if ($id) {
            $resources = D('Resources')->where(array('id' => $id, 'uid' => UID))->find();
			session('resourcesStep',$resources['step']);
        }

		if($resources){
            $this->assign('info', $resources);
			$s = $resources['step'];
		}else{
			$s = 0;//代表
		}
        //step2
        if ($step == 2) {
            $typeinfo = D('ResourcesType')->where(array('rid' => $id))->select();
			foreach ($typeinfo as $v) {
	            if ($v['type'] == 1){
	                $this->assign('type1', $v);
	            }
	            if ($v['type'] == 2){
	                $this->assign('type2', $v);
	            }
	            if ($v['type'] == 3){
	                $this->assign('type3', $v);
	            }
	            if ($v['type'] == 4){
	                $this->assign('type4', $v);
	            }
	            if ($v['type'] == 5){
	                $this->assign('type5', $v);
	            }
	            if ($v['type'] == 6){
	                $this->assign('type6', $v);
	            }
	        }
			$this->assign('typeinfo', $typeinfo);
        }
		//step3
        if ($step == 3) {
			$services = D('Service')->where()->select();
			$this->assign('services',$services);
			//外边图片
			$outsides = D('ResourcesImages')->where('rid = ' . $id . ' AND type = 1')->select();
			$this->assign('outsides',$outsides);
			//内部图片
			$insides = D('ResourcesImages')->where('rid = ' . $id . ' AND type = 2')->select();
			$this->assign('insides',$insides);
			
			//服务设施
			$rservice = D('ResourcesService')->where('rid = ' . $id)->select();//先删除
			$rsarr = array();
			foreach($rservice as $val){
				$rsarr[$val['sid']] = 1;
			}
		
			$this->assign('rservice',$rsarr);
		}
		//step3
        if ($step == 4) {
			$traffic = D('ResourcesTraffic')->where('rid =' . $id)->find();

			$this->assign('traffic',$traffic);
		}
		//step5 
        if ($step == 5) {
        	//读取默认联系人信息
        	$resConts = D('ResourcesContacts')->where('uid =' . UID)-> order('id desc') -> select();
			$carr = array();
			foreach($resConts as $key=>&$val){
				$carr[$val['type']][$key] = $val;
			}

			$this->assign('resConts',$resConts);
			
			//读取默认联系人信息
        	$contents = D('ResCon')->where('rid =' . $id)-> order('cid desc') -> select();
			$cselectarr = array();
			foreach($contents as $key=>&$val){
				$coninfo = D('ResourcesContacts')->where('id = '.$val['cid'])->find();
				$coninfo['rcid'] = $val['id'];
				$cselectarr[$val['type']][$key] = $coninfo;
			}
 
			$this->assign('carr',$cselectarr);
		}
		$this->assign('step',$s);

    	//读取城市地区商圈
        $trading_area = D('TradingArea')->getField('area',true);
        $regmap['region_id'] = array('in',$trading_area);
        $regmap['region_type'] = 3;
        $area = D('region')->where($regmap)->select();
		$city = D('region')->where('region_type = 2 and status = 1')->select();
		$trading = D('TradingArea')->where('status = 1')->select();

		$this->assign('city',json_encode($city));
		$this->assign('area',json_encode($area));
		$this->assign('trading',json_encode($trading));
		$this->assign('resources',$resources);
        $this->display();
    }
    //添加大楼信息
    public function step($s = 1){
        if (!IS_POST) {
        	$this->error('非法操作');
		}
		//获取提交的多条数据
        $id = I('post.id');
    	//第一步
    	if($s == 1){
            $res = D('Resources')->step1($id);
			if($res){
				$this->success('提交成功',U('index',array('step'=>2,'id'=>$id?$id:$res)));
			}
    	}
		if(!$id){
			$this->error('您还没有到这一步，请返回重新填写',U('index',array('step'=>1)));
		}
        //第二步
        if ($s == 2) {
            $res = D('Resources')->step2($id);
			//添加后页面跳转
			if($res){
				$this->success('提交成功',U('index',array('step'=>3,'id'=>$id)));
			}
        }
		if ($s == 3) {
			$res = D('Resources')->step3($id);
			if($res){
				$this->success('提交成功',U('index',array('step'=>4,'id'=>$id)));
			}
		}
		if ($s == 4) {
			$res = D('Resources')->step4($id);
			if($res){
				$this->success('提交成功',U('index',array('step'=>5,'id'=>$id)));
			}
		}
		if ($s == 5) {
			$res = D('Resources')->step5($id);
			if($res){
				$this->success('提交成功',U('Building/lists'));
			}
		}
    }
    //
    public function lists(){
        $sql = D('Home/Resources');
        //已发布信息个数
        $order = 'create_time desc';

        $lists = $sql->where(array('uid' => UID))->lists(null, $order, null);
		
		

        $count = $sql->where(array('uid' => UID))->listCount(null);
        //删除
        if ($_POST) {
            $rid = I('post.id');
            if ($rid) {
                $res = $sql->delete($rid);
            }
            if ($res) {
                $this->ajaxReturn(1);
            }
        }

        $this->assign('lists', $lists);
        $this->assign('count', $count);
        $this->display();
    }
	//编辑联系人
	public function doContacts(){
		$id = I('post.id');
		$isEdit = $id?1:0;
		if(IS_POST){
			if($isEdit){
				
				//更新主表信息
				$data = D('ResourcesContacts') -> create();
				$res = D('ResourcesContacts')->where('id  = ' . $id)->save($data);
				$return['status'] = 1;
				$return['isEdit'] = 1;
				$return['id'] = $id;
				$return['type'] = $data['type'];
				$this->ajaxReturn($return);
				
			}else{
				//更新主表信息
				$data = D('ResourcesContacts') -> create();
	
				$data['uid'] = UID;
			    unset($data['id']);
				$res = D('ResourcesContacts') ->add($data);
				if($res){
					$return['status'] = 1;
					$return['isEdit'] = 0;
					$return['uid'] = $res;
					$return['type'] = $data['type'];
					$this->ajaxReturn($return);
				}
			}
		}
	}
	//删除联系人
	public function delContacts(){
		if(IS_POST){
			$id = I('post.id');
		
			//删除数据
			if($id){
				$res = D('ResCon')->where('id =' . $id) -> delete();
			}
			if($res){
				$this->success();
			}
		}
	}
	public function editContacts(){
		if(IS_POST){
			$id = I('post.id');
			
			//编辑数据
			if($id){
				$res = D('ResourcesContacts')->where('id =' . $id) -> find();
			}
			$this->ajaxReturn($res,'JSON');
		}
	}
	public function addContentTores(){
		if(IS_POST){
			$agrees = I('post.agree');
			$data = array();
			foreach($agrees as $key=>$val){
				$data[$key]['cid'] = $val;
				$data[$key]['rid'] = I("post.rid");
				$data[$key]['type'] = I("post.type");
				$data[$key]['status'] = 1;
			}
			$res = D('ResCon') -> addAll($data);
			if($res){
				$this->success('提交成功');
			}
			
		}
	}
	//编辑修改 房源工位
	public function editPosition($rid = 0){
		if(IS_POST){
			$id = I('post.id');
			$isEdit = $id?1:0;
			$data = D('ResourcesPosition') -> create();
			
			$data['actual_time'] = $data['actual_time'] == 'on'? 1 : 0;
			$data['promotion'] = $data['promotion'] == 'on'? 1 : 0;
			
			if($data){
				if($isEdit){
					$position = D('ResourcesPosition')->where(array('id'=>$id))->find();
					$rid = $position['rid'];
					$res = D('ResourcesPosition') ->where(array(array('id'=>$id,'uid'=>UID))) -> save($data);
				}else{
					
					
					$data['rid'] = $rid;
					$res = D('ResourcesPosition') -> add($data);
					$id = $res;
					
					//判断是否第一次保存成功
					$count = D('ResourcesPosition')->where(array('rid'=>$rid))->count();
					if($count > 0){
						$data2['status'] = 2;
						D('Resources')->where(array('id'=>$rid))->save($data2);
					}
				}
				
			}
			
			
			if($res){
				//楼宇外部图片
				$resourcePosition = I('post.resourcePosition');
				if(!empty($resourcePosition)){
					D('PositionImages')->where('pid = ' . $id . ' AND type = 1')->delete();//先删除			
					$inside = array();
					foreach($resourcePosition as $key=>$val){
						$inside[$key]['path'] = $val;
						$inside[$key]['type'] = 1; //1：代表内部图片
						$inside[$key]['pid'] = $id;
					}
					D('PositionImages')->addAll($inside);
				}
				$this->success('提交成功',U('position',array('rid'=>$rid)));
			}else{
				$this->error('提交错误',U('position',array('rid'=>$rid)));
			}
			
		}else{
			$rid = I('get.rid');
			$id = I('get.id');
			$isEdit = $id?1:0;
			
			if($isEdit){
				$position = D('ResourcesPosition')->where(array('id'=>$id))->find();
				$position['start_time'] = $position['start_time']?date('Y-m-d',$position['start_time']):date('Y-m-d',time());
				$position['end_time'] = $position['end_time']?date('Y-m-d',$position['end_time']):date('Y-m-d',time());
				$rid = $position['rid'];
				//读取图片
				$pimgs = D('PositionImages')->where('pid = '.$id)->select();
				$this->assign('pimgs',$pimgs);
			}
			$this->assign('position',$position);
			
			//获取类型
			$typeList = D("ResourcesType")->where('rid = ' . $rid)->select();
			$this->assign('typeList',$typeList);
			$this->display();
		}
	}
	function position($rid = 0){
		//读取数据
		$lists = D('ResourcesPosition')->where(array('rid'=>$rid))->select();
		foreach($lists as &$val){
			$val['typeTitle'] = $val['type'] == 1?'办公室':'会议室';
			$val['promotionTitle'] = $val['promotion'] == 1?'促销中':'暂无';
			//按照工位
			if(!empty($val['month'])){
				if($val['promotion'] == 1){
					$val['monthTitle'] = '￥' .$val['mprom']. '/' .$val['workplace']. '位/月';
				}else{
					$val['monthTitle'] = '￥' .$val['month']. '/' .$val['workplace']. '位/月';
				}
			}
			//按照工位
			if(!empty($val['hour'])){
				if($val['promotion'] == 1){
					$val['hourTitle'] = '￥' .$val['hprom']. '/' .$val['workplace']. '位/小时';
				}else{
					
				}
				
			}
			//读取图片
			$img = D('PositionImages')->where(array('pid'=>$val['id']))->order('id asc')->find();
			$val['imgPath'] = grace_path($img['path'],'Position');
		}
		unset($val);
		$this->assign('lists',$lists);
		$this->assign('empty','<h1>没有发现房源!</h1>');
		$this->display();
	}
	function del($id = 0){
		$res = D('ResourcesPosition')->where(array(array('id'=>$id),array('uid'=>UID)))->delete();
		if($res){
			//判断是否第一次保存成功
			$count = D('ResourcesPosition')->where(array('rid'=>$rid))->count();
			if($count == 0){
				$data['status'] = 0;
				D('Resources')->where(array('id'=>$rid))->save($data);
			}
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
}