<?php

/**
 * This is the model class for table "slide".
 *
 * The followings are the available columns in table 'slide':
 * @property integer $id
 * @property string $image
 * @property string $alt
 * @property integer $position
 * @property integer $active
 */
class Slide extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{slide}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, position', 'required'),
			array('position, active', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>50),
			array('alt', 'length', 'max'=>120),
			array('comment', 'length', 'max'=>500),
			array('width', 'length', 'max'=>10),
			array('height', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image, alt, position, active', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'image' => 'Name',
			'alt' => 'Alternative text',
			'comment' => 'Description',
			'position' => 'Position',
			'width' => 'Width',
			'height' => 'Height',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('alt',$this->alt,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slide the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getSlides()
	{
		$dataProvider=Slide::model()->findAll(
			array(
				'order'=>'position',
		));

		$purifier=new CHtmlPurifier();
		foreach ($dataProvider as $slide) {
			$slide->alt = $purifier->purify(CHtml::decode($slide->alt));
			$slide->comment = $purifier->purify(CHtml::decode($slide->comment));
		}
		return $dataProvider;
	}

	/**converts the slides to array, to show in index page as slider
	*/
	public function slidesToArray()
	{
		$only_actives = 1;

		$slides=Slide::model()->findAll(
			array(
				'condition'=>'active=1',
				'order'=>'position',
		));

		$purifier=new CHtmlPurifier();
		$items=array();
		$i=-1;
		foreach ($slides as $key => $slide) {
			$i++;
			$img=array();
			$img['image']=Yii::app()->baseUrl.'/images/banner/'.$slide->image;
			$img['label']=$purifier->purify(CHtml::decode($slide->alt));
			$img['caption']=$purifier->purify(CHtml::decode($slide->comment));
			$img['imageOptions']=array('style'=>'width:'.$slide->width.';height:'.$slide->height,);
			
			array_push($items, $img);
		}

		return $items;
	}
}
