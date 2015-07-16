<?php namespace App;

use App\Widget;
use App\Http\Requests;
use App\Resource;
use App\Review;
use App\Visitor;
use App\View;
use Carbon\Carbon;
use Session;
use Request;
use Illuminate\Http\Response;

class WidgetAPI {

    private $widget;
    private $resource;
    private $visitor;
    private $view;
    private $failure = false;

    public function __construct($widget_id) {

        // Find or fail widget
        $this->widget = Widget::findOrFail($widget_id);

        $session_id = Session::getId();
        $referrer = filter_var(Request::server('HTTP_REFERER'), FILTER_SANITIZE_URL);

        // Add new resource?
        $this->resource = Resource::firstOrNew(['uri' => $referrer, 'widget_id' => $this->widget->id]);
        $this->resource->uri = $referrer;
        $this->resource->widget_id = $this->widget->id;
        $this->resource->save();

        // Add new visitor?
        $this->visitor = Visitor::firstOrCreate(['session_id' => $session_id]);
        $this->visitor->touch();

        // Add new view?
        $this->view = View::firstOrCreate(['resource_id' => $this->resource->id, 'visitor_id' => $this->visitor->id]);
        $this->view->touch();

    }

    public function __get($key) {
        if (isset($this->$key))
            return $this->$key;
        return null;
    }

    public function handleRating($rating, $text = '') {

        $rating = intval($rating);
        $widget_type = $this->widget->widgetType;

        if ( $this->hasRated() || ( $rating < 0 || $rating > $widget_type->max ) )
            $this->failure = true;

        if ( ! $this->failure ) {

            // Insert new review
            $review = new Review;
            $review->rating = $rating;
            $review->text = "";
            if (!empty($text))
                $review->text = strip_tags(nl2br($text));
            $review->resource_id = $this->resource->id;
            $review->visitor_id = $this->visitor->id;
            $review->published_at = Carbon::now();
            $review->save();

            return response()->view('api.success', array('api' => compact($this)))->header('Content-Type', 'application/json')->header('Access-Control-Allow-Origin', '*');

        }

        return response()->view('api.failure', array('api' => compact($this)))->header('Content-Type', 'application/json')->header('Access-Control-Allow-Origin', '*');

    }

    public function hasRated() {
        $review = Review::where(['resource_id' => $this->resource->id, 'visitor_id' => $this->visitor->id])->first();
        return ( $review ? true : false );
    }

    public function buildJS() {
        return response()->view('api.js', ['api' => $this])->header('Content-Type', 'text/javascript')->header('Access-Control-Allow-Origin', '*');
    }

}