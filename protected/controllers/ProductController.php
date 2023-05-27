<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/admin';
	public $general_message = "";

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'index'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'getspecification'),
				'roles'=>array('admin', 'publish'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	// /**
	//  * Displays a particular model.
	//  * @param integer $id the ID of the model to be displayed
	//  */
	// public function actionView($id)
	// {
	// 	$this->layout='admin';
 //    if(User::model()->getRole() == 'publish')
 //      $this->layout = 'profile';
		
	// 	$this->render('view',array(
	// 		'model'=>$this->loadModel($id),
	// 	));
	// }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout="main";

		Yii::app()->name='Publicidad';

		$model = Product::model()->findAll(
			array(
				'condition'=>"id = '".$id."' OR code='".$id."' and active=1",
				'limit'=>1,
		));

		if(sizeof($model)==0){
			throw new CHttpException(404,'The requested page does not exist.');
			return;
		}

		$model=$model[0];

		$this->pageTitle = ucwords($model->name);
		Yii::app()->clientScript->registerMetaTag($model->description, 'description');
		Yii::app()->clientScript->registerMetaTag($model->tags, 'keyword');

		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
    $this->layout = 'admin';

    if(User::model()->getRole() == 'publish')
      $this->layout = 'profile';

		$model=new Product();
		$valid_post = true;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		try
		{
			$transaction=$model->dbConnection->beginTransaction();

			if(isset($_POST['Product']))
			{
				$image = CUploadedFile::getInstance($model, 'product-image');

				$model->attributes=$_POST['Product'];
				$model->type = $_POST['Product']['type'];;
				$model->in_stock = $_POST['Product']['in_stock'];
				$model->brand_id = $_POST['Product']['brand_id'];
				$model->video = $_POST['Product']['video'];
				$model->color = $_POST['Product']['color'];
				$model->user_id=Yii::app()->user->id;

				if($image===null){
					Yii::app()->user->setFlash("missImage", "Debes agregar una imagen principal a tu anuncio para poder continuar.");
					$this->render('create',array(
						'model'=>$model,
					));					
					return;
				}

				if($image != null)
				{
					$model->image=$image;
					$image_name=Yii::app()->user->id.$model->image->name;
					$model->image->saveAs((Yii::getPathOfAlias('webroot').'/images/product/'.$image_name));
        	
        	$file_name=Yii::getPathOfAlias('webroot').'/images/product/'.$image_name;
					copy($file_name, Yii::getPathOfAlias('webroot').'/images/product/'.$image_name);
					$file_name = Product::model()->compress($file_name, $file_name, 30);
				}

				if(!$model->save()){
					$valid_post = false;
				}

				$model=$this->loadModel($model->id);
				$model->image=$image_name;
				
				/*guardo el nombre de la imagen al producto ya con el id generado*/
				if(!$model->save()){
					$valid_post = false;
				}

				if($valid_post)
				{
					// saving product specifications
					$specifications = $model->getSpecifications();

					foreach ($specifications as $spec) {
					  $product_specification = new ProductSpecification();
					  $product_specification->id = 0;
					  $product_specification->product_id = $model->id;
					  $product_specification->name = $spec->name;
					  $product_specification->value ='-';
					  $product_specification->description ='-';
					  $product_specification->active = 1;

					  if(!$product_specification->save())
					  {
					  	throw new Exception('No se pudieron guardar las especificaciones del producto.');
					  	// echo var_dump($product_specification->getErrors());
					  }
					}

					//creamos las informaciones
					if(isset($_POST["ProductInfo"]))
					{
						foreach ($_POST["ProductInfo"] as $item) {
							$pinfo = new ProductInfo();
							$pinfo->product_id = $model->id;
							$pinfo->label = $item["label"];
							$pinfo->content = $item["content"];
							$pinfo->active = 1;
							$pinfo->save();
						}
					}
				
					// save product's angles
					$angles = CUploadedFile::getInstancesByName('angles');
					if (isset($angles) && count($angles) > 0)
					{
						if(!is_dir(Yii::getPathOfAlias('webroot').'/images/product/angles/')) {
							mkdir(Yii::getPathOfAlias('webroot').'/images/product/angles/');
							chmod(Yii::getPathOfAlias('webroot').'/images/product/angles/', 0755);
						}

						$i=0;
						foreach ($angles as $angle => $pic) {
							$image_name=Yii::app()->user->id.$pic->name;
			        if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/images/product/angles/'.$image_name)) {
			        	$file_name=Yii::getPathOfAlias('webroot').'/images/product/angles/'.$image_name;
								copy($file_name, Yii::getPathOfAlias('webroot').'/images/product/angles/'.$image_name);
								$file_name = Product::model()->compress($file_name, $file_name, 30);

								$product_image = new ProductImage;
								$product_image->id = 0;
								$product_image->product_id = $model->id;
								$product_image->image = $image_name;
								$product_image->position = 0;
								$product_image->title = '-';
								$product_image->alt = '-';
								$product_image->active = 1;
								if(isset($_POST['ProductImage'][$i++]['active']))
									$product_image->active = $_POST['ProductImage'][$i++]['active'];
								
								if(!$product_image->save()){
									throw new Exception('No se pudieron guardar los ángulos del producto.');
								}
			        }
				    }
					}

					$transaction->commit();
					Yii::app()->user->setFlash("itemSaved", "Tu anuncio ha sido creado !!, haz clic en el botón visualizar anuncio.");
					$this->redirect(array('update','id'=>$model->id));
				}
			}

			$this->render('create',array(
				'model'=>$model,
			));
		}
		catch(Exception $e)
		{
			throw new Exception("Error Processing Request ".$e, 1);
			$transaction->rollback();
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
    $this->layout = 'admin';

    if(User::model()->getRole() == 'publish')
      $this->layout = 'profile';

		$model=$this->loadModel($id);
		$valid_post=true;
		$continue = true;
		$model_specifications = $model->getProductSpecifications($id);  //executes the SQL statement and returns the first row of the 
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		try
		{
			if(isset($_POST['btnDeleteProductImages'])) 
			{
				$continue = false;
				if(isset($_POST['ProductImage']))
				{
					foreach ($_POST["ProductImage"] as $angle => $item) {
						if(isset($item['active'])){
							$product_image=ProductImage::model()->findByPk($item['id']);

							if(file_exists(Yii::getPathOfAlias('webroot').'/images/product/angles/'.$item['image']))
								unlink(Yii::getPathOfAlias('webroot').'/images/product/angles/'.$item['image']);

							if(isset($item['active']))
								$product_image->delete();
						}
					}
				}
				Yii::app()->user->setFlash("anglesDeleted", "Los ángulos han sido eliminados.");
			}

			if(isset($_POST['Product']) && $continue == true)
			{
				$model_specifications = null;
				$model->attributes=$_POST['Product'];
				$model->type = $_POST['Product']['type'];
				$model->in_stock = $_POST['Product']['in_stock'];
				$model->brand_id = $_POST['Product']['brand_id'];
				$model->video = $_POST['Product']['video'];
				$model->color = $_POST['Product']['color'];
				$image = CUploadedFile::getInstance($model,'product-image');

				if($image != null)
				{
					$model->image=$image;
					$image_name=Yii::app()->user->id.$image->name;
					$model->image->saveAs((Yii::getPathOfAlias('webroot').'/images/product/'.$image_name));
					$model->image=$image_name;
        	$file_name=Yii::getPathOfAlias('webroot').'/images/product/'.$image_name;
					copy($file_name, Yii::getPathOfAlias('webroot').'/images/product/'.$image_name);
					$file_name = Product::model()->compress($file_name, $file_name, 30);
				}

				$transaction=$model->dbConnection->beginTransaction();

				if(!$model->save())
				{
					$valid_post = false;
				}

				if($valid_post)
				{
				  if(isset($_POST['ProductSpecification']))
				  {
				  	ProductSpecification::model()->deleteAll('product_id in ('.$model->id.")");
						foreach ($_POST['ProductSpecification'] as $spec) {
							$product_specification=new ProductSpecification();

							$product_specification->product_id = $spec['product_id'];
							$product_specification->name = $spec['name'];
							$product_specification->value = $spec['value'];
							$product_specification->description = $spec['description'];
							$product_specification->active = 0;

							if(isset($spec['active']))
								$product_specification->active = 1;

							if(!$product_specification->save())
							{
							}
						}
				  }

					//borrar todas las informaciones del producto
					ProductInfo::model()->deleteAll('product_id in ('.$model->id.")");
					
					//crearlas nuevamente
					if(isset($_POST["ProductInfo"]))
					{
						foreach ($_POST["ProductInfo"] as $item) {
							$pinfo = new ProductInfo();
							$pinfo->product_id = $item["product_id"];
							$pinfo->label = $item["label"];
							$pinfo->content = $item["content"];
							$pinfo->active = 0;
							if($item['active']=='1')
								$pinfo->active = 1;
							
							if(!$pinfo->save())
							{
								// throw new Exception('No se pudieron guardar las informaciones del producto.');
							}
						}
					}

					// save product's angles
					$angles = CUploadedFile::getInstancesByName('angles');
					if (isset($angles) && count($angles) > 0)
					{
						if(!is_dir(Yii::getPathOfAlias('webroot').'/images/product/angles/')) {
							mkdir(Yii::getPathOfAlias('webroot').'/images/product/angles/');
							chmod(Yii::getPathOfAlias('webroot').'/images/product/angles/', 0755);
						}

						$i=-1;
						foreach ($angles as $angle => $pic) {
							$i = $i + 1;
							$image_name=Yii::app()->user->id.$pic->name;
			        if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/images/product/angles/'.$image_name)) {
			        	$file_name=Yii::getPathOfAlias('webroot').'/images/product/angles/'.$image_name;
								copy($file_name, Yii::getPathOfAlias('webroot').'/images/product/angles/'.$image_name);
								$file_name = Product::model()->compress($file_name, $file_name, 30);

								$product_image = new ProductImage;
								$product_image->id = 0;
								$product_image->product_id = $id;
								$product_image->image = $image_name;
								$product_image->position = 0;
								$product_image->title = '-';
								$product_image->alt = '-';
								$product_image->active = 1;
								if(isset($_POST['ProductImage'][$i]))
									$product_image->active = 1;
								
								if(!$product_image->save())
								{
									throw new Exception('No se pudieron guardar los ángulos del producto.');
								}
			        }
				    }
					}

					if(isset($_POST['ProductImage']))
					{
						foreach ($_POST['ProductImage'] as $key => $value) {
							$product_image=ProductImage::model()->findByPk($value['id']);
							$product_image->active=0;
							$product_image->title='-';
							$product_image->alt='-';
							$product_image->position=1;

							if(isset($value['position']))
								$product_image->position=$value['position'];

							if(isset($value['title']))
								$product_image->title=$value['title'];

							if(isset($value['active']))
								$product_image->active=1;

							if(!$product_image->save())
							{
								throw new Exception("No se pudieron guardar los angulos.");
							}
						}
					}

					$transaction->commit();
					Yii::app()->user->setFlash("itemSaved", "Tu anuncio ha sido actualizado !!, haz clic en el botón visualizar anuncio.");
				}
			}

			$this->render('update',array(
				'model'=>$model,
				'model_specifications'=>$model_specifications,
			));
		}
		catch(Exception $e)
		{
			throw new Exception("Error Processing Request ".$e, 1);
			$transaction->rollback();
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout='admin';
    if(User::model()->getRole() == 'publish')
      $this->layout = 'profile';
      		
		$criteria=new CDbCriteria(array(
			'condition'=>'active=1',
			'order'=>'name DESC',
		));
		if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);

		$dataProvider=new CActiveDataProvider('Product', array(
			'criteria'=>$criteria,
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
    $this->layout = 'admin';

    if(User::model()->getRole() == 'publish')
      $this->layout = 'profile';
    
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Product the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Product $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
