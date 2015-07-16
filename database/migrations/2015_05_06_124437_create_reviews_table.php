<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('resource_id')->unsigned();
            $table->integer('visitor_id')->unsigned();
            $table->integer('rating');
            $table->string('text');
            $table->timestamp('published_at');
		});

        Schema::table('reviews', function($table)
        {
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->foreign('visitor_id')->references('id')->on('visitors');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reviews');
	}

}
