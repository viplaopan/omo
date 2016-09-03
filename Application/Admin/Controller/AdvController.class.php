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

class AdvController extends AdminController
{
	//广告页面
    public function advPage($page = 1, $r = 20)
    {
    	//读取广告位
        $map = array('status' => array('EGT', 0));
		$advPageModel = D('AdvPage');
       
        $advPages = $advPageModel->where($map)->page($page, $r)->order('id asc')->select();
        $totalCount = $advPageModel->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('广告位')
            ->buttonNew(U('editAdvPage'))
            ->buttonDelete()
            ->keyId()
            ->keyTitle()
            ->keyText('path', '路径')
            ->keyStatus()
            ->keyDoActionEdit('editAdvPage?id=###')
			->keyDoActionEdit('pos?page_id=###','广告')
            ->data($advPages)
            ->pagination($totalCount, $r)
            ->display();
    }
	//编辑广告页面
	public function editAdvPage($id = null)
    {
        //判断是否为编辑模式
        $isEdit = $id ? true : false;
		if(IS_POST){
			$model = M('AdvPage');
			$data = $model->create();
	        //写入数据库
	        if ($isEdit) {
	            $result = $model->where(array('id' => $id))->save($data);
	        } else {
	            $result = $model->add($data);
	        }

	        if (!$result) {
	            $this->error($isEdit ? '编辑失败' : '创建失败');
	        }
			$this->success($isEdit ? '编辑成功' : '创建成功', U('index'));
	        
		}else{
			//读取规则内容
	        if ($isEdit) {
	            $advPage = M('AdvPage')->where(array('id' => $id))->find();
	        } else {
	            $advPage = array('status' => 1);
	        }

	
	        //显示页面
	        $builder = new AdminConfigBuilder();
	        $builder->title($isEdit ? '编辑页面' : '添加页面')
	            ->keyId()
	            ->keyText('title', '名称', '页面名字，方便记忆')
				->keyText('path', '路径', '模块名/控制器名/方法名，例如：Weibo/Index/detail')
	            ->keyStatus()
	            ->data($advPage)
	            ->buttonSubmit(U('editAdvPage'))->buttonBack()
	            ->display();
		}
        
    }

	public function pos($page = 1, $r = 20)
    {
        $page_id = I('page_id');
		
        $adminList = new AdminListBuilder();
		
        $map['page_id'] = $page_id;
  
        $advPosModel = D('AdvPos');
        $advModel = D('Adv');
        $advPoses = $advPosModel->where($map)->select();

        foreach ($advPoses as &$v) {
            switch ($v['type']) {
                case 1:
                    $v['type_html'] = '<span class="text-danger">单图</span>';
                    break;
                case 2:
                    $v['type_html'] = '<span class="text-warning">多图轮播</span>';
                    break;
            }
			
			
			
            $count = $advModel->where(array('pos_id' => $v['id'], 'status' => 1))->count();
			//单图广告
			if($v['type'] == 1){
				$adv = $advModel->where(array('pos_id' => $v['id'], 'status' => 1))->find();
				if($count>0){
		            $v['do'] = '<a href="' . U('editPos?page_id=' .$page_id. '&id=' . $v['id']) . '"><i class="icon-cog"></i> 设置</a>&nbsp;&nbsp;&nbsp;&nbsp;'
		                     . '<a href="' . U('editAdv?id=' . $adv['id'] . '&pos_id=' . $v['id']) . '"><i class="icon-plus"></i> 编辑广告</a>&nbsp;&nbsp;&nbsp;&nbsp;';				
				}else{
		            $v['do'] = '<a href="' . U('editPos?page_id=' .$page_id. '&id=' . $v['id']) . '"><i class="icon-cog"></i> 设置</a>&nbsp;&nbsp;&nbsp;&nbsp;'
		                     . '<a href="' . U('editAdv?pos_id=' . $v['id']) . '"><i class="icon-plus"></i> 添加广告</a>&nbsp;&nbsp;&nbsp;&nbsp;';								
				}	
			}
			
			//多图轮播
			if($v['type'] == 2){
				$adv = $advModel->where(array('pos_id' => $v['id'], 'status' => 1))->find();
					$v['do'] = '<a href="' . U('editPos?page_id=' .$page_id. '&id=' . $v['id']) . '"><i class="icon-cog"></i> 设置</a>&nbsp;&nbsp;&nbsp;&nbsp;'
		                     . '<a href="' . U('adv?pos_id=' . $v['id']) . '"><i class="icon-plus"></i> 广告列表(' . $count . ')</a>&nbsp;&nbsp;&nbsp;&nbsp;';								
			}

        }
        unset($v);

        $adminList->title('广告位管理');
        $adminList->buttonNew(U('editPos?page_id=' . $page_id), '添加广告位');
        $adminList->buttonDelete(U('setPosStatus'));
        $adminList->buttonDisable(U('setPosStatus'));
        $adminList->buttonEnable(U('setPosStatus'));
        $adminList->keyId()->keyTitle()
            ->keyHtml('do', '操作', '320px')
            ->keyText('name', '广告位英文名')->keyText('path', '路径')->keyHtml('type_html', '广告类型')->keyStatus();
        $themes_array[] = array('id' => 'all', 'value' => '--全部主题--');
        foreach ($themes as $v) {
            $themes_array[] = array('id' => $v['name'], 'value' => $v['title']);
        }
        $status_array = array(array('id' => 1, 'value' => '正常'), array('id' => 0, 'value' => '禁用'), array('id' => -1, 'value' => '已删除'));

        $adminList->data($advPoses);
        $adminList->display();
    }
    //广告位列表
    public function adv($page = 1, $r = 20)
    {
        $aPosId = I('pos_id', 0, 'intval');
        $map['status'] = 1;
 		$advs =  D('Adv')->where($map)->page($page, $r)->order('id asc')->select();
        $totalCount =  D('Adv')->where($map)->count();

        //todo 广告管理列表
        $builder = new AdminListBuilder();

        $builder->keyId()->keyLink('title', '广告说明', 'editAdv?id=###');
        $builder->keyHtml('pos', '所属广告位');
        $builder->keyText('click_count', '点击量');
        $builder->buttonNew(U('editAdv?pos_id=' . $aPosId), '新增广告');
        if ($aPosId != 0) {
            $builder->button('广告排期查看', array('href' => U('schedule?pos_id=' . $aPosId)));
            $builder->button('设置广告位', array('href' => U('editPos?id=' . $aPosId)));
        }
        $builder->keyText('url', '链接地址')->keyTime('start_time', '开始生效时间', '不设置则立即生效')->keyTime('end_time', '失效时间', '不设置则一直有效')->keyText('sort', '排序')->keyCreateTime()->keyStatus();
        $builder->data($advs);
        $builder->pagination($totalCount, $r);
        $builder->display();
    }
	//编辑广告位
    public function editPos($id = 0)
    {
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		$page_id = I('page_id');
		if(!$page_id){
			$this->error('参数错误');
		}
		
		$advPage = D('AdvPage')->find($page_id);
        if (IS_POST) {
            //是提交
            
            $pos = D('AdvPos')->create();
            if ($isEdit) {
                $pos['id'] = $aId;
                $result = D('AdvPos')->save($pos);
            } else {
            	$result = D('AdvPos')->add($pos);
            }

            if ($result === false) {
                $this->error('保存失败。');
            } else {
                S('adv_pos_by_pos_' . $pos['path'] . $pos['name'], null);
                $this->success('保存成功。');
            }

        } else {
            $builder = new AdminConfigBuilder();

            if($isEdit){
            	$pos = D('AdvPos')->find($id);
            }else{
            	$pos['path'] = $advPage['path'];
				$pos['status'] =1;
				$pos['page_id'] =$page_id;
            }
			
            $builder->keyId()->keyTitle()->keyText('name', '广告位英文名', '标识，同一个页面上不要出现两个同名的')->keyReadOnly('page_id', '页面ID')->keyReadOnly('path', '路径', '模块名/控制器名/方法名，例如：Weibo/Index/detail')->keyRadio('type', '广告类型', '', array(1 => '单图广告', 2 => '多图轮播'))
                ->keyStatus()->keyText('width', '宽度', '支持各类长度单位，如px，em，%')->keyText('height', '高度', '支持各类长度单位，如px，em，%')
                ->keyText('margin', '边缘留白', '支持各类长度单位，如px，em，%；依次为：上  右  下  左，如 5px 2px 0 3px')->keyText('padding', '内部留白', '支持各类长度单位，如px，em，%；依次为：上  右  下  左，如 5px 2px 0 3px');
            $data = json_decode($pos['data'], true);
            if (!empty($data)) {
                $pos = array_merge($pos, $data);
            }

            if ($pos['type'] == 2) {

                $builder->keyRadio('style', '轮播_风格', '', array(1 => 'TouchSlider 风格', 2 => 'KinmaxShow 风格'));

            }

            $builder->data($pos);
            $builder->buttonSubmit()->buttonBack();
            $builder->display();


        }


    }
	//编辑广告页面
	public function editAdv($id = null)
    {
        //判断是否为编辑模式
        $isEdit = $id ? true : false;
		if(IS_POST){
			$model = M('Adv');
			$data = $model->create();
	        //写入数据库
	        if ($isEdit) {
	            $result = $model->where(array('id' => $id))->save($data);
	        } else {
	            $result = $model->add($data);
	        }

	        if (!$result) {
	            $this->error($isEdit ? '编辑失败' : '创建失败');
	        }
			$this->success($isEdit ? '编辑成功' : '创建成功');
	        
		}else{
			//读取规则内容
	        if ($isEdit) {
	            $adv = M('Adv')->where(array('id' => $id))->find();
	        } else {
	            $adv['status'] = 1;
				$adv['pos_id'] = I('pos_id');
	        }

	
	        //显示页面
	        $builder = new AdminConfigBuilder();
	        $builder->title($isEdit ? '编辑页面' : '添加页面')
	            ->keyId()
				->keyText('title', '标题')
	            ->keyReadOnly('pos_id', '广告位ID')
				->keyText('click_count', '点击量')
				->keyText('url', '链接地址')
				->keyText('sort', '排序')
				->keyImage('data', '图片')
				->keyTime('start_time','开始时间')
				->keyTime('end_time','结束时间')
	            ->keyStatus()
	            ->data($adv)
	            ->buttonSubmit(U('editAdv'))->buttonBack()
	            ->display();
		}
        
    }
}