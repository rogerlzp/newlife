<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_item', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			
			$table->integer("quantity");
			$table->integer("product_id")->unsigned();
			$table->integer("cart_id")->unsigned();
			$table->float("price");
			
			$table->timestamps();
			
			$table->foreign('product_id')->references('id')
			->on('product')->onUpdate('cascade')
			->onDelete('cascade');
			
			$table->foreign('cart_id')->references('id')
			->on('cart')->onUpdate('cascade')
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
		Schema::table('cart_item', function(Blueprint $table)
		{
			//
		});
	}

}
