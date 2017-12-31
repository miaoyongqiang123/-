<?php
namespace module;
use houdunwang\wechat\WeChat;

class HdProcessor{

	public function __call ( $name , $arguments )
	{
		$instance = WeChat ::instance ( 'message' );
		$instance -> $name ( current ($arguments) );//向用户回复消息

	}

}
