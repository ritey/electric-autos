<?php

namespace CoderStudios\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request {

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
			'contact.name' => 'required',
			'contact.email' => 'required|email',
			'contact.subject' => 'required',
			'contact.message' => 'required',
			'g-recaptcha-response' => 'required|recaptcha',
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

			'contact[name].required' => 'You must enter your name.',
			'contact[email].required' => 'You must enter your email address.',
			'contact[subject].required' => 'You must enter a subject.',
			'contact[message].required' => 'You must enter a message.',
			'contact[attachment].mimes' => 'You have tried to upload a file that is not allowed, please try again.',
			'contact[attachment].max' => 'You have tried to upload a file that is too large, please try again.',

		];
	}
}