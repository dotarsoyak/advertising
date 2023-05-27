<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $active
 */
class Shop extends CFormModel
{

	public $directory_name = "";
	public $name = "";
	public $db_prefix = "";
	public $username="";
	public $password="";
	public $email="";

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('directory_name', 'length', 'max'=>50),
			array('db_prefix', 'length', 'max'=>15),
			array('name', 'length', 'max'=>30),
			array('directory_name, db_prefix, name, username, password, email', 'required'),
			array('email','email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			// array('name, content', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'directory_name' => 'Nombre de la carpeta en disco, máximo 50 carácteres, sin espacios, no debe existir.',
			'name' => 'Nombre de la tienda',
			'db_prefix' => 'Prefijo de tablas, máximo 15 catácteres, sin espacios, se guardará en minusculas.',
			'username' => 'Usuario administrador',
			'password' => 'Clave del usuario administrador',
			'email' => 'Correo real del usuario administrador',
		);
	}

	public function deleteDirectory($dir) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($current = readdir($dh))) {
	    if($current != '.' && $current != '..') {
        // echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';
        if (!@unlink($dir.'/'.$current)) 
          $this->deleteDirectory($dir.'/'.$current);
	    }       
    }
    closedir($dh);
    // echo 'Se ha borrado el directorio '.$dir.'<br/>';
    @rmdir($dir);
	}

}