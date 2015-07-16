<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('widgets', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('widget_type_id')->unsigned();
		});

        Schema::table('widgets', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('widget_type_id')->references('id')->on('widget_types');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('widgets');
	}

}
