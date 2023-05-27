<?php

class UserController extends Controller
{
	public $layout='//layouts/profile';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('UpdatePass', 'profile'),
				'users'=>array('admin', '@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

  public function actionProfile()
  {
  	$this->render('dashBoard');
  }

	public function actionUpdatePass()
	{
		$model=new PasswordForm;

		if(isset($_POST['PasswordForm']))
		{
			$model->attributes=$_POST['PasswordForm'];
			if(strlen(trim($model->newPass))<6 || strlen(trim($model->confirmPass))<6){
      	$model->addError('newPass, confirmPass','Debe ingresar como minimo 6 caracteres para su password.');
			}else
			if(trim($model->newPass)=='' || trim($model->confirmPass)==''){
      	$model->addError('newPass, confirmPass','Debe ingresar los dos valores.');
			}else
      if(trim($model->newPass)!=trim($model->confirmPass)){
      	$model->addError('newPass','Los passwords no coinciden, verifique.');
      }else
      {
	      $query="UPDATE user SET password = '".sha1($model->newPass)."' WHERE id=".Yii::app()->user->id;
  	    try
  	    {
	  	    $res=Yii::app()->db->createCommand($query)->execute();
  	      Yii::app()->user->setFlash('passChanged',
      		'Su password ha sido cambiado con éxito, se ha enviado un email a su cuenta de correo, salga e inicie sesión nuevamente.');
	  	      
  	      if(!mail(Yii::app()->params['adminEmail']
  	      	, 'Su password ha sido cambiado: '.Yii::app()->name
  	      	, 'Su nuevo password de administrador es: '.$model->newPass.' <br/><br/>Que tenga un excelente día.')){
								mail(Yii::app()->params['adminEmail']
		  	      	, 'Su password ha sido cambiado: '.Yii::app()->name
		  	      	, 'Su nuevo password de administrador es: '.$model->newPass.' <br/><br/>Que tenga un excelente día.');
  	      }
  	    }
  	    catch(Exception $err)
  	    {
      	  $model->addError('msg', $err->getMessage());
  	    }
      }
		}

		$this->render('updatePass',array(
			'model'=>$model,
			));
	}

}