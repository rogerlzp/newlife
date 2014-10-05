<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			
			$table->string("name");
			$table->string("value");
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attribute', function(Blueprint $table)
		{
			//
		});
	}

}
