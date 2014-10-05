<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTagTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image_tag', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			
			$table->integer("image_id")->unsigned();
			$table->integer("product_id")->unsigned();
				
			$table->float('x1');
			$table->float('y1');
			$table->float('x2');
			$table->float('y2');
			$table->float('width');
			$table->float('height');
				
			$table->timestamps();
				
			$table->foreign('image_id')->references('id')
			->on('images')->onUpdate('cascade')
			->onDelete('cascade');
			
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
		Schema::table('image_tag', function(Blueprint $table)
		{
			//
		});
	}

}
