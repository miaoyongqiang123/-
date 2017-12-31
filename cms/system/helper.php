<?php
/** .-------------------------------------------------------------------
 * | 函数库
 * '-------------------------------------------------------------------*/

/**
 * 登录验证中间件
 */
if(!function_exists ('auth')){
	function auth(){
		Middleware::set('auth');
	}
}


/**
 * 跳转链接，类似u函数
 */
if(!function_exists ('url')){
	function url($url,$arg = []){
		//控制器/类/方法/ get参数
		//	p($url);die;//base.entry.index
		$info = explode ('.',$url);
		//p($info);
		//index.php?action=base/entry/index
		$arg = $arg ? "&".http_build_query ($arg) : '';
		return __ROOT__ . "/index.php?action={$info[0]}/{$info[1]}/{$info[2]}" . $arg;
	}
}