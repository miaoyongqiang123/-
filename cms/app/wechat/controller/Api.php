<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use system\model\Config;
use system\model\Keyword;
use system\model\Module;

class Api extends Controller
{
	//动作
	//构造方法，微信验证
	public function __construct ()
	{
		WeChat::valid ();

	}


	/**
	 * 回复用户消息
	 */
	public function index ()
	{
		//实例化消息管理类
		//$instance=Wechat::instance('message');
		$instance = WeChat::instance ( 'message' );
		//获取数据库消息回复数据
		$responseData = json_decode ( Config::find ( 1 )->wechat_response , true );
		//p($responseData);die;
		//判断是否是关注事件
		if ( $instance->isSubscribeEvent () ) {
			//向用户回复消息
			$instance->text ( $responseData[ 'welcome' ] );
		}
		//获取粉丝发来的消息内容
		$content = WeChat ::content ( 'Content' );
		$this -> parseKeyword ( $content );
		//回复文本消息
		if ( $instance->isTextMsg () ) {
			//向用户回复消息
			//echo 11;
			$instance->text ( $responseData[ 'default' ] );
		}
	}

	/**
	 * 关键词回复用户消息
	 * @param $content
	 *
	 * @return mixed
	 */
	private function parseKeyword ( $content )
	{
		//1.在关键词表中进行匹配
		$keywordData = Keyword ::where ( 'keyword' , $content ) -> first ();
		//如果找见对应的关键词
		if ( $keywordData ) {
			//获取对应关键词所在的模块，看该模块是否系统模块
			//其结果为1(系统模块)或2（非系统模块）
			$is_system = Module ::where ( 'name' , $keywordData[ 'module_name' ] ) -> pluck ( 'is_system' );
			//(new \module\base\system\Processor)->handler ();
			$class = ( $is_system == 1 ? 'module' : 'addons' ) . "\\" . $keywordData[ 'module_name' ] .
					 '\\system\Processor';
			return call_user_func_array ( [ new $class , 'handler' ] , [ $keywordData[ 'bc_id' ] ] );
		}
	}



}
