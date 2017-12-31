<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateKeywordTable extends Migration {
	//执行
	public function up() {
		Schema::create( 'keyword', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->timestamps();
			$table->string('keyword',200)->defaults ('')->comment ('触发关键词');
			$table->string ('module_name',100)->defaults ('')->comment ('处理关键词的模块');
			$table->integer ('bc_id')->defaults (0)->comment ('关联回复表的主键id');
		});
	}

	//回滚
	public function down() {
		Schema::drop( 'keyword' );
	}
}