<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WidgetAPI;
use Input;
use Validator;

use Illuminate\Http\Request;

class WidgetAPIController extends Controller {

    public function requestWidget($id) {
        $api = new WidgetAPI($id);
        return $api->buildJS();
    }

    public function retrieveRating($id) {

        $api = new WidgetApi($id);

        $rules = array(
            'rating' => 'digits_between:1,5',
            'text'   => 'string',
        );
        $validator = Validator::make(Input::all(), $rules);
        if (!$validator->fails())
            return $api->handleRating(Input::get('rating'), Input::get('text'));
        // Error handling
    }

}