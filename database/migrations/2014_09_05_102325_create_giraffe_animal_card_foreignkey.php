<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiraffeAnimalCardForeignkey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('giraffes', function(Blueprint $table)
		{
            $table->integer('animal_card_id')->unsigned()->nullable()->index();
            $table->foreign('animal_card_id')->references('id')->on('animal_cards')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('giraffes', function(Blueprint $table)
		{
            $table->dropForeign('animal_card_id_foreign');
            $table->dropColumn('animal_card_id');
		});
	}

}
