<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Buseness\Controller;
use User\Api\UserApi;
use Think\Controller;

/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends Controller {

	/* 用户中心首页 */
	public function index() {

	}

	/* 注册页面 */
	public function register($password = '', $mobile = '', $code = '' , $email = '', $verify = '') {
		if (IS_POST) {//注册用户
		    if($mobile != session('mobile') or $code != session('mobile_code')){
				$this -> error('验证码输入错误');
			}
			/* 调用注册接口注册用户 */
			$User = new UserApi;
			$username = rand_username();
			$uid = $User -> register($username, $password, $email, $mobile);
			if (0 < $uid) {//注册成功
			    session('mobile',NULL);
				session('mobile_code',NULL);
				//TODO: 发送验证邮件
				$this -> success('注册成功！', U('login'));
			} else {//注册失败，显示错误信息
				$this -> error($this -> showRegError($uid));
			}

		} else {//显示注册表单
			
			//生成短信验证码
			session('send_code',random(6,1));
			$this -> display();
		}
	}

	/* 登录页面 */
	public function login($username = '', $password = '', $verify = '') {
		if (IS_POST) {//登录验证
			/* 检测验证码 */
			/*			if(!check_verify($verify)){
			 $this->error('验证码输入错误！');
			 }*/

			/* 调用UC登录接口登录 */
			$user = new UserApi;
			
			$uid = $user -> login($username, $password,1);
			if($uid <= 0){
				$uid = $user -> login($username, $password,3);
			}
			if (0 < $uid) {//UC登录成功
				/* 登录用户 */
				$Member = D('Member');
				if ($Member -> login($uid)) {//登录用户
					//TODO:跳转到登录前页面
					$this -> success('登录成功！', U('Buseness/Building/lists'));
				} else {
					$this -> error($Member -> getError());
				}

			} else {//登录失败
				switch($uid) {
					case -1 :
						$error = '用户不存在或被禁用！';
						break;
					//系统级别禁用
					case -2 :
						$error = '密码错误！';
						break;
					default :
						$error = '未知错误！';
						break;
					// 0-接口参数错误（调试阶段使用）
				}
				$this -> error($error);
			}

		} else {//显示登录表单
			$this -> display();
		}
	}
	//验证手机号码
	public function checkMobile($mobile = ''){
		$User = new UserApi;
		$res = $User->checkMobile($mobile);//用户名类型 1-用户名，2-用户邮箱，3-用户电话
      
		if($res>0){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	/* 退出登录 */
	public function logout() {
		if (is_login()) {
			D('Member') -> logout();
			$this -> success('退出成功！', U('User/login'));
		} else {
			$this -> redirect('User/login');
		}
	}

	/* 验证码，用于登录和注册 */
	public function verify() {
		$verify = new \Think\Verify();
		$verify -> entry(1);
	}

	/**
	 * 获取用户注册错误信息
	 * @param  integer $code 错误编码
	 * @return string        错误信息
	 */
	private function showRegError($code = 0) {
		switch ($code) {
			case -1 :
				$error = '用户名长度必须在16个字符以内！';
				break;
			case -2 :
				$error = '用户名被禁止注册！';
				break;
			case -3 :
				$error = '用户名被占用！';
				break;
			case -4 :
				$error = '密码长度必须在6-30个字符之间！';
				break;
			case -5 :
				$error = '邮箱格式不正确！';
				break;
			case -6 :
				$error = '邮箱长度必须在1-32个字符之间！';
				break;
			case -7 :
				$error = '邮箱被禁止注册！';
				break;
			case -8 :
				$error = '邮箱被占用！';
				break;
			case -9 :
				$error = '手机格式不正确！';
				break;
			case -10 :
				$error = '手机被禁止注册！';
				break;
			case -11 :
				$error = '手机号被占用！';
				break;
			default :
				$error = '未知错误';
		}
		return $error;
	}

	/**
	 * 修改密码提交
	 * @author huajie <banhuajie@163.com>
	 */
	public function profile() {
		if (!is_login()) {
			$this -> error('您还没有登陆', U('User/login'));
		}
		if (IS_POST) {
			//获取参数
			$uid = is_login();
			$password = I('post.old');
			$repassword = I('post.repassword');
			$data['password'] = I('post.password');
			empty($password) && $this -> error('请输入原密码');
			empty($data['password']) && $this -> error('请输入新密码');
			empty($repassword) && $this -> error('请输入确认密码');

			if ($data['password'] !== $repassword) {
				$this -> error('您输入的新密码与确认密码不一致');
			}

			$Api = new UserApi();
			$res = $Api -> updateInfo($uid, $password, $data);
			if ($res['status']) {
				$this -> success('修改密码成功！');
			} else {
				$this -> error($res['info']);
			}
		} else {
			$this -> display();
		}
	}

	public function sendmai() {
		$this -> display();
	}
	//给短信平台 推送短信
	public function sendSms() {
		$target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";

		$mobile = $_POST['mobile'];
		
		
		
		
		$send_code = $_POST['send_code'];

		$mobile_code = random(4, 1);
		if (empty($mobile)) {
			exit('手机号码不能为空');
		}
		$session_code = session('send_code');
		if (empty($session_code) or $send_code != $session_code) {
			//防用户恶意请求
			exit('请求超时，请刷新页面后重试');
		}
		$User = new UserApi;
		$res = $User->checkMobile($mobile);
		if($res<=0){
			$this->error('手机号码已经存在');
		}
		
		$post_data = "account=cf_omo&password=omo2016&mobile=" . $mobile . "&content=" . rawurlencode("您的验证码是：" . $mobile_code . "。请不要把验证码泄露给其他人。");
		//密码可以使用明文密码或使用32位MD5加密
		$gets = xml_to_array(Post($post_data, $target));
		if ($gets['SubmitResult']['code'] == 2) {
			session('mobile',$mobile);
			session('mobile_code',$mobile_code);
		}
		if($gets['SubmitResult']['msg'] == '提交成功'){
			$this->success('提交成功');
		}
		$this->error($gets['SubmitResult']['msg']);
	}

}
