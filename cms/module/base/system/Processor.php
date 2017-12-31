<?php
namespace module\base\system;
use module\base\model\BaseContent;
use module\HdProcessor;

/**
 * 微信处理器
 * Class Processor
 *
 * @package module\base\system
 */
class Processor extends HdProcessor
{
	/**
	 * @param $bc_id   回复表的主键id
	 */
	public function handler($bc_id){
		//1.根据回复表的主键id，获取对应的回复内容
		$contentData = BaseContent::find($bc_id);
		$this->text($contentData['content'] );


		//$instance = WeChat ::instance ( 'message' );
		//$instance -> text ( $contentData['content'] );//向用户回复消息
	}
}
