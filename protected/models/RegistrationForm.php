<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegistrationForm extends User
{
	public $verifyPassword;
	public $verifyCode;
	public $username;
	public $email;
	public $password;
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('username, password, verifyPassword, email', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => "Incorrect username (length between 3 and 20 characters)."),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => "Incorrect password (minimal length 4 symbols)."),
			array('email', 'email'),
			array('username', 'unique', 'message' => "This user's name already exists."),
			array('email', 'unique', 'message' => "This user's email address already exists."),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => "Retype Password is incorrect."),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);

	}

}
