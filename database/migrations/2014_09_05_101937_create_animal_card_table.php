<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalCardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('animal_cards', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('number');
            $table->enum('origin', ["0" => "Unknown", "zoo" => "Other Zoo", "wild" => "Wild life"])->nullable();
            $table->string("origin_zoo")->nullable();
            $table->string("origin_country")->nullable();
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
		Schema::drop('animal_cards');
	}

}
