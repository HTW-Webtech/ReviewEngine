<?php

use Illuminate\Database\Seeder;

use App\WidgetType;

class WidgetTableSeeder extends Seeder {

   public function run()
   {
      WidgetType::create(array(
         'name' => 'star',
         'max' => '5',
         'values' => '',
         'iconset' => 'star'
      ));

      WidgetType::create(array(
         'name' => 'thumb',
         'max' => '3',
         'values' => 'a:3:{i:1;s:8:\"sehr gut\";i:2;s:11:\"ausreichend\";i:3;s:8:\"schlecht\";}',
         'iconset' => 'thumb'
      ));

      WidgetType::create(array(
         'name' => 'feedback',
         'max' => 2,
         'values' => 'a:2:{i:1;s:3:\"gut\";i:2;s:8:\"schlecht\";}',
         'iconset' => 'check'
      ));
   }

}
