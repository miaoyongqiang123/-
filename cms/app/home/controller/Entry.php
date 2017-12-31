<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace app\home\controller;

use houdunwang\db\Db;
use houdunwang\route\Controller;
use system\model\Module;
use system\model\Article;

class Entry extends Controller
{
	public function __construct ()
	{
		//echo 111;
		//运行模块
		$this->runModule ();
	}

	/**
	 * 运行模块
	 */
	private function runModule ()
	{
		//通过地址栏get参数加载类，自定义一个参数action
		$action = Request::get ( 'action' );//"base/entry/index"
		//p ($action);
		//通过斜杠把action参数转换成数组形式
		$info = explode ( '/' , $action );
		//p ($info);
		//判断该模块是否为系统模块
		//pluck获取单一一个字段的值
		//如果地址栏没有action参数，$is_system值为null
		$is_system = Module::where ( 'name' , $info[ 0 ] )->pluck ( 'is_system' );
		//如果有action参数并且is_system为真(在module表中可以找见这条数据)
		if ( $action && $is_system ) {
			//在处理模块加载模板的时候新增常量
			define ( 'HD_MODULE' , $info[ 0 ] );
			define ( 'HD_CONTROLLER' , $info[ 1 ] );//控制器
			define ( 'HD_ACTION' , $info[ 2 ] );//方法
			define ( 'IS_SYSTEM' , $is_system );//判断是不是系统模块
			//组合类名
			$class = ( $is_system == 1 ? 'module' : 'addons' ) . "\\{$info[0]}\controller\\" . ucfirst ( $info[ 1 ] );
			//p($class);die;//module\base\controller\Entry
			$ac = $info[ 2 ];
			//(new $class)->$ac();
			//(new \module\base\controller\Entry())->index();
			die( call_user_func_array ( [ new $class , $ac ] , [] ) );

		}

	}


	/**
	 * 博客首页
	 * 默认加载hdphp首页
	 *
	 * @return mixed
	 */
	public function index ( Article $article )
	{
		//echo 111;
		//$_cateData = Db::table ( 'category' )->where ( 'id' , $cid )->first ();
		//	$field=Article::find(1);
		$field = $article->get ();
		//\$field['url'] = "/l/".\$field['id'].".html";
		//$field['url']=u ('home.entry.index').'&id='.$field['id'];
		//dd($field['url']);
		//return View::with ( 'framework' , 'HDPHP' )->make ();
		return view ( 'amz/lw-index.html' , compact ( 'field' ) );
	}


	/**
	 * 文章详情页
	 * @return mixed
	 */
	public function article ()
	{
		//获取文章主键id
		$id           = Request::get ( 'id' );
		//p ($id);die;
		//查找文章数据
		$_articleData = Db::table ( 'article' )->where ( 'id' ,$id)->first ();
		return view ('amz/lw-article.html',compact ('_articleData'));

	}

	/**
	 * 文章列表页
	 * @param Article $article
	 *
	 * @return mixed
	 *
	 */
	public function arclist( Article $article){

		$field = $article->get ();

		return view ( 'amz/lw-timeline.html' , compact ( 'field' ) );

	}

	/**
	 * 图片库
	 * @return mixed
	 */
	public function pic(){

return view ('amz/lw-img.html');


	}




}