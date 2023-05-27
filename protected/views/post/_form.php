<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'topic-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'well'),
	'type'=>'vertical', //horizontal
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>


		<p class="hint">Load an image.</p>
		<?php
		echo CHtml::activeFileField($model, 'image');?>
		<br><br>
		<?php echo $form->textFieldRow($model,'title',array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->textAreaRow($model,'content',array('rows'=>10, 'cols'=>70)); ?>

		<br/>
		<p class="hint">Please separate different tags with commas.</p>
		<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'tags',
			'url'=>array('suggestTags'),
			'multiple'=>true,
			'htmlOptions'=>array('size'=>50),
		)); ?>

		<?php echo $form->dropDownListRow($model,'status',Lookup::items('PostStatus')); ?>

	<br/><br/>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit', 
		'label'=>Yii::t('app', $model->isNewRecord ? 'Create' : 'Save'),
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'normal', // null, 'large', 'small' or 'mini'
	)); ?>


<?php $this->endWidget(); ?>

</div><!-- form -->