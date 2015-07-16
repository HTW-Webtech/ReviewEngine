<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {

    protected $table = 'resources';

    public $timestamps = false;

    protected $fillable = [
        'uri',
    ];

    public function getViewCount() {
        return sizeof($this->views);
    }

    public function getReviewCount() {
        return sizeof($this->reviews);
    }

    public function getTotalRating() {
        $rating = 0;
        foreach ($this->reviews as $review)
            $rating += $review->rating;
        return ( ( $rating == 0 ) ? 0 : ( $rating / $this->getReviewCount() ) );
    }

    public function reviews() {
        return $this->hasMany('App\Review');
    }

    public function views() {
        return $this->hasMany('App\View');
    }

}
