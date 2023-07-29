<?php

namespace CoderStudios\Requests;

use App\Http\Requests\Request;

class SettingsRequest extends Request {

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
			'name'				=> 'required|max:255',
			'settings_group'	=> 'required|max:255',
			'value'				=> 'required',
			'serialized'		=> 'numerical',
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
		return [];
	}
}