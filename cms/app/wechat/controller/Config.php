<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use system\model\Config as ConfigModel;
class Config extends Controller{
    //动作
	public function __construct ()
	{

		auth ();
	}
	public function index(ConfigModel $config){
        //此处书写代码...
		if (Request::isMethod('post')){
			$res=$config->postWechat(Request::post());
			if ($res['valid']){
				return message ($res['msg'],'refresh','success');
			}else{
				return message ($res['msg'],'back','error');
			}
		}
		//获取配置项表中微信配置项的数据
		$field=ConfigModel::find(1);
		$field=json_decode ($field['wechat_config'],true);
		return view ('',compact ('field'));

    }
}
