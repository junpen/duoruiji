<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lives', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title',50);
            $table->string('path',50);
            $table->integer('type');
            $table->string('introduction');
			$table->dateTime('begin');
            $table->dateTime('end');
            $table->string('portrait',225);
            $table->string('associate',30);
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
		Schema::drop('lives');
	}

}
