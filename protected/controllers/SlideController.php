<?php
include("SimpleImage.php");

class SlideController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/admin';

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
				'actions'=>array('index','delete', 'create', 'update'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model;
		$errors=Array();
		if(isset($_POST['Slide']))
		{
			try {
				$transaction=Slide::model()->dbConnection->beginTransaction();
				Slide::model()->deleteAll();

				foreach ($_POST["Slide"] as $item) {
					$model = new Slide();
					$model->attributes=$item;
					$model->alt = CHtml::encode($model->alt);
					$model->comment = CHtml::encode($model->comment);
					$model->width = CHtml::encode($model->width);
					$model->height = CHtml::encode($model->height);

					if( !$model->save() ){
						array_push($errors, $model->getErrors());
						throw new Exception(null);
					}
				}

				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}

		$slides = CUploadedFile::getInstancesByName('slides');
		if (isset($slides) && count($slides) > 0)
		{
			if(!is_dir(Yii::getPathOfAlias('webroot').'/slides/')) {
				mkdir(Yii::getPathOfAlias('webroot').'/slides/');
				chmod(Yii::getPathOfAlias('webroot').'/slides/', 0755);
			}
			if(!is_dir(Yii::getPathOfAlias('webroot').'/slides/thumbs/')) {
				mkdir(Yii::getPathOfAlias('webroot').'/slides/thumbs/');
				chmod(Yii::getPathOfAlias('webroot').'/slides/thumbs/', 0755);
			}

			$i=-1;
			foreach ($slides as $slide => $pic) {
				$i = $i + 1;

				$slide = new Slide;
				$slide->image = $pic->name;
				$slide->position = 0;
				$slide->alt = '-';
				$slide->active = 1;
				
				if($slide->save())
				{
					if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/slides/'.$pic->name)) {
						$image = new SimpleImage();
						$image->load(Yii::getPathOfAlias('webroot').'/slides/'.$pic->name);
						$image->resizeToWidth(100);
						$image->save(Yii::getPathOfAlias('webroot').'/slides/thumbs/'.$pic->name);
					// $pic->saveAs(Yii::getPathOfAlias('webroot').'/slides/thumbs/'.$image);
					}
					// echo var_dump($slide->getErrors()); return;
				}
      }
    }

		$this->render('admin', array(
				'errorSummary'=>$errors,
			));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=new Cms('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cms']))
			$model->attributes=$_GET['Cms'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates the slides
	 */
	public function actionUpdate($id)
	{
		return null;
	}

	/**
	 * Deletes a particular model.
	 */
	public function actionDelete($id)
	{
		// $this->loadModel($id)->delete();

		// // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		// if(!isset($_GET['ajax']))
		// 	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		return null;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cms $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cms-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
