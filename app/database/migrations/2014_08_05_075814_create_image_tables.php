<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->timestamps();
			
			$table->integer('user_id')->unsigned();
			$table->string('image_name');
			$table->string('image_path');
			$table->string('description');
			$table->integer('boards');
			$table->integer('comments');
			$table->integer('likes');
			$table->integer('shares');
			$table->enum('image_type', array('local', 'net'))->default('local');
			
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
		Schema::drop('image');
	}

}
