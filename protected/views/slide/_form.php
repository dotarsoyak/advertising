<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
// echo sizeof($model_product_specification->errors);
?>

<style type="text/css">
	.div-wrapper-images{padding:3px;width:230px; float:left; position:relative; border:1px solid #dedede; background:white; margin-right:2px; margin-bottom:3px;}
</style>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'slide-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'well'),
	'type'=>'vertical', //horizontal
)); ?>

<?php 
	if(sizeof($errorSummary))
		echo var_dump($errorSummary);
?>
	<div class="modal fade" id="modal_image">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 id='h4title' class="modal-title"></h4>
	      </div>
	      <div class="modal-body"><center>
	        <?php 
						echo "<img id='img_element' src='' alt=''/>";
	        ?></center>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<!-- <div class='span9'> -->
	<div class='fluid-row'>
		<div class="span12">
			<br/><br/>
			<?php
				$this->widget('CMultiFileUpload', array(
					'name' => 'slides',
					'accept' => 'jpeg|jpg|png', 
					'duplicate' => 'Imagen duplicada!', 
					'denied' => 'Formato de imagen no permitodo, solo se permiten los 
											 siguientes formatos: jpe, jpeg, png',
				));
			?>
			<br/>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit', 
				'label'=>Yii::t('app', 'Save'),
			    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			    'size'=>'normal', // null, 'large', 'small' or 'mini'
			)); ?>
		</div>
	</div>
	<br/><br/><br/><br/><br/><br/><br/>
<fieldset>
	<legend></legend>

	<?php 
		$slides = Slide::model()->getSlides();

		$i=-1;
		$path = Yii::getPathOfAlias('webroot')."/slides/thumbs/";
		$routhe = Yii::app()->request->baseUrl."/slides/thumbs/";
		$origpic = Yii::app()->request->baseUrl."/slides/";

		foreach ($slides as $key => $slide) {
			$i++;
			if(!file_exists($path.$slide->image))
			{
				$slide->image = "noimage.jpg";
			}
			$image_clean=str_replace('.', '_', $slide->image);
			?>

			<div class='div-wrapper-images'>
			<?php

			echo "<img onclick=\"ShowModal('$slide->image', '$origpic');\" src='".$routhe.$slide->image."' alt='$slide->alt' border='0' style='height:100px;'/>";
			echo $form->hiddenField($slide, 'image', array('name'=>'Slide['.$i.'][image]', 'size'=>15,'maxlength'=>20,));
			echo $form->textFieldRow($slide,'position',array('name'=>'Slide['.$i.'][position]', 'maxlength'=>3,'style'=>'width:40px'));
			echo "<br/>Active:";
			echo $form->checkBox($slide,'active', array('name'=>'Slide['.$i.'][active]', 'class'=>'span2',));
			echo $form->textFieldRow($slide,'alt',array('name'=>'Slide['.$i.'][alt]', 'maxlength'=>120,'style'=>'width:200px'));
			echo $form->textFieldRow($slide,'width',array('name'=>'Slide['.$i.'][width]', 'maxlength'=>10,'style'=>'width:100px'));
			echo $form->textFieldRow($slide,'height',array('name'=>'Slide['.$i.'][height]', 'maxlength'=>10,'style'=>'width:100px'));
			echo $form->textAreaRow($slide,'comment',array('name'=>'Slide['.$i.'][comment]', 'rows'=>5, 'cols'=>10,'maxlength'=>500,));
			?>

		</div><!-- div wrapper -->
		<?php
		}
	?>
</fieldset>
<br/>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit', 
		'label'=>Yii::t('app', 'Save'),
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'normal', // null, 'large', 'small' or 'mini'
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	function ShowModal(image, path)
	{
		$('#modal_image').modal('show');
		$('#h4title').html(image);
		$('#img_element').attr('src',path + image);
	}
</script>

