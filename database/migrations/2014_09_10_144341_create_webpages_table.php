<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebpagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('webpages', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("title");
            $table->string("picture")->nullable();
            $table->integer('owner_id');
            $table->string('owner_type');
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
		Schema::drop('webpages');
	}

}
