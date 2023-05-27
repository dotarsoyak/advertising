<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'well'),
	'type'=>'vertical', //horizontal
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->textFieldRow($model,'author',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->textFieldRow($model,'url',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit', 
	'label'=>Yii::t('app', $model->isNewRecord ? 'Create' : 'Save'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
)); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->