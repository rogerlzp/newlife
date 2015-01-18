<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('torder', function(Blueprint $table)
		{
			
			
			$table->engine = "InnoDB";
			$table->increments("id")->unsigned();
			
			$table->integer("user_id")->unsigned();
			$table->integer("address_id")->unsigned();
			$table->integer("status_id")->unsigned();
			$table->string("ipaddress");
			$table->string("shipping_method");
			$table->string("payment_method");
			$table->string("note")->nullable();
			
			$table->enum('delivery_time', array('weekend', 'workday', 'other'))->default('workday');
			$table->string("voucher_code");
			
			$table->decimal('product_cost', 64, 4)->default(0);
			$table->decimal('shipping_cost', 64, 4)->default(0);

			$table->timestamps();
				
			$table->foreign('user_id')->references('id')
			->on('users')->onUpdate('cascade')
			->onDelete('cascade');			
			$table->foreign('status_id')->references('id')
			->on('torder_status')->onUpdate('cascade')
			->onDelete('cascade');
			$table->foreign('address_id')->references('id')
			->on('address')->onUpdate('cascade')
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
		Schema::table('order', function(Blueprint $table)
		{
			//
		});
	}

}
