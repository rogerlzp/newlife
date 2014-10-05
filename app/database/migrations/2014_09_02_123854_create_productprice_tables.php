<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductpriceTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productprice', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			
			$table->integer("product_id")->unsigned();
			$table->float("price");
			$table->float("original_price");
			$table->dateTime('startDate');
			$table->dateTime('endDate');
			$table->timestamps();
			
			$table->foreign('product_id')->references('id')
			->on('product')->onUpdate('cascade')
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
		Schema::table('productprice', function(Blueprint $table)
		{
			//
		});
	}

}
