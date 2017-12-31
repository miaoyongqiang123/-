<?php namespace app\systems\controller;

use houdunwang\route\Controller;
use houdunwang\validate\Validate;
use system\model\Module as ModuleModel;
/**
 * 模块管理控制器类
 * Class Module
 *
 * @package app\system\controller
 */
class Module extends Controller{
	//动作
	/**
	 * 把模块列表显示到页面上
	 * @return mixed
	 */
	public function index(){
		//1.参考框架手册目录操作--目录树
		$addonsData = Dir::tree('addons');
		//p($addonsData);die;
		//3.在数据表中查找已经安装的模块
		//lists获取一列数据
		$installedModule = ModuleModel::lists('name');
		//p($installedModule);
		//2.筛选出合法的模块(模块中有manifest.php配置文件的)
		$field = [];
		foreach ($addonsData as $k=>$v){
			if(is_file ($v['path'] . '/manifest.php')){
				$res = include $v['path'] . '/manifest.php';
				$res['isinstall'] = in_array ($v['basename'],$installedModule);
				//p($res);
				$field[] = $res;
			}
		}
		//dd($field);
		return view ('',compact ('field'));
	}

	/**
	 * 设计模块
	 * @return mixed|string
	 */
	public function design(){
		if(Request::isMethod('post')){
			//1.验证数据不能为空
			$post = Request::post();
			$res = Validate::make( [
				[ 'name', 'isnull', '请输入模块英文标识', Validate::MUST_VALIDATE ],
				[ 'title', 'isnull', '请输入模块中文名称', Validate::MUST_VALIDATE ],
				[ 'description', 'isnull', '请输入模块描述', Validate::MUST_VALIDATE ],
				[ 'preview', 'isnull', '请输入模块预览图', Validate::MUST_VALIDATE ],
			] ,$post);
			//3.检测创建的模块上是否已经存在
			if(is_dir ('addons/' . $post['name'])){
				return message ('模块已存在','back','error');
			}
			//2.生成目录结构
			$dirs = ['controller','model','template','system'];
			foreach ($dirs as $dir){
				mkdir ('addons/'.$post['name'] . '/' .$dir,0777,true);
			}
			//4.生成模块对应配置文件
			file_put_contents ('addons/' . $post['name'] . '/manifest.php', "<?php\r\nreturn " . var_export ($post,true) . ";\r\n?>");
			//5.生成system/Processor文件
			$res=$post['name'];
			$str = <<<str
<?php
namespace addons\\{$res}\system;
use module\HdProcessor;

/**
 * 微信处理器
 * Class Processor
 *
 * @package addons\\{$res}\system
 */
class Processor extends HdProcessor
{
	/**
	 * @param \$bc_id   文章表的主键id/回复表的主键id
	 */
	public function handler(\$bc_id){

	}
}
str;
			file_put_contents ('addons/'.$post['name'] .'/system/Processor.php',$str);
			return message('模块创建成功',u('index'),'success');
		}
		return view ();
	}

	/**
	 * 安装模块
	 * @param ModuleModel $module
	 *
	 * @return mixed|string
	 */
	public function install(ModuleModel $module){
		$name = Request::get('name');
		//p($name);die;
		//将$name模块里的配置文件中数据获取出来
		$data = include "addons/{$name}/manifest.php";
		//p($data);die;
		$module->save ($data);
		return message ('操作成功',u('index'),'success');
	}

	/**
	 * 卸载模块
	 * @param ModuleModel $module
	 *
	 * @return mixed|string
	 */
	public function uninstall(ModuleModel $module){
		$name = Request::get('name');
		//p($name);
		$module->where('name',$name)->delete();
		return message ('操作成功',u('index'),'success');
	}

	/**
	 * 删除模块
	 * @return mixed|string
	 */
	public function del(){
		$name = Request::get('name');
		Dir::del("addons/{$name}");
		return message ('操作成功',u('index'),'success');
	}
}
