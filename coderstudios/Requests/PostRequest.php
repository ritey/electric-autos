<?php

namespace CoderStudios\Requests;

use App\Http\Requests\Request;

class PostRequest extends Request {

	/**
	 * Determine if the user is authorised to make this request.
	 *
	 * @return boolean
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'name' 		=> 'required',
			'meta_title' 	=> 'required',
			'meta_description' 	=> 'required',
			'meta_date' 	=> 'required',
			'meta_author' 	=> 'required',
			'sort_order' 	=> 'required',
			'summary' 	=> 'required',
			'slug' 	=> 'required',
			'body' 		=> 'required',
		];

		return $rules;
	}

	/**
	 * Override the default error messages.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [

		];
	}
}