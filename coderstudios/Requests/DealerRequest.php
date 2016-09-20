<?php

namespace CoderStudios\Requests;

use App\Http\Requests\Request;

class DealerRequest extends Request {

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
			'email' 	=> 'required',
			'phone' 	=> 'required',
			'location' 	=> 'required',
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
			'location.required' => 'You must enter the dealership post code.',
		];
	}
}