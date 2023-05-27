<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>
<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
	'type'=>'vertical', //horizontal
)); ?>
<br/>
		<?php echo $form->textFieldRow($model,'code',array('size'=>20,'maxlength'=>20)); ?>
	
		<?php echo $form->textFieldRow($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	
		<?php echo $form->textFieldRow($model,'description',array('size'=>50,'maxlength'=>50)); ?>
	
		<?php echo $form->textFieldRow($model,'price',array('size'=>10,'maxlength'=>10)); ?>
	<br/>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit', 
		'label'=>Yii::t('product', $model->isNewRecord ? 'Create' : 'Save'),
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'normal', // null, 'large', 'small' or 'mini'
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->