<?php

namespace CoderStudios\Composers;

use Illuminate\Contracts\View\View;
use Session;
use CoderStudios\Library\Tweets;

class MasterComposer {

    /*
    |--------------------------------------------------------------------------
    | Admin Master Composer Class
    |--------------------------------------------------------------------------
    |
    | Loads variables for the master layout in one place
    |
    */

	public function compose(View $view)
	{
		$view->with('success_message', Session::pull('success_message'));
		$view->with('error_message', Session::pull('error_message'));
		$view->with('csrf_error', Session::pull('csrf_error'));
        $view->with('likes', Tweets::getLikes());
        $view->with('followers',Tweets::getFollowers());
	}
}