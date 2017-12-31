<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateModuleTable extends Migration {
	//执行
	public function up() {
		Schema::create( 'module', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->timestamps();
			$table->string ('title',100)->defaults ('')->comment ('模块中文名称');
			$table->string ('description',200)->defaults ('')->comment ('模块描述');
			$table->string ('name',100)->defaults ('')->comment ('模块英文标识');
			$table->string ('preview',200)->defaults ('')->comment ('模块预览图');
			$table->tinyInteger ('is_system')->defaults (2)->comment ('标识系统模块还是非系统模块，1系统模块，2非系统模块');
		});
	}

	//回滚
	public function down() {
		Schema::drop( 'module' );
	}
}