<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiraffesParticularitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('giraffes_particularities', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('giraffe_id')->unsigned()->nullable()->index();
            $table->foreign('giraffe_id')->references('id')->on('giraffes')->onDelete('cascade');
            $table->integer('particularity_id')->unsigned()->nullable()->index();
            $table->foreign('particularity_id')->references('id')->on('particularities')->onDelete('cascade');
            $table->integer('order')->unsigned()->default(0);
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
		Schema::drop('giraffes_particularities');
	}

}
