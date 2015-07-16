<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model {

    protected $table = 'views';

    protected $fillable = ['resource_id', 'visitor_id'];

}
