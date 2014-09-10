<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategory2Tables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category2_product', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
				
			$table->integer("product_id")->unsigned();
			$table->integer("category2_id")->unsigned();
			$table->timestamps();
				
			$table->foreign('product_id')->references('id')
			->on('product')->onUpdate('cascade')
			->onDelete('cascade');
			
			$table->foreign('category2_id')->references('id')
			->on('category2')->onUpdate('cascade')
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
		Schema::table('product_category2', function(Blueprint $table)
		{
			//
		});
	}

}
