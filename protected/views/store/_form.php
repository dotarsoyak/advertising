<?php
/* @var $this StoreController */
/* @var $model Store */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'store-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'well'),
	'type'=>'vertical', //horizontal
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldRow($model,'name',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->textFieldRow($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->textFieldRow($model,'image',array('size'=>60,'maxlength'=>80)); ?>
		<br/>
		Active 
		<br/>
		<?php echo $form->checkBox($model,'active'); ?>
		<br/>
		<br/>
		
<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit', 
	'label'=>Yii::t('product', $model->isNewRecord ? 'Create' : 'Save'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
)); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->