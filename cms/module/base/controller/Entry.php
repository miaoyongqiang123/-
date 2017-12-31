<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/12/25
 * Time: 14:35
 */

namespace module\base\controller;

use module\base\model\BaseContent;
use module\HdController;

class Entry extends HdController
{
	public function index ()
	{
		//测试自己封装的url
		//echo url('base.entry.index',['id'=>1]);
		//echo 'module  base模块index方法';
		//这样加载模板时候会输入框架欢迎页面
		//实际上识别的s参数，现在地址栏没有s参数，默认值：?s=home/entry/index
		//return view ();
		//这样将路径写完整，可以加载模板文件但是这样写太麻烦了，所以封装一个函数template
		//return view ('module/base/template/entry/index.php');
		//最终将其进行封装，放在父级HdController里面
		//$field = 'HDPHP';
		//return $this->template('',compact ('field'));
		$field = BaseContent::get ();
		//p ($field);die;
		//加载模板，并把数据分配到页面上
		return $this->template ( '' , compact ( 'field' ) );
	}

	/**
	 * 保存/编辑关键词数据
	 *先添加回复消息获得消息的id，再添加关键词
	 * @return mixed
	 */
	public function post ()
	{
		//接受get参数，该参数为回复表主键id
		$id = Request::get ( 'id' );
		//判断是否为post请求
		if ( Request::isMethod ( 'post' ) ) {
			//p($_POST);
			//接受post数据
			$post = Request::post ();
			//添加回复表，如果没有get参数，就是添加，有get参数就是编辑
			$baseContentModel = $id ? BaseContent::find ( $id ) : new BaseContent();
			//添加完之后会返回，这条数据的自增id
			//编辑返回的不是自增id，这里需要注意，返回被影响的条数
			$bc_id = $baseContentModel->save ( $post );
			//回复表添加完成
			//p($bc_id);die;
			//添加关键词
			$data = [
				'keyword' => $post[ 'keyword' ] , 'module_name' => HD_MODULE ,//HD_MODULE是当前模块名称
				'bc_id'   => $id ? : $bc_id ,
			];
			//调用wechat类中保存关键词的方法
			$this->saveKeyword ( $data );

			//操作成功之后提示信息，并且跳回关键词列表页
			return message ( '操作成功' , url ( 'base.entry.index' ) , 'success' );
		}
		//分配旧数据
		$oldData = BaseContent::find ( $id );
		//dd($oldData);
		//加载模板文件
		return $this->template ( '' , compact ( 'oldData' ) );
	}


	/**
	 * 删除数据
	 * @return mixed|string
	 */
	public function del(){
		//接受get参数（id回复表的主键id）
		$id = Request::get('id');
		//1.删除回复表
		BaseContent::delete($id);
		//2.删除关键词表
		$this->delKeyword(['bc_id'=>$id,'module_name'=>'base']);
		return message('操作成功',url('base.entry.index'),'success');
	}

}
