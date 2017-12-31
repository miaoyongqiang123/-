<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use system\model\Config;

class Boot implements Middleware{
	//执行中间件
	public function run($next) {
		//2017年12月27日(星期三新增加)
		//lock.php是检测是否安装一个标识
		//该文件存在说明系统已经安装，否则是说明系统未安装
		//!preg_match ("#system/install#",Request::get('s')):安装控制器类不做拦截
		//i模式修正符，不区分大小写
		if(!is_file ('./lock.php') && !preg_match ("#systems/install#i",Request::get('s'))){
			return go('systems.install.copyright');
		}
		//如果lock文件存在，再加载配置项数据
		//如果没有lock文件，说明系统还未安装，数据表都没有呢
		if(is_file ('lock.php')){
			//加载系统配置项
			$this->loadSystemConfig();
			//加载微信配置项
			$this->loadWechatConfig();
		}
		$next();
	}

	/**
	 * 加载微信配置项数据
	 */
	private function loadWechatConfig(){
		$field =  Config::find(1);
		$field = $field['wechat_config'] ? json_decode ($field['wechat_config'],true) : [];
		//首先读取wechat配置文件中数据
		//array_merge(a,b)  数组a和数组b合并，
		\Config::set('wechat',array_merge (\Config::get('wechat'),$field));
		//p(\Config::get('wechat'));

	}

	/**
	 * 加载系统配置项数据
	 */
	private function loadSystemConfig(){
		//读取系统配置项的数据
		$field = Config::find(1);
		$field = $field['system_config'] ? json_decode ($field['system_config'],true) : [];
		//将数据存给v函数中system
		v('system',$field);
	}


}