<?php

/**
 * This is the model class for table "product_specification".
 *
 * The followings are the available columns in table 'product_specification':
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $value
 * @property string $description
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductSpecification extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductSpecification the static model class
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
		return '{{product_specification}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, value, description', 'required'),
			array('product_id, active', 'numerical', 'integerOnly'=>true),
			array('name, value', 'length', 'max'=>80),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, name, value, description, active', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'value' => 'Value',
			'description' => 'Description',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}