<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeCategoryTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_category', function(Blueprint $table)
		{
			
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			
			/*$table->increments("category_id")->unsigned();
			
			$table->dateTime('onStockDate');
			$table->string('style');
			$table->float('weight');
			$table->string('material');
			$table->string('locality');
			$table->string('mold');
			
			$table->string('location');
			
			$table->timestamps();			
			
			$table->foreign('category_id')->references('id')
			->on('categories')->onUpdate('cascade')
			->onDelete('cascade');
			*/
		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attribute_category', function(Blueprint $table)
		{
			//
		});
	}

}
