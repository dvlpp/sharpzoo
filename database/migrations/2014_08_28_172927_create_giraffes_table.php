<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiraffesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('giraffes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->integer('height')->nullable();
            $table->integer('age');
            $table->text('desc')->nullable();
            $table->boolean('alive')->default(1);
            $table->string('picture')->nullable();
            $table->string('lang')->default('fr');
            $table->integer('zookeeper_id')->unsigned()->nullable()->index();
            $table->foreign('zookeeper_id')->references('id')->on('zookeepers')->onDelete('set null');
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
		Schema::drop('giraffes');
	}

}
