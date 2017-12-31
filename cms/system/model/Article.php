<?php namespace system\model;

use houdunwang\model\Model;
use module\Wechat;

class Article extends Model
{
	use Wechat;
	//数据表
	protected $table = "article";

	//允许填充字段
	protected $allowFill = [ '*' ];

	//自动验证
	protected $validate = [
		//['字段名','验证方法','提示信息',验证条件,验证时间]
		[ 'title' , 'isnull' , '请输入文章标题' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'author' , 'isnull' , '请输入文章作者' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'is_hot' , 'isnull' , '请选择是否热门' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'is_recommened' , 'isnull' , '请选择是否推荐' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'cid' , 'isnull' , '请选择所属栏目' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'prev' , 'isnull' , '请上传预览图' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'content' , 'isnull' , '请输入文章内容' , self::MUST_VALIDATE , self::MODEL_BOTH ] ,
	];


	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps = true;

	/**
	 * 文章数添加
	 *
	 * @param $post    post数据
	 *
	 * @return array
	 */
	public function store ( $post )
	{
		//执行完成添加之后返回自增id
		$arc_id = $this -> save ( $post );
		//p ($arc_id);die;
		//p ($post);die;
		//将关键词同时添加到关键词表
		if($post['arc_keyword']){
			$data = [
				'keyword'=>$post['arc_keyword'],
				'module_name'=>'article',
				'bc_id'=>$arc_id,
			];
			$this->saveKeyword ($data);
		}
		return [ 'valid' => 1 , 'msg' => '操作成功' ];
	}

	/**
	 * 文章数据编辑
	 * @param $post
	 * @param $id
	 *
	 * @return array
	 */
	public function edit ( $post , $id )
	{
		$model = Article ::find ( $id );
		$model -> save ( $post );
		if($post['arc_keyword']){
			$data = [
				'keyword'=>$post['arc_keyword'],
				'module_name'=>'article',
				'bc_id'=>$id,
			];
			//p($data);die;
			$this->saveKeyword ($data);
		}
		return [ 'valid' => 1 , 'msg' => '操作成功' ];
	}

	/**
	 * 一对多(反向关联)
	 *
	 * @return mixed
	 */
	public function category ()
	{
		return $this -> belongsTo ( Category::class , 'cid' , 'id' );
	}
}