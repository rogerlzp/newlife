<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('boards', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			
			$table->increments('id')->unsigned();
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->string('board_name');
			$table->string('description');
			$table->integer('likes');
			$table->integer('images');
			$table->integer('shares');
			$table->integer('comments');	
			
			$table->foreign('user_id')->references('id')
				->on('users')->onUpdate('cascade')
				->onDelete('cascade');
		});
			
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('board', function(Blueprint $table)
		{
			//
		});
	}

}
