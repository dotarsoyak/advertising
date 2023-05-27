<?php
/* @var $this CmsController */
/* @var $model Cms */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'pass-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class'=>'well'),
	'type'=>'vertical', //horizontal
)); ?>
  <?php if(Yii::app()->user->hasFlash('passChanged')){
  	echo "<h4 style='color:#6F65EC;'>".Yii::app()->user->getFlash('passChanged')."</h4><br/>";
	}?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'newPass') ?>
	<?php echo $form->textFieldRow($model,'confirmPass') ?>
	<br/><br/>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit', 
		'label'=>'Save',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'normal', // null, 'large', 'small' or 'mini'
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
