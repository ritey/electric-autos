<?php

namespace CoderStudios\Requests;

use App\Http\Requests\Request;

class VehicleRequest extends Request {

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
			'price' => 'required',
			'currency' => 'required',
			'name' => 'required',
			'content' => 'required',
			'gearbox' => 'required',
			'year' => 'required',
			'colour' => 'required',
			/*'g-recaptcha-response' => 'required|recaptcha',*/
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