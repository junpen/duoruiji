<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('experts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('username',30);
            $table->string('portrait',225);
            $table->string('department',50);
            $table->string('title',50);
            $table->string('post',50);
            $table->string('hospital',50);
            $table->string('introduction');
            $table->string('education');
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
		Schema::drop('experts');
	}

}
