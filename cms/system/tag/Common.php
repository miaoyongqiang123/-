<?php namespace system\tag;

use houdunwang\view\build\TagBase;
use system\model\Article;

class Common extends TagBase
{
	/**
	 * 标签声明
	 *
	 * @var array
	 */
	public $tags
		= [
			'line' => [ 'block' => false ] , 'tag' => [ 'block' => true , 'level' => 4 ] , 'arc' => [ 'block' => true , 'level' => 4 ] ,
		];

	public function _arc ( $attr , $content , &$view )
	{
		//$arcdata = Db::table('article');
		//$str=<<<str

		$arcdata = Db::table ( 'article' );
		foreach ( $arcdata as $field ) {
			$field[ 'url' ] = u ( 'home.entry.article' ) . '&id=' . $field[ 'id' ];


		}


		return $field[ 'url' ];
	}

	public function _arclist ( $attr , $content , &$view )
	{
		$cid   = isset( $attr[ 'cid' ] ) ? $attr[ 'cid' ] : 0;
		$limit = isset( $attr[ 'limit' ] ) ? $attr[ 'limit' ] : 0;
		$rand  = isset( $attr[ 'rand' ] ) ? $attr[ 'rand' ] : 0;
		$str
			   = <<<str
		<?php
		\$db = Db::table('article');
		if($cid>0){
			\$db = \$db->where('cid',$cid);
		}
		if($limit>0){
			\$db = \$db->limit($limit);
		}
		if($rand==1){
			\$db = \$db->orderBy('rand()');
		}
		\$db = \$db->get();
		foreach(\$db as \$field){
			\$field['url'] = "/c/".\$field['id'].".html";
		?>
		$content
		<?php } ?>
str;

		return $str;
	}

	//line 标签
	public function _line ( $attr , $content , &$view )
	{
		return 'link标签 测试内容';
	}

	//tag 标签
	public function _tag ( $attr , $content , &$view )
	{
		return 'tag标签 测试内容';
	}

}