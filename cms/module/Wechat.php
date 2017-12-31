<?php
namespace module;

use system\model\Keyword;

trait Wechat
{
	/**
	 * 把关键词数据keyword表中
	 * @param $data
	 */
	public function saveKeyword($data){
		//编辑时候修改$keywordModel
		//获取keyword表的主键id
		$id = Keyword::where('bc_id',$data['bc_id'])->pluck('id');
		//dd($id);die;
		//如果$id=null,说明是新增，如果有值说明是更新
		$keywordModel = $id ? Keyword::find($id) :new Keyword();
		$keywordModel->save($data);
	}

	/**
	 * 删除关键词数据
	 * @param $id
	 */
	public function delKeyword($data){
		//$data = ['id'=>1,'module_name'=>'base'];
		//关键词表的bc_id==回复消息的主键id，并且是系统模块，就执行删除
		$where=[
			['bc_id',$data['bc_id']],
			['module_name',$data['module_name']]
		];
		Keyword::where($where)->delete();
	}

}