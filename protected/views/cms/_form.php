<?php
/* @var $this CmsController */
/* @var $model Cms */
/* @var $form CActiveForm */
?>
<script src="<?php echo Yii::app()->baseUrl.'/ckeditor/ckeditor.js'; ?>"></script>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'cms-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'well'),
	'type'=>'vertical', //horizontal
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldRow($model,'name',array('size'=>50,'maxlength'=>50, 'readonly'=>true)); ?>
		<?php 
			echo $form->textAreaRow($model, 'content', array('id'=>'editor1'));
		?>
		<br/><br/>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    CKEDITOR.replace( 'editor1', {
			extraPlugins : 'preformat',
		});
</script>