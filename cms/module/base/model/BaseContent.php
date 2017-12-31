<?php namespace module\base\model;
use houdunwang\model\Model;
use system\model\Keyword;

class BaseContent extends Model{
	//数据表
	protected $table = "base_content";

	//允许填充字段
	protected $allowFill = [ '*'];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]
		['content','isnull','请输入回复内容',self::MUST_VALIDATE,self::MODEL_BOTH],
	];

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps=true;

	/**
	 *模型关联一对一
	 * @return mixed
	 */
	public function keyword ()
	{
		return $this->hasOne (Keyword::class,'bc_id','id');
	}
}