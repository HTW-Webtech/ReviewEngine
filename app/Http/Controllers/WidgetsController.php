<?php namespace App\Http\Controllers;

use App\Widget;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Response;
use Auth;
use Validator;

use Illuminate\Http\Request;

class WidgetsController extends Controller {

	public function index() {
        $widgets = User::find(Auth::id())->widgets;
        return view('widgets.index', compact('widgets'));
    }

    public function show($id) {
        $widget = User::find(Auth::id())->widgets->find($id);
        if (! $widget)
            return Response::view('errors.404', array(), 404);
        return view('widgets.show', compact('widget'));
    }

    public function create() {

        $rules = array(
            'type' => 'alpha',
            'rating_icon'  => 'string',
        );

        $validator = Validator::make(Input::all(), $rules);

        if (!$validator->fails() && in_array( $_POST['type'], array('feedback', 'rate') ) ) {

            $widget = new Widget;
            $widget->user_id = Auth::id();
            $widget->widget_type_id = ( Input::get('type') == 'feedback' ? 3 : 1 );

            if ( $widget->widget_type_id == 1 && Input::has('rating_icon') && Input::get('rating_icon') == 'thumb' )
                $widget->widget_type_id = 2;

            $widget->save();

            // Redirect to new widget
            return redirect('dashboard/widget/' . $widget->id);

        }

    }

}
