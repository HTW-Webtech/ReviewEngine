<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('views', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('visitor_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->timestamps();
		});

        Schema::table('views', function($table) {
            $table->foreign('visitor_id')->references('id')->on('visitors');
            $table->foreign('resource_id')->references('id')->on('resources');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('views');
	}

}
