<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			
			$table->string("name");
			$table->string("sku");
			$table->string("slug");
			$table->integer("stock");
			$table->boolean("enable")->default(1);
			$table->integer("user_id")->unsigned();
			
			$table->text("short_description");
			$table->text("long_description");
			
			$table->timestamps();
			$table->unique('sku');

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
		Schema::table('product', function(Blueprint $table)
		{
			//
		});
	}

}
