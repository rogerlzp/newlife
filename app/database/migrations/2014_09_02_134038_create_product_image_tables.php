<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_image', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			
			$table->integer("product_id")->unsigned();
			$table->integer("image_id")->unsigned();
			$table->boolean('main')->default(0); // whether a main image for the product
			$table->timestamps();
			
			$table->foreign('product_id')->references('id')
			->on('product')->onUpdate('cascade')
			->onDelete('cascade');
				
			$table->foreign('image_id')->references('id')
			->on('images')->onUpdate('cascade')
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
		Schema::table('product_image', function(Blueprint $table)
		{
			//
		});
	}

}
