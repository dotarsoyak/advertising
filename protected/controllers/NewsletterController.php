<?php

class NewsletterController extends Controller
{
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'suscribe'),
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionSuscribe()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			$model = new Newsletter();
			$post = trim(file_get_contents('php://input'));

// echo var_dump($post); return;

			$attributes = array();
      foreach(explode("&",$post) as $item)
      {
              $att = explode("=",$item);
              $attributes[$att[0]]=urldecode($att[1]);
      }

      $model->attributes = $attributes;
      if($model->validate()){
          $model->save();
          // return $this->actionBanco();
          echo "Gracias por suscribirse.";
      }
      else{
          echo CHtml::errorSummary($model);
      }
		}

		// if(isset($_POST))
		// {
		// 	$model->attributes = $_POST['Newsletter'];
		// 	if(!$model->save())
		// 		// echo var_dump($model->getErrors());// return;
		// 		$this->redirect(Yii::app()->homeUrl, array('newsletter'=>$model));
		// }
		// $this->render('suscribe');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}