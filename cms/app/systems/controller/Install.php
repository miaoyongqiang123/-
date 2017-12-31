<?php namespace app\systems\controller;

use houdunwang\route\Controller;
use houdunwang\validate\Validate;

/**
 * 系统安装
 * Class Install
 *
 * @package app\system\controller
 */
class Install extends Controller{
	/**
	 * 安装协议
	 */
	public function copyright(){
		return view ();
	}

	/**
	 * 环境检测
	 * @return mixed
	 */
	public function environment(){

		$data['php_version'] = PHP_VERSION;//php版本
		$data['php_os'] = PHP_OS;//操作系统
		$data['server_software'] = $_SERVER['SERVER_SOFTWARE'];//环境

		$data['pdo'] =  extension_loaded ('PDO');//链接是数据库需要用到pdo
		$data['gd'] =  extension_loaded ('GD');//处理图像需要用到
		$data['curl'] =  extension_loaded ('CURL');//curl请求时候(微信请求接口)
		$data['openssl'] =  extension_loaded ('openssl');//curl请求时候(微信请求接口)

		$data['is_writable'] =  is_writable ('./');//写入权限
		//dd($data);
		return view ('',compact ('data'));
	}

	/**
	 * 数据库连接
	 * @return mixed
	 */
	public function database(){
		if(Request::isMethod('post')){
			//1.接受posst请求数据
			$post = Request::post();
			//2.验证数据
			Validate::make([
				['host','isnull','请输入主机地址',VALIDATE::MUST_VALIDATE],
				['database','isnull','请输入连接的是数据库',VALIDATE::MUST_VALIDATE],
				['user','isnull','请输入数据库用户名',VALIDATE::MUST_VALIDATE],
				['password','isnull','请输入数据库密码',VALIDATE::MUST_VALIDATE],
			],$post);
			//3.连接数据库
			try{
				$dsn = "mysql:host={$post['host']};dbname={$post['database']}";
				$user = $post['user'];
				$password = $post['password'];
				$pdo = new \PDO($dsn,$user,$password);
				//将这些数据库信息，放到.env文件中
				$str = <<<str
APP_NAME=HDPHP 3.0
DB_DRIVER=mysql
DB_HOST={$post['host']}
DB_DATABASE={$post['database']}
DB_USER={$post['user']}
DB_PASSWORD={$post['password']}
str;
				file_put_contents ('./.env',$str);
				//p($envData);die;
				return message ('数据库连接成功','','success');

			}catch (\Exception $e){
				return message ('数据库连接失败','back','error');
			}
		}
		return view ();
	}

	/**
	 * 创建表，写入数据
	 */
	public function tables(){
		//运行迁移和填充
		//$res = \Cli::call('hd migrate:make');
		cli('hd migrate:make');
		cli('hd seed:make');
		//增加上传需要用的附件表
		$sql = <<<str
DROP TABLE IF EXISTS `attachment`;
CREATE TABLE `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员编号',
  `name` varchar(80) NOT NULL,
  `filename` varchar(300) NOT NULL COMMENT '文件名',
  `path` varchar(300) NOT NULL COMMENT '文件路径',
  `extension` varchar(10) NOT NULL DEFAULT '' COMMENT '文件类型',
  `createtime` int(10) NOT NULL COMMENT '上传时间',
  `size` mediumint(9) NOT NULL COMMENT '文件大小',
  `data` varchar(100) NOT NULL DEFAULT '' COMMENT '辅助信息',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `content` text NOT NULL COMMENT '扩展数据内容',
  PRIMARY KEY (`id`),
  KEY `data` (`data`),
  KEY `extension` (`extension`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='附件';
str;
		Schema::sql($sql);
		//跳转到完成页面
		return go ('finish');
	}

	public function finish(){
		//生成lock.php文件
		//file_put_contents ('./lock.php','');
		touch ('lock.php');
		return view ();
	}
}
