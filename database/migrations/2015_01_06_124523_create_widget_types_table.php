<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetTypesTable extends Migration {

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('widget_types', function(Blueprint $table)
      {
         $table->increments('id');
         $table->string('name');
         $table->integer('max');
         $table->string('values');
         $table->string('iconset');
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
      Schema::drop('widget_types');
   }

}
