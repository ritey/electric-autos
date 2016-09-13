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
			'name' => 'required|min:10|max:120',
			'content' => 'required|min:10',
			'gearbox' => 'required',
			'year' => 'required|min:2',
			'colour' => 'required|min:2',
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
			'name.required' => 'You must complete the ad headline field',
			'content.required' => 'You must complete a description of the vehicle'
		];
	}
}