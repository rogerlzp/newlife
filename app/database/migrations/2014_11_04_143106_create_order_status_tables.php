<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('torder_status', function(Blueprint $table)
		{

			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			$table->string("status_name");
			$table->string("status_description");
			
			// add this part automatically
				
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('order_status', function(Blueprint $table)
		{
			//
		});
	}

}
