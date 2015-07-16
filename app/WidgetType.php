<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class WidgetType extends Model {

    protected $table = 'widget_types';

    protected $fillable = [];

    public function setValuesAttribute($value) {
        $this->attributes['values'] = serialize($value);
    }

    public function getValuesAttribute() {
        return unserialize($this->attributes['values']);
    }

    public function widgets() {
        return $this->hasMany( 'App\Widget' );
    }

    public function result($rating) {
        $rating = intval($rating);
        if ($this->values && isset($this->values[$rating - 1]))
            return $this->values[$rating-1];
        return $rating;
    }

    public function format($rating, $append = false) {
        if ($rating == 0)
            return '';
        $return = '<span class="rating rating-set-' . $this->iconset . '" data-rating="' . $rating . '">';
        if (!$this->values) {
            for ($i = 1; $i <= $this->max; $i++) {
                $return .= '<span class="rating-icons"><i class="fa rating-icon rating-icon-' . $this->iconset . ' rating-icon-' . $this->iconset . '-' . $i . '"></i></span>';
            }
            if ($append)
                $return .= ' <span class="rating-text">(bewertet mit ' . $rating .' von ' . $this->max . ')</span>';
        } else {
            $return .= '<span class="rating-icons"><i class="fa rating-icon rating-icon-' . $this->iconset . ' rating-icon-' . $this->iconset . '-' . $rating . '"></i></span>';
            if ($append && isset($this->values[intval($rating) - 1]))
                $return .= ' <span class="rating-text">(' . $this->values[intval($rating) - 1] . ')</span>';

        }
        return $return;
    }

}
