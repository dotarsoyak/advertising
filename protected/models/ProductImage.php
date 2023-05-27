<?php

/**
 * This is the model class for table "product_image".
 *
 * The followings are the available columns in table 'product_image':
 * @property integer $id
 * @property integer $product_id
 * @property string $image
 * @property string $title
 * @property integer $position
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductImage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductImage the static model class
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
		return '{{product_image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, title, position', 'required'),
			array('product_id, position, active', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>80),
			array('title', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, image, title, position, active', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'image' => 'Image',
			'title' => 'Title',
			'position' => 'Position',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}