<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice', function(Blueprint $table)
		{
			
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			
			$table->integer("torder_id")->unsigned();
			$table->string("company_name")->nullable();
			$table->enum('invoice_type', array('personal', 'company', 'electronic'))->default('company');
				
			$table->timestamps();
				
			$table->foreign('torder_id')->references('id')
			->on('torder')->onUpdate('cascade')
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
		Schema::table('invoice', function(Blueprint $table)
		{
			//
		});
	}

}
