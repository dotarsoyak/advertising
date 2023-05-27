<?php
/* @var $this StoreController */
/* @var $model Store */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'shop-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'well'),
	'type'=>'vertical', //horizontal
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php if($errores != '-') 
				{
					echo "Ha ocurrido un error al crear el sitio.";
					echo "<br/>";
					?><div class="alert alert-block alert-error"><p>Se generaron lo siguientes errores:</p>
					<ul><li><?php echo $errores; ?></li>
					</ul></div>
	<?php	}
	?>
	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldRow($model,'directory_name',array('size'=>60,'maxlength'=>50)); ?>
		<?php echo $form->textFieldRow($model,'name',array('size'=>60,'maxlength'=>30)); ?>
		<?php echo $form->textFieldRow($model,'db_prefix',array('size'=>60,'maxlength'=>15)); ?>
		<?php echo $form->textFieldRow($model,'username',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->textFieldRow($model,'password',array('size'=>60,'maxlength'=>20)); ?>
		<?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>80)); ?>
		<br/>
		
<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit', 
	'label'=>Yii::t('product', 'Crear tienda'),
  'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
  'size'=>'normal', // null, 'large', 'small' or 'mini'
  'htmlOptions'=>array('onclick'=>'return SubmitForm();'),
)); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="modal fade" id="dialogShop">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Creando sitio</h4>
      </div>
      <div class="modal-body">
        <h4>Estoy creando el sitio, por favor sea paciente.</h4>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	function SubmitForm()
	{
		$("#dialogShop").modal('show');
		return true;
	}
</script>