<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoPhototagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photo_phototag', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('photo_id')->unsigned()->index();
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->integer('phototag_id')->unsigned()->index();
            $table->foreign('phototag_id')->references('id')->on('phototags')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('photo_phototag');
	}

}
