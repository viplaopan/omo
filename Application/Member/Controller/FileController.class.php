<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Member\Controller;
use Think\Controller;
use Think\Upload;
/**
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */

class FileController extends Controller {
	protected function _initialize(){
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置
		
	}
	/* 文件上传 */
	public function upload(){
		$return  = array('status' => 1, 'info' => '上传成功', 'data' => '');
		/* 调用文件上传组件上传文件 */
		$File = D('File');
		$file_driver = C('DOWNLOAD_UPLOAD_DRIVER');
		$info = $File->upload(
			$_FILES,
			C('DOWNLOAD_UPLOAD'),
			C('DOWNLOAD_UPLOAD_DRIVER'),
			C("UPLOAD_{$file_driver}_CONFIG")
		);

		/* 记录附件信息 */
		if($info){
			$return['data'] = think_encrypt(json_encode($info['download']));
		} else {
			$return['status'] = 0;
			$return['info']   = $File->getError();
		}

		/* 返回JSON数据 */
		$this->ajaxReturn($return);
	}
	/**
     * 上传图片
     * @author laopan
    */
    public function uploadResourceImage(){
        //TODO: 用户登录检测

        /* 返回标准数据 */
        $return  = array('status' => 1, 'info' => '上传成功', 'data' => '');

		
		 /* 上传文件 */
		$setting = C(I('get.s'));
		$setting['removeTrash'] = array($this, 'removeTrash');
		$Upload = new Upload($setting, C('PICTURE_UPLOAD_DRIVER'), C("UPLOAD_{$pic_driver}_CONFIG"));
		$info   = $Upload->upload($_FILES);
		$info['download']['status'] = 1;
		/* 返回JSON数据 */
        $this->ajaxReturn($info['download']);
    }
	/**
     * 上传
     * @author laopan
    */
    public function uploadHead(){
        //TODO: 用户登录检测

        /* 返回标准数据 */
        $return  = array('status' => 1, 'info' => '上传成功', 'data' => '');

		
		 /* 上传文件 */
		$setting = C('PICTURE_HEAD');
		$setting['removeTrash'] = array($this, 'removeTrash');
		$Upload = new Upload($setting, C('PICTURE_UPLOAD_DRIVER'), C("UPLOAD_{$pic_driver}_CONFIG"));
		$info   = $Upload->upload($_FILES);
		$info['download']['status'] = 1;
		/* 返回JSON数据 */
        $this->ajaxReturn($info['download'],'json');
    }
	/**
     * 上传视频
     * @author laopan
    */
    public function uploadResourceVadio(){
        //TODO: 用户登录检测

        /* 返回标准数据 */
        $return  = array('status' => 1, 'info' => '上传成功', 'data' => '');

		
		 /* 上传文件 */
		$setting = C('PICTURE_RESOURCE_VIDEO');
		$setting['removeTrash'] = array($this, 'removeTrash');
		$Upload = new Upload($setting, C('PICTURE_UPLOAD_DRIVER'), C("UPLOAD_{$pic_driver}_CONFIG"));
		$info   = $Upload->upload($_FILES);
		$info['download']['status'] = 1;
		/* 返回JSON数据 */
        $this->ajaxReturn($info['download']);
    }
	/* 下载文件 */
	public function download($id = null){
		if(empty($id) || !is_numeric($id)){
			$this->error('参数错误！');
		}

		$logic = D('Download', 'Logic');
		if(!$logic->download($id)){
			$this->error($logic->getError());
		}
		
	}
}
