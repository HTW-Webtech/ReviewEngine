<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\View;
use App\Review;
use App\Resource;

class Widget extends Model {

    protected $table = 'widgets';

    public $timestamps = false;

    protected $fillable = [];

    public function getReviewCount() {
        $count = 0;
        foreach($this->resources as $resource)
            $count += sizeof($resource->reviews);
        return $count;
    }

    public function getViewCount() {
        $count = 0;
        foreach($this->resources as $resource)
            $count += $resource->getViewCount();
        return $count;
    }

    public function getTotalRating() {
        $rating = 0;
        $resource_count = 0;
        foreach($this->resources as $resource) {
            $rating += $resource->getTotalRating();
            if ( $resource->getReviewCount() > 0 )
                ++$resource_count;
        }
        return ( ( $rating == 0 ) ? 0 : ( $rating / $resource_count ) );
    }

    public function formatRating($rating) {
        return $this->widgetType->format($rating);
    }

    public function resources() {
        return $this->hasMany('App\Resource');
    }

    public function widgetType() {
        return $this->belongsTo('App\WidgetType');
    }

    public function maxValue() {
        return $this->widgetType->max;
    }

}
