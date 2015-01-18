<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('address', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();

			$table->integer("user_id")->unsigned();
			$table->string("address");
			
			$table->timestamps();
			
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
		Schema::table('address', function(Blueprint $table)
		{
			//
		});
	}

}
