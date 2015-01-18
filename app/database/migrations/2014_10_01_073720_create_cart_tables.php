<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
				
			$table->string("session_id");
			$table->integer("user_id")->unsigned();
			$table->string("ipaddress");
			$table->integer("total_quantity");
			$table->float("total_price");
			
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
		Schema::table('cart', function(Blueprint $table)
		{
			//
		});
	}

}
