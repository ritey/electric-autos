<?php

namespace CoderStudios\Requests;

use App\Http\Requests\Request;

class ResourcesRequest extends Request {

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
			'name'				=> 'required|max:128',
			'enabled'			=> 'numeric',
			'sort_order'		=> 'numeric',
			'car_type_id'		=> 'numeric',
			'price'				=> 'numeric',
			'fuel'				=> 'max:8',
			'year'				=> 'numeric',
			'colour'			=> 'max:12',
			'reg'				=> 'max:12',
			'mileage'			=> 'max:12',
			'meta_description'	=> 'max:256',
			'doors'				=> 'numeric',
			'slug'				=> 'unique:resources,slug,' . $this->route()->getParameter('id'),
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