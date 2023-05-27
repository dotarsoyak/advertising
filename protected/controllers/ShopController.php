<?php

class ShopController extends Controller
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
				'actions'=>array('admin','delete', 'create', 'update', 'view', 'index'),
			 	'roles'=>array('super'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionIndex()
	{
		$this->layout = 'admin';
		$this->render('/site/admin');
	}

	// public function actionView()
	// {
	// 	$this->render('view');
	// }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionCreate()
	{
		$creando = false;
		$model = new Shop();
		$user = new User();
		$transaction=$user->dbConnection->beginTransaction();
		$prefix="";

		try
		{
			if(isset($_POST['Shop']))
			{
				$model->attributes=$_POST['Shop'];
				$model->directory_name = rtrim(ltrim($model->directory_name));
				$prefix = rtrim(ltrim($model->db_prefix));

				if(strlen($prefix)>0)
					$model->db_prefix = $prefix.'_';
	
				if(!$model->validate())
				{
					$model->db_prefix = $prefix;
					$this->render('create',array(
						'model'=>$model,
						'errores'=>'-',//asi está validado para que sea diferente de guion
					));
					return;
				}

				$dir = $model->directory_name;
				$dbPrefix = $model->db_prefix;
				$shopName = $model->name;

				//validar el prefijo, si ya existe
			  $sql = "SELECT * FROM prefix WHERE prefix = '".$model->db_prefix."' limit 1";
			  $rows = Yii::app()->db->createCommand($sql)->queryRow();

			  if($rows != false){
			  	$model->db_prefix = $prefix;
					$this->render('create',array(
						'model'=>$model,
						'errores'=>'El prefijo <strong><i>'.$prefix.'</i></strong> ya le pertenece al sitio <strong><i>'.$rows['site'].
						'</i></strong>, escoja otro prefijo.',
					));
					if($transaction->getActive())
						$transaction->rollback();
			  	return;
			  }
			  else
			  {
			  	$sql = "INSERT INTO prefix(prefix, site) SELECT '".$model->db_prefix."', '".$dir."'";
			  	Yii::app()->db->createCommand($sql)->execute();
			  }
			  
				if(!file_exists(Yii::getPathOfAlias('webroot').'/nueva_tienda_esquema_prefix.sql')) {
					$model->db_prefix = $prefix;
					$this->render('create',array(
						'model'=>$model,
						'errores'=>'El script de esquema no se encontró.',
					));
					if($transaction->getActive())
						$transaction->rollback();
					return;
				}

				if(!file_exists(Yii::getPathOfAlias('webroot').'/rollback_prefix.sql')) {
					$model->db_prefix = $prefix;
					$this->render('create',array(
						'model'=>$model,
						'errores'=>'El script de rollback no se encontró.',
					));
					if($transaction->getActive())
						$transaction->rollback();
					return;
				}

				if(!file_exists(Yii::getPathOfAlias('webroot').'/nueva_tienda_datos_prefix.sql')) {
					$model->db_prefix = $prefix;
					$this->render('create',array(
						'model'=>$model,
						'errores'=>'El script de datos no se encontró.',
					));
					if($transaction->getActive())
						$transaction->rollback();
					return;
				}

				if(is_dir($_SERVER['DOCUMENT_ROOT'].'/'.$dir)) {
					$model->db_prefix = $prefix;
					$this->render('create',array(
						'model'=>$model,
						'errores'=>'El directorio <strong><i>'.$dir.
						'</i></strong> ya existe no lo podrá sobreescribir por favor seleccione otro nombre.',
					));
					if($transaction->getActive())
						$transaction->rollback();
					return;
				}
				else
				{
					$creando = true;
					mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$dir);
					chmod($_SERVER['DOCUMENT_ROOT'].'/'.$dir, 0755);

					$zip = new ZipArchive;
					if ($zip->open(Yii::getPathOfAlias('webroot').'/publicidad.zip') === TRUE) {
				    $zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/'.$dir);
				    $zip->close();
					}

					// Una vez creado el directorio y descomprimido el sitio
					// hay que reemplazar el valor de {dbName} en el config / main.php
					$ruta=$_SERVER['DOCUMENT_ROOT']."/".$dir."/protected/config/";
					$content = file_get_contents($ruta."main.php");
					$content = str_replace("{shopName}", $shopName, $content);
					$content = str_replace("{dbName}", 'publicidad', $content);
					$content = str_replace("{tablePrefix}", $dbPrefix, $content);

					$file=fopen($ruta."main.php", "w");
					fwrite($file, $content);
					fclose($file);

					// ejecutar script para crear esquema de base de datos 
					$script = file_get_contents(Yii::getPathOfAlias('webroot').'/nueva_tienda_esquema_prefix.sql');
					$content = str_replace("{prefix}", $model->db_prefix, $script);
					$esquema = fopen(Yii::getPathOfAlias('webroot').'/esquema.sql', "w");
					fwrite($esquema, $content);
					fclose($esquema);
					Yii::app()->dbmigration->executeFile(Yii::getPathOfAlias('webroot').'/esquema.sql');

					$script_datos = file_get_contents(Yii::getPathOfAlias('webroot').'/nueva_tienda_datos_prefix.sql');
					$content_datos = str_replace("{prefix}", $model->db_prefix, $script_datos);
					$datos = fopen(Yii::getPathOfAlias('webroot').'/datos.sql', "w");
					fwrite($datos, $content_datos);
					fclose($datos);
					Yii::app()->dbmigration->executeFile(Yii::getPathOfAlias('webroot').'/datos.sql');
					$transaction->commit();

					//crear usuario admin para el nuevo sitio
					$sql = "INSERT INTO ".$prefix."_user(username, password, email, profile)
						SELECT '".$model->username."',
							'".sha1($model->password)."',
							'".$model->email."',
							'admin'";

					$rows = Yii::app()->db->createCommand($sql)->execute();
					if($rows == 0)
					{
						$model->db_prefix = $prefix;
						$this->render('create',array(
							'model'=>$model,
							'errores'=>'No fue posible crear el usuario admin, verifique con sistemas.',
						));
						
						//aqui tengo que borrar el prefijo manualmente ya que el commit fue hecho lineas arriba para
						//poder crear las tablas donde se guardar[a el usuario.
						Prefix::model()->deleteAll(array('condition'=>"prefix = '".$model->db_prefix."'"));
						return;
					}

					$this->render('view',
						array(
							'model'=>$model,
					));
				}
			}
			else
			{
				$this->render('create',array(
					'model'=>$model,
					'errores'=>'-',
				));
			}
		}
		catch(Exception $err)
		{
			// echo new Exception($err."Error Processing Request", 1);
			if($transaction->getActive())
				$transaction->rollback();

			Prefix::model()->deleteAll(array('condition'=>"prefix = '".$model->db_prefix."'"));

			//hacer rollback
			$script_rollback = file_get_contents(Yii::getPathOfAlias('webroot').'/rollback_prefix.sql');
			$content_datos = str_replace("{prefix}", $model->db_prefix, $script_rollback);
			$datos = fopen(Yii::getPathOfAlias('webroot').'/rollback.sql', "w");
			fwrite($datos, $content_datos);
			fclose($datos);
			Yii::app()->dbmigration->executeFile(Yii::getPathOfAlias('webroot').'/rollback.sql');

			if( $creando ) {
				$model->db_prefix = $prefix;
				$model->deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/'.$dir);
				@rmdir($dir);
				$this->render('create',
					array(
						'model'=>$model,
						'errores'=>$err->getMessage(),
				));
			}
		}
	}
}
