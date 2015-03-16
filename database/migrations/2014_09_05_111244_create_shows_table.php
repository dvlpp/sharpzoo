<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shows', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->text('desc')->nullable();
            $table->datetime('date');
            $table->integer("order")->unsigned();
            $table->integer('giraffe_id')->unsigned()->index();
            $table->foreign('giraffe_id')->references('id')->on('giraffes')->onDelete('cascade');
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
		Schema::drop('shows');
	}

}
