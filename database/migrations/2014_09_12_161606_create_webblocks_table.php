<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebblocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('webblocks', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('webpage_id')->unsigned()->index();
            $table->foreign('webpage_id')->references('id')->on('webpages')->onDelete('cascade');
            $table->text('body');
            $table->integer('order')->unsiged()->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('webblocks');
	}

}
