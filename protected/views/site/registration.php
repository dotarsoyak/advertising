<?php $this->pageTitle=Yii::app()->name . ' - '."Registro";
	$this->breadcrumbs=array(
		"Registrar nuevo usuario",
	);
?>

<h1><?php echo "Registrar nuevo usuario"; ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'registration-form',
	// 'enableAjaxValidation'=>true,
	// 'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo 'Fields with <span class="required">*</span> are required.'; ?></p>
	
	<?php echo $form->errorSummary(array($model)); ?>
	
	<?php echo $form->textFieldRow($model,'username'); ?>
	
	<?php echo $form->passwordFieldRow($model,'password'); ?>

	<p class="hint">
	<?php echo "Minimal password length 4 symbols."; ?>
	</p>
 	
	<?php echo $form->passwordFieldRow($model,'verifyPassword'); ?>
	
	<?php echo $form->textFieldRow($model,'email'); ?>
	<br/>
	<?php if(CCaptcha::checkRequirements()): ?>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textFieldRow($model,'verifyCode'); ?>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	<?php endif; ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>"Register",
		)); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>