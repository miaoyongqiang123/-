<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class ChangeArticleTable extends Migration {
	//执行
	public function up() {
		Schema::table( 'article', function ( Blueprint $table ) {
			//$table->string('name', 50)->add();
			$table->string('description', 200)->comment ('文章描述')->add();
			$table->string('arc_keyword', 200)->comment ('关键词')->add();
			$table->string('link_url', 200)->comment ('跳转连接')->add();
		});
	}

	//回滚
	public function down() {
		//Schema::dropField('article', 'name');
	}
}