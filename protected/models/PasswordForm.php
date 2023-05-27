<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PasswordForm extends CFormModel
{
	public $newPass;
	public $confirmPass;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('newPass, confirmPass', 'required'),
			array('newPass, confirmPass', 'length', 'max'=>128),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'newPass'=>'Nuevo password',
			'confirmPass'=>'Repita password',
		);
	}

}
