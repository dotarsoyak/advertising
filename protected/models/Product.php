<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $image
 * @property string $tags
 * @property integer $new
 * @property integer $category_id
 * @property integer $subcategory_id
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Subcategory $subcategory
 * @property Category $category
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('new, category_id, subcategory_id, active', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>20),
			array('type', 'length', 'max'=>30),
			array('web', 'length', 'max'=>120),
			array('map', 'length', 'max'=>1000),
			array('name, image, email', 'length', 'max'=>50),
			array('description', 'length', 'max'=>255),
			array('address', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>30),
			array('price', 'length', 'max'=>10),
			array('tags', 'safe'),
			array('web', 'url'),
			array('email', 'email'),
			array('code,name, image, description, type, tags', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, name, description, price, image, tags, new, category_id, subcategory_id, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'subcategory' => array(self::BELONGS_TO, 'Subcategory', 'subcategory_id'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
			'type' => 'Type',
			'description' => 'Description',
			'price' => 'Price',
			'image' => 'Image',
			'tags' => 'Tags (Etiquetas)',
			'brand_id' => 'Brand',
			'new' => 'New',
			'category_id' => 'Category',
			'subcategory_id' => 'Subcategory',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		// $criteria->compare('id',$this->id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price,true);
		// $criteria->compare('image',$this->image,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('new',$this->new);
		// $criteria->compare('category_id',$this->category_id);
		// $criteria->compare('subcategory_id',$this->subcategory_id);
		// $criteria->compare('active',$this->active);
		$criteria->compare('user_id',Yii::app()->user->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getProductInfoAdmin($id)
	{
		$productInfo = ProductInfo::model()->findAll(
			array(
				'condition'=>'product_id='.$id,
			)
		);

		if(!isset($productInfo))
		{
			return null;
		}

		$render="<div class='fluid-row' id='wrapper-infos'>";
		$render.="  <div class='fluid-row' id='pinfo_0'>";
		$render.="    <div class='span4'>";
		$render.="      ".Yii::t('product', 'Name');
		$render.="    </div>";
		$render.="    <div class='span8'>";
		$render.="      ".Yii::t('product', 'Content');;
		$render.="    </div>";
		$render.="  </div>";

		$i=-1;
		foreach ($productInfo as $info) {
			$i++;
			$render.="<div class='fluid-row' id='pinfo_".$info->id."'>";
			$render.="  <div class='span4'>";
			$render.="    <input type='hidden' id='ProductInfo_id' name='ProductInfo[".$i."][id]' value='".$info->id."'/>";
			$render.="    <input type='hidden' id='ProductInfo_product_id' name='ProductInfo[".$i."][product_id]' value='".$info->product_id."'/>";
			$render.="    <input type='text' id='ProductInfo_label' name='ProductInfo[".$i."][label]' value='".$info->label."'/>";
			$render.="  </div>";
			$render.="  <div class='span8'>";
			$render.="    <input type='text' id='ProductInfo_content' name='ProductInfo[".$i."][content]' value='".$info->content."'/>";
			$render.="    <input type='hidden' id='ProductInfo_active' name='ProductInfo[".$i."][active]' value=1/>";
			$render.="    <input type='button' class='btn btn-success' value='".Yii::t('product','Delete')."' onclick='RemoveInfo(".$info->id.");'/>";
			$render.="  </div>";
			$render.="</div>";
		}
		
		$render.="</div>";

		return $render;
	}

	public function productInfo($id)
	{
		$specification=ProductSpecification::model()->findAll(
			array(
				'select'=>'name, value',
				'condition'=>'product_id=:product_id and active = 1',
				'params'=>array(':product_id'=>$id),
			)
		);

		$infos=ProductInfo::model()->findAll(
			array(
				'select'=>'label, content',
				'condition'=>'product_id=:product_id',
				'params'=>array(':product_id'=>$id),
			)
		);

		$tabs=array();
		$tab;
		$i=-1;

		foreach ($infos as $info) {
			$i++;
			$tab=array('id'=>'tab_product_'.$i, 'label'=>Yii::t('app',$info->label), 'content'=>$info->content,
				'active'=>'0');
			array_push($tabs, $tab);
		}

		if(sizeof($tab)>0)
			$tabs[0]['active'] = '1';

		$specif='';
		foreach ($specification as $item) {
			$specif.=$item->name.'='.$item->value.'<br/>';
		}
		
		if($specif != '')
		{
			$tab=array('id'=>'tab_product_'.++$i, 'label'=>Yii::t('app','Specifications'), 'content'=>$specif,
				'active'=>'0');
			array_push($tabs, $tab);
		}

		return $tabs;
	}

	public function getImages($product_id, $all = false)
	{
		$condition = 'product_id='.$product_id;
		if($all == false)
		{
			$condition = 'product_id='.$product_id.' and active=1';
		}

		$images = ProductImage::model()->findAll(
			array(
				'condition'=>$condition,
				'order'=>'position',
			)
		);

		return $images;
	}

	public function getSpecifications()
	{
		$specifications = Specification::model()->findAll(
			array(
				'order'=>'name',
			)
		);

		return $specifications;
	}

	public function getSpecificationsByProduct($id)
	{
		$specifications = ProductSpecification::model()->findAll(
			array(
				'condition'=>'product_id = '.$id,
			)
		);

		return $specifications;
		// echo var_dump($specifications);
	}

	public function getColor($id)
	{
		$color=Product::model()->findAll(
			array(
				'select'=>'color',
				'condition'=>'id='.$id,
			)
		);

		if(!$color) return;
		$color = $color[0]->color;

		$table='';
		$table.='<strong>';
		$table.='	<span>'.Yii::t('app','Color').'</span>';
		$table.='</strong><br/>';
		
		$table.='<div title="color principal" style="margin-right:3px; border:1px solid; float:left; width:23px; height:20px; background-color:'.$color.'"></div>';
		
		return $table;
	}

	public function getColors($id)
	{
		$colors=ProductColor::model()->findAll(
			array(
				'condition'=>'product_id_from=:product_id_from',
				'params'=>array(':product_id_from'=>$id)
			)
		);
		if(!$colors) return;

		//existen dos formas de presentar los colores TABLE | LIST
		$mode='TABLE';
		$table='';
		$table.='<strong>';
		$table.='	<span>'.Yii::t('app','Colors').'</span>';
		$table.='</strong><br/>';
		foreach ($colors as $color) {
			$table.=CHtml::link('<div title="'.Yii::t('app',$color->name).'" style="margin-right:3px; border:1px solid; float:left; width:23px; height:20px; background-color:'.$color->code.'"></div>', array('product/detail', 'id'=>$color->product_id_show));
		}
		
		return $table;
	}

	public function getStatus()
	{
		return array(
			'0'=>'Inactivo',
			'1'=>'Activo',
		);
	}

	public function getBrand()
	{
		$brands=Brand::model()->findAll(
				array(
					'condition'=>'active = 1'
		));

		return CHtml::listData($brands,	'id', 'name');
	}

	public function getCategory()
	{
		$categories=Category::model()->findAll(
				array(
					'condition'=>'active = 1'
		));

		return CHtml::listData($categories,	'id', 'name');
	}

	public function getProductSpecifications($id)
	{
		$connection = Yii::app()->db;
		$command = $connection->createCommand("
			select id, name, '' as 'value', '' as 'description', '1' as 'active' 
			from ".Yii::app()->db->tablePrefix."specification
			where name not in(select name from product_specification where product_id = ".$id.")"
		);
		$specs = $command->queryAll();

		$specification_list = array();

		$i=-1;
		foreach ($specs as $item) {
			$i++;
			$model_spec = new ProductSpecification();
			$model_spec->id = 0;
			$model_spec->product_id = $id;
			$model_spec->name = $item['name'];
			$model_spec->value = $item['value'];;
			$model_spec->description = $item['description'];;
			$model_spec->active = $item['active'];
			$specification_list[$i] = $model_spec;
		}

		return $specification_list;
	}

	public function compress($source, $destination, $quality) {
	  $info = getimagesize($source);

	  if ($info['mime'] == 'image/jpeg') 
	    $image = imagecreatefromjpeg($source);

	  elseif ($info['mime'] == 'image/gif') 
	    $image = imagecreatefromgif($source);

	  elseif ($info['mime'] == 'image/png') 
	    $image = imagecreatefrompng($source);

	  imagejpeg($image, $destination, $quality);

	  return $destination;
	}

}

