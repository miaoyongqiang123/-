<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/12/25
 * Time: 15:08
 */

namespace addons\news\controller;
class Entry
{
	public function index ()
	{
		//echo 'addons news index';
		return view ('addons/news/template/entry/index.php');


	}
}