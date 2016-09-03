<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: laopan <laopan@vip.qq.com> <http://laopan.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Model;
use Think\Model;
use Think\Page;

/**
 * 文档基础模型
 */
class ResourcesModel extends Model{

    /* 自动验证规则 */
    protected $_validate = array(

    );

    /* 自动完成规则 */
    protected $_auto = array(
   
    );

    public $page = '';

    /**
     * 获取文档列表
     * @param  integer  $category 分类ID
     * @param  string   $order    排序规则
     * @param  integer  $status   状态
     * @param  boolean  $count    是否返回总数
     * @param  string   $field    字段 true-所有字段
     * @return array              文档列表
     */
    public function lists($city, $order = '`id` DESC', $status = 1, $field = true){
        $map = $this->listMap($city, $status);
		$lists = $this->field($field)->where($map)->order($order)->select();
		$statusArr = array(0=>'未完成',2=>'审核中',1=>'展示中');
		foreach ($lists as $k => &$v) {
			
			$v['status_info'] = $statusArr[$v['status']];
			$v['img'] = D('ResourcesImages')->where(array('rid' => $v['id'], 'type' => 1))->limit(3)->select();
			$v['server'] = D('ResourcesService')->where(array('rid' => $v['id']))->getField('service_name', true);
			//读取最低价格
			$minMonth = D('ResourcesPosition')->where(array('rid'=>$v['id']))->min('month');
			$v['minMonth'] = $minMonth;
			//读取最低价格
			$minHour = D('ResourcesPosition')->where(array('rid'=>$v['id']))->min('hour');
			$v['minHour'] = $minHour;
			
			$zanwu =  ($minHour == '' && $minMonth == '') ? 1 : 0;

			$v['zanwu'] = $zanwu;
			
			//判断是否有促销
			$actual_time = D('ResourcesPosition')->where(array('rid'=>$v['id'],'actual_time'=>1))->count();
			$v['actual_time'] = $actual_time;
			//判断是否有促销
			$promotion = D('ResourcesPosition')->where(array('rid'=>$v['id'],'actual_time'=>1))->count();
			$v['promotion'] = $promotion;
		}
		unset($v);

        return $lists;
		
    }
	
	
    /**
     * 计算列表总数
     * @param  number  $category 分类ID
     * @param  integer $status   状态
     * @return integer           总数
     */
    public function listCount($city, $status = 1){
        $map = $this->listMap($city, $status);
        return $this->where($map)->count('id');
    }

    public function detail($id = 0){
		/* 获取基础数据 */
        $info = $this->field(true)->find($id);
		
		//读取城市信息
		$info['region'] = get_region($info['city']) . '市' . get_region($info['area']);
		
		//获取顾问
		$cinfo = D('res_con')->where(array('type'=>1,'rid'=>$id))->find();
		
		$cinfo = D('ResourcesContacts')->where(array('id'=>$cinfo['cid']))->find();
	
		$cinfo['head'] = '/Uploads/Head/' . $cinfo['head'];
		$info['contact'] = $cinfo;
		
		//读取最低价格
		$minMonth = D('ResourcesPosition')->where(array('rid'=>$id))->min('month');
		
		$info['minMonth'] = $minMonth;
		//读取最低价格
		$minHour = D('ResourcesPosition')->where(array('rid'=>$id))->min('hour');
		$info['minHour'] = $minHour;
		
		
		$zanwu =  ($minHour == '' && $minMonth == '') ? 1 : 0;
        $info['zanwu'] = $zanwu;
		
		return $info;
	}
	
	public function position_lists($id = 0,$promotion =0){
		//判断是否是促销
		if($promotion){
			$map['promotion'] = 1;
		}

		$map['status'] = 1;
		$map['rid'] = $id;
		$lists = D('ResourcesPosition')->where($map)->select();
		
		foreach($lists as &$val){
			//获取封面 第一张图片
			$pimg = D('PositionImages')->where('pid = ' . $val['id'])->field('path')->find();
			$val['cover'] = '/Uploads/Resource/Position/' . $pimg['path'];
			
			//按月
			if(!empty($val['month'])){
				if($val['promotion'] == 1){
					$val['monthTitle'] = $val['month']?$val['month']. '/' .$val['workplace']. '位/月':'暂无';
					$val['promMonthTitle'] = $val['mprom']?$val['mprom']. '/' .$val['workplace']. '位/月':'暂无';
				}else{
					$val['monthTitle'] = $val['month']?$val['month']. '/' .$val['workplace']. '位/月':'暂无';
				}
			}
			//按小时
			if(!empty($val['hour'])){
				if($val['promotion'] == 1){
					$val['hourTitle'] = $val['hour']?$val['hour']. '/' .$val['workplace']. '位/时':'暂无';
					$val['promHourTitle'] = $val['hprom'] ? $val['hprom']. '/' .$val['workplace']. '位/时':'暂无';
				}else{
					$val['hourTitle'] = $val['hour']?$val['hour']. '/' .$val['workplace']. '位/时':'暂无';					
				}
			}
			//类型
			$val['typeTitle'] = $val['type'] == 1?'办公室':'会议室';
			$pimgs = D('PositionImages')->where('pid = ' . $val['id'])->field('path')->select();
			$val['images'] = $pimgs;
		}
		unset($val);


		return $lists;
	}
    /**
     * 返回前一篇文档信息
     * @param  array $info 当前文档信息
     * @return array
     */
    public function prev($info){
        $map = array(
            'id'          => array('lt', $info['id']),
            'pid'		  => 0,
            'category_id' => $info['category_id'],
            'status'      => 1,
            'create_time' => array('lt', NOW_TIME),
            '_string'     => 'deadline = 0 OR deadline > ' . NOW_TIME,  			
        );

        /* 返回前一条数据 */
        return $this->field(true)->where($map)->order('id DESC')->find();
    }

    /**
     * 获取下一篇文档基本信息
     * @param  array    $info 当前文档信息
     * @return array
     */
    public function next($info){
        $map = array(
            'id'          => array('gt', $info['id']),
            'pid'		  => 0,
            'category_id' => $info['category_id'],
            'status'      => 1,
            'create_time' => array('lt', NOW_TIME),
            '_string'     => 'deadline = 0 OR deadline > ' . NOW_TIME,  			
        );

        /* 返回下一条数据 */
        return $this->field(true)->where($map)->order('id')->find();
    }

    public function update(){
        /* 检查文档类型是否符合要求 */
        $Model = new \Admin\Model\DocumentModel();
        $res = $Model->checkDocumentType( I('type'), I('pid') );
        if(!$res['status']){
            $this->error = $res['info'];
            return false;
        }

        /* 获取数据对象 */
        $data = $this->field('pos,display', true)->create();
        if(empty($data)){
            return false;
        }

        /* 添加或新增基础内容 */
        if(empty($data['id'])){ //新增数据
            $id = $this->add(); //添加基础内容

            if(!$id){
                $this->error = '添加基础内容出错！';
                return false;
            }
            $data['id'] = $id;
        } else { //更新数据
            $status = $this->save(); //更新基础内容
            if(false === $status){
                $this->error = '更新基础内容出错！';
                return false;
            }
        }

        /* 添加或新增扩展内容 */
        $logic = $this->logic($data['model_id']);
        if(!$logic->update($data['id'])){
            if(isset($id)){ //新增失败，删除基础数据
                $this->delete($data['id']);
            }
            $this->error = $logic->getError();
            return false;
        }

        //内容添加或更新完成
        return $data;

    }

    /**
     * 获取段落列表
     * @param  integer $id    文档ID
     * @param  integer $page  显示页码
     * @param  boolean $field 查询字段
     * @param  boolean $logic 是否查询模型数据
     * @return array
     */
    public function part($id, $page = 1, $field = true, $logic = true){
        $map  = array('status' => 1, 'pid' => $id, 'type' => 3);
        $info = $this->field($field)->where($map)->page($page, 10)->order('id')->select();
        if(!$info) {
            $this->error = '该文档没有段落！';
            return false;
        }

        /* 不获取内容详情 */
        if(!$logic){
            return $info;
        }

        /* 获取内容详情 */
        $model = $logic = array();
        foreach ($info as $value) {
            $model[$value['model_id']][] = $value['id'];
        }
        foreach ($model as $model_id => $ids) {
            $data   = $this->logic($model_id)->lists($ids);
            $logic += $data;
        }

        /* 合并数据 */
        foreach ($info as &$value) {
            $value = array_merge($value, $logic[$value['id']]);
        }

        return $info;
    }

    /**
     * 获取指定文档的段落总数
     * @param  number $id 段落ID
     * @return number     总数
     */
    public function partCount($id){
        $map = array('status' => 1, 'pid' => $id, 'type' => 3);
        return $this->where($map)->count('id');
    }

    /**
     * 获取推荐位数据列表
     * @param  number  $pos      推荐位 1-列表推荐，2-频道页推荐，4-首页推荐
     * @param  number  $category 分类ID
     * @param  number  $limit    列表行数
     * @param  boolean $filed    查询字段
     * @return array             数据列表
     */
    public function position($pos, $category = null, $limit = null, $field = true){
        $map = $this->listMap($category, 1, $pos);

        /* 设置列表数量 */
        is_numeric($limit) && $this->limit($limit);

        /* 读取数据 */
        return $this->field($field)->where($map)->select();
    }

    /**
     * 获取数据状态
     * @return integer 数据状态
     * @author huajie <banhuajie@163.com>
     */
    protected function getStatus(){
        $cate = I('post.category_id');
        $check = M('Category')->getFieldById($cate, 'check');
        if($check){
            $status = 2;
        }else{
            $status = 1;
        }
        return $status;
    }

    /**
     * 获取根节点id
     * @return integer 数据id
     * @author huajie <banhuajie@163.com>
     */
    protected function getRoot(){
        $pid = I('post.pid');
        if($pid == 0){
            return 0;
        }
        $p_root = $this->getFieldById($pid, 'root');
        return $p_root == 0 ? $pid : $p_root;
    }

    /**
     * 获取扩展模型对象
     * @param  integer $model 模型编号
     * @return object         模型对象
     */
    private function logic($model){
        $name  = parse_name(get_document_model($model, 'name'), 1);
        $class = is_file(MODULE_PATH . 'Logic/' . $name . 'Logic' . EXT) ? $name : 'Base';
        $class = MODULE_NAME . '\\Logic\\' . $class . 'Logic';
        return new $class($name);  		
    }

    /**
     * 设置where查询条件
     * @param  number  $category 分类ID
     * @param  number  $pos      推荐位
     * @param  integer $status   状态
     * @return array             查询条件
     */
    private function listMap($city, $status = 1, $pos = null){
        /* 设置状态 */
        if($status != NULL){
        	$map = array('status' => $status, 'pid' => 0);
        }else{
        	$map = array('pid' => 0);
        }
        

        /* 设置分类 */
        if(!is_null($city)){
            if(is_numeric($city)){
                $map['city'] = $city;
            } else {
                $map['city'] = array('in', str2arr($category));
            }
        }

        $map['create_time'] = array('lt', NOW_TIME);
        $map['_string']     = 'deadline = 0 OR deadline > ' . NOW_TIME;

        /* 设置推荐位 */
        if(is_numeric($pos)){
            $map[] = "position & {$pos} = {$pos}";
        }

        return $map;
    }

}
