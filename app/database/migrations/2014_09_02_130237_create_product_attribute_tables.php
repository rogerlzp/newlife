<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_attribute', function(Blueprint $table)
		{
			
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
				
			$table->integer("product_id")->unsigned();
			$table->integer("attribute_id")->unsigned();

			$table->timestamps();
				
			$table->foreign('product_id')->references('id')
			->on('product')->onUpdate('cascade')
			->onDelete('cascade');
			
			$table->foreign('attribute_id')->references('id')
			->on('attribute')->onUpdate('cascade')
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
		Schema::table('product_attr', function(Blueprint $table)
		{
			//
		});
	}

}
