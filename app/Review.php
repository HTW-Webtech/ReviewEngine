<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    public $timestamps = false;

    protected $table = "reviews";

    protected $dates = ['published_at'];

    protected $fillable = [
        'text',
        'rating',
        'published_at'
    ];

}
