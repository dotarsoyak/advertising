<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
// echo sizeof($model_product_specification->errors);
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
	'type'=>'vertical', //horizontal
)); ?>

<?php if(Yii::app()->user->hasFlash('missImage')){
				echo "<div class='alert alert-error'>".
				"<a href='#'' class='close' data-dismiss='alert'>&times;</a>".
				Yii::app()->user->getFlash('missImage')."</div>";
}?>
<?php if(Yii::app()->user->hasFlash('itemSaved')){
				echo "<div class='alert alert-success'>".
				"<a href='#'' class='close' data-dismiss='alert'>&times;</a>".
				Yii::app()->user->getFlash('itemSaved')."</div>";
}?>
<?php if(Yii::app()->user->hasFlash('itemUpdated')){
				echo "<div class='alert alert-success'>".
				"<a href='#'' class='close' data-dismiss='alert'>&times;</a>".
				Yii::app()->user->getFlash('itemSaved')."</div>";
}?>
<?php if(Yii::app()->user->hasFlash('anglesDeleted')){
				echo "<div class='alert alert-success'>".
				"<a href='#'' class='close' data-dismiss='alert'>&times;</a>".
				Yii::app()->user->getFlash('anglesDeleted')."</div>";
}?>

<style type="text/css">
	.active{display:block;}
	.hide{display:none;}
	.tabbutton{width:200px;background:#dedede;float:left;padding: 8px 8px 12px 8px; 
						 margin-right: 5px !important; margin-left:0px !important;cursor:pointer;
						 border-top-left-radius:3px;border-top-right-radius:3px }
	.tabactive{background:gray;color:white;}
</style>


<?php if(!$model->isNewRecord){ ?>
	<a class='btn btn-info' target='_blank' href="<?php echo Yii::app()->createUrl('product')."/".$model->code; ?>"><?php echo Yii::t('product', 'View product'); ?></a><br/><br/>
<?php } ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="fluid-row">
<div id="tab1button" class="span3 tabbutton tabactive" onclick="MuestraTab('tab1');">Datos generales</div>	
<div id="tab2button" class="span3 tabbutton" onclick="MuestraTab('tab2');">Mapa</div>
<div id="tab3button" class="span3 tabbutton" onclick="MuestraTab('tab3');">Imágenes</div>	
<div id="tab4button" class="span3 tabbutton" style="display:none;" onclick="MuestraTab('tab4');">Información del producto</div>	
</div>
<br/><br/>
<div id="tab1" class="well active" style="height:auto;min-height:550px;">
	<div class="fluid-row">
		<div class="span3">
			<?php echo $form->textFieldRow($model,'code',array('size'=>15,'maxlength'=>20)); ?>
		</div>
		<div class="span3">
			<?php echo $form->textFieldRow($model,'name',array('size'=>45,'maxlength'=>50)); ?>
		</div>
		<div class="span6">
			<?php echo $form->textFieldRow($model,'video',array('size'=>45,'maxlength'=>120)); ?>
		</div>
	</div>
	<div class="fluid-row">
		<div class="span12">
			<?php echo $form->textFieldRow($model,'web',array('size'=>45,'maxlength'=>120, 'style'=>'width:100%;')); ?>
		</div>
	</div>
	<div class="fluid-row">
		<div class="span12">
			<?php echo $form->textAreaRow($model,'address',array('rows'=>3,'cols'=>50,'maxlength'=>255,'style'=>'width:100%')); ?>
		</div>
	</div>
	<div class="fluid-row">
		<div class="span3">
			<?php echo $form->textFieldRow($model,'phone',array('size'=>45,'maxlength'=>30)); ?>
		</div>
		<div class="span3">
			<?php echo $form->textFieldRow($model,'type',array('size'=>45,'maxlength'=>30)); ?>
		</div>
		<div class="span3">
			<?php echo $form->dropDownListRow($model,'brand_id', $model->getBrand()); ?>
		</div>
		<div class="span3">
			<?php echo $form->dropDownListRow($model,'category_id', $model->getCategory()); ?>
		</div>
	</div>
	<div class="fluid-row">
		<div class="span3">
			<?php echo $form->textAreaRow($model,'description',array('rows'=>5,'cols'=>50)); ?>
		</div>
		<div class="span3">
			<?php echo $form->textAreaRow($model,'tags',array('rows'=>5,'cols'=>50)); ?>
		</div>
		<div class="span3"><br/>
		 <span style="font-size:12px;background:ivory;">Usar etiquetas hace que tu anuncio sea más fácil de encontrar, 
		 puedes usar palabras separadas por coma <strong>ejemplo</strong>: 
		 <strong><i>cocina, reparación de pcs en culiacan, alimentos enlatados sinaloa</i></strong></span>
		</div>
		<div class="span3">
		</div>
	</div>
	<div class="fluid-row">
		<div class="span12"><br/>
		  <?php echo $form->checkboxRow($model, 'active'); ?>
			<?php echo $form->checkboxRow($model, 'new'); ?>
			<?php echo $form->checkboxRow($model, 'in_stock'); ?>
		</div>
	</div>
</div>

<div id="tab2" class="well hide" style="height:auto;min-height:500px;">
	<div class="fluid-row">
		<div class="span12">
			<?php echo CHtml::decode($form->textAreaRow($model,'map'
																,array('rows'=>5,'cols'=>50,'maxlength'=>1000
																,'style'=>'width:50%'))); ?>
		</div>
	</div>
	</div>
<div id="tab3" class="well hide" style="height:auto;min-height:500px;">
	<fieldset>
		<legend>Color</legend>
		<?php 
			$this->widget('application.extensions.widgets.colorpicker.SActiveColorPicker', array(
			'model' => $model,
    		'attribute' => 'color',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
			));
		?>
	</fieldset>
		
	<fieldset>
		<legend><?php echo Yii::t('product','Main image'); ?></legend>

		<?php 
			$ruta=Yii::app()->baseUrl."/images/product/";
			$image_exists = file_exists(YiiBase::getPathOfAlias('webroot')."/images/product/".$model->image);
			
			if(!$image_exists)
			{
				$model->image = "noimage.jpg";
			}
			echo '<img id="main-img" border="0" width="15%" title="'.$model->name.'" alt="-" src="'.$ruta.$model->image.'"/>';
		?>
		<br/><br/>
		<?php echo CHtml::activeFileField($model, 'product-image'); ?>
	</fieldset>

	<br/>
	<fieldset>
		<legend><?php echo Yii::t('product','Angles images'); ?> 
		<small><?php echo Yii::t('product', 'You can select any images'); ?></small></legend>

		<!-- <div class='span9'> -->
			<?php
				$this->widget('CMultiFileUpload', array(
					'name' => 'angles',
					'accept' => 'jpeg|jpg|png', 
					'duplicate' => 'Imagen duplicada!', 
					'denied' => 'Formato de imagen no permitodo, solo se permiten los siguientes formatos: jpe, jpeg, png',
				));
			?>
		<!-- </div> -->
		<br/><br/>
		<?php $images = $model->getImages($model->isNewRecord ? 0 : $model->id, true);
			if(!$model->isNewRecord){
		?>
		<?php  
			if(count($images) > 0){
		?>
			<input class='btn btn-danger' type='submit' name='btnDeleteProductImages' onclick='return DeleteAngles();' value='<?php echo Yii::t('product','Delete selected angles'); ?>' />
			<input type='button' value='<?php echo Yii::t('app', 'Select all/none'); ?>' onclick="SelectAllNoneChecks('input[id^=product_image_active');"/>
		<?php }} ?>
		<br/><br/>
		<div class='span9'>
		<?php
			$angles = '';
			$ruta = Yii::app()->baseUrl."/images/product/angles/";
			$path=Yii::getPathOfAlias('webroot')."/images/product/angles/";
			$i = -1; $checked='';
			foreach ($images as $pic) {
				$i++; $checked='';
				if($pic->active==1)
					$checked = 'checked';
				$image = $pic->image;
				if(!file_exists($path.$pic->image))
    			$image = "noimage.jpg";

				$angles.="<div style='float:left;width:135px;margin-left:5px;'>
				<input name='ProductImage[".$i."][active]' id='product_image_active_".$i."' style='position:absolute;' type='checkbox' 
				".$checked."/><br/>
				<input type='hidden' value='".$pic->id."' name='ProductImage[".$i."][id]' />
				<input type='hidden' value='".$pic->image."' name='ProductImage[".$i."][image]' />
				".Yii::t('product', 'Position').":<input type='text' value='".$pic->position."' name='ProductImage[".$i."][position]' onkeypress='return OnlyNumbers(event);' style='width:40px;' maxlength='2'/>
				<br/>".Yii::t('product', 'Title').
				":<textarea name='ProductImage[".$i."][title]' rows='5' style='width:120px;' maxlength='60'>".$pic->title."</textarea>
				<img border='0' style='cursor:pointer;width:100%' src='".$ruta.$image."' title='".
				$pic->title."' alt='".$pic->alt."'/>
				</div>";
			}
			echo $angles;
		?>
		
		</div>
	</fieldset>
</div>
<div id="tab4" class="well hide" style="height:auto;min-height:500px;display:none;">
<?php if(!$model->isNewRecord){ ?><br/>
	<fieldset>
		<legend>
			<?php
					$i=-1;
					echo Yii::t('product', 'Product specifications');
			?>
					<a class='btn btn-info' href='index.php?r=specification/create' target='_blank'><?php echo Yii::t('app', 'Add new specification'); ?></a>
					<input type='button' name='btnDeleteSpec' class='btn btn-danger' value='<?php echo Yii::t('product', 'Delete'); ?>' onclick='DeleteSpecifications();'/>
					<input type='button' value='<?php echo Yii::t('app', 'Select all/none'); ?>' onclick="SelectAllNoneChecks('input[id^=ProductSpecification_active');"/>
		</legend>
					<?php
					$i++;
					$specifications = $model->getSpecificationsByProduct($model->id);

					foreach ($specifications as $spec) {
						$checked = ''; $i++;
						if($spec->active == 1)
							$checked = 'checked';
					?>
						<div style='float:left;width:100%;'>
							<input type='hidden' name='<?php echo "ProductSpecification[".$i."][id]"; ?>' value='<?php echo $spec->id ?>'/>
							<input type='hidden' name='<?php echo "ProductSpecification[".$i."][product_id]"; ?>' value='<?php echo $spec->product_id ?>'/>
							<input type='hidden' name='<?php echo "ProductSpecification[".$i."][name]"; ?>' style='width:50px;' value='<?php echo $spec->name ?>'/>
							<div style='width:60px; float:left; text-align:right;'><span style='text-align:right;'><?php echo $spec->name; ?></span></div>
							<input type='text' name='<?php echo "ProductSpecification[".$i."][value]"; ?>' maxlength='80' value='<?php echo $spec->value ?>' style='width:50px;'/>
							<input type='text' name='<?php echo "ProductSpecification[".$i."][description]"; ?>' maxlength='120' value='<?php echo $spec->description ?>' style='width:150px;'/>
							<input type='checkbox' name='<?php echo "ProductSpecification[".$i."][active]"; ?>' id='<?php echo "ProductSpecification_active_".$i; ?>' <?php echo $checked ?>/>
						</div>
					<?php 
					} 
					?>
					
				<div id='divRefreshSpecifications'>
					<?php 
						if(isset($model_specifications))
						{$i=-1; $checked='';
							foreach ($model_specifications as $spec) {
								$i++;
								if($spec->active = 1)
									$checked = 'checked';
								?>
								<div style='float:left;width:100%;' id='div_productspecification_'<?php echo $i ?> >
									<input type='hidden' name='<?php echo "ProductSpecification[".$i."][id]"; ?>' value='<?php echo $spec->id ?>'/>
									<input type='hidden' name='<?php echo "ProductSpecification[".$i."][product_id]"; ?>' value='<?php echo $spec->product_id ?>'/>
									<input type='hidden' name='<?php echo "ProductSpecification[".$i."][name]"; ?>' style='width:50px;' value='<?php echo $spec->name ?>'/>
									<div style='width:60px; float:left; text-align:right;'><span style='text-align:right;'><?php echo $spec->name; ?></span></div>
									<input type='text' name='<?php echo "ProductSpecification[".$i."][value]"; ?>' maxlength='80' value='<?php echo $spec->value ?>' style='width:50px;'/>
									<input type='text' name='<?php echo "ProductSpecification[".$i."][description]"; ?>' maxlength='120' value='<?php echo $spec->description ?>' style='width:150px;'/>
									<input type='checkbox' name='<?php echo "ProductSpecification[".$i."][active]"; ?>' id='<?php echo "ProductSpecification_active_".$i; ?>' <?php echo $checked ?>/>
								</div>
								<?php
							}
						}
					?>

				</div>
	</fieldset>
<?php } ?>	
	<br/>
	<fieldset>
			<legend><?php echo Yii::t('product', 'Product information'); ?><small> aparece en forma de pesta&ntilde;as en el detalle del producto.</small></legend>

	<!-- AQUI VA LA INFORMACION DEL PRODUCTO -->
	<input type='button' class='btn btn-info' value='<?php echo Yii::t('product', 'Add information'); ?>' onclick='AddInfo();'/>
	<?php 
		if($model->isNewRecord)
		{
			$render="<div class='fluid-row' id='wrapper-infos'>";
			$render.="  <div class='fluid-row' id='pinfo_0'>";
			$render.="    <div class='span4'>";
			$render.="      ".Yii::t('product', 'Name');
			$render.="    </div>";
			$render.="    <div class='span8'>";
			$render.="      ".Yii::t('product', 'Content');;
			$render.="    </div>";
			$render.="  </div>";
			echo $render;
		}
		else
		{
			echo $model->getProductInfoAdmin($model->id);
		}
	?>
	</fieldset>
	
</div>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit', 
		'label'=>Yii::t('product', 'Save'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
		'htmlOptions'=>array('onclick'=>"$.blockUI({message:'<h5>Estoy guardando su anuncio, por favor espere...</h5>'});"),
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jqueryblockui.js"></script>
<script type="text/javascript">
	function RemoveInfo(infoId)
	{
		if(confirm("Desea remover esta informacion ?")){
			$('#pinfo_'+infoId).remove();
		}
	}
	function AddInfo()
	{
		//wrapper-infos

		var id=parseInt($('div[id*=pinfo]')[$('div[id*=pinfo]').length - 1].id.split("_")[1]) + 1;
		var model_id = <?php echo $model->isNewRecord ? 0 : $model->id ?>;

		var render="<div class='fluid-row' id='pinfo_"+id.toString()+"'>";
		render+="  <div class='span4'>";
		render+="    <input type='hidden' id='ProductInfo_id' name='ProductInfo["+id.toString()+"][id]' value='0'/>";
		render+="    <input type='hidden' id='ProductInfo_product_id' name='ProductInfo["+id.toString()+"][product_id]' value='"+model_id+"'/>";
		render+="    <input type='text' id='ProductInfo_label' name='ProductInfo["+id.toString()+"][label]' value=''/>";
		render+="  </div>";
		render+="  <div class='span8'>";
		render+="    <textarea rows='3' cols='5' id='ProductInfo_content' name='ProductInfo["+id.toString()+"][content]' value=''></textarea>";
		render+="    <input type='hidden' id='ProductInfo_active' name='ProductInfo["+id.toString()+"][active]' value=1/>";
		render+="    <input type='button' class='btn btn-success' value='<?php echo Yii::t('product','Delete'); ?>' onclick='RemoveInfo("+id.toString()+");'/>";
		render+="  </div>";
		render+="</div>";

		$('#wrapper-infos').append(render);

	}

	function DeleteAngles()
	{
		return confirm("<?php echo Yii::t('product', 'Do you wish to delete, the selected angles ?'); ?>");
	}

	function DeleteSpecifications()
	{
		var res= confirm("<?php echo Yii::t('product', 'Do you wish delete selected specifications?'); ?>");
		if(res == true)
		{
			$('input[id^=ProductSpecification_active]').each(function(){
					if(this.checked == true)
					  this.parentElement.remove();
			});
		}
	}
	function MuestraTab(tab)
	{
		$('div.tabbutton').removeClass('tabactive');
		$('#tab1').removeClass('active').addClass('hide');
		$('#tab2').removeClass('active').addClass('hide');
		$('#tab3').removeClass('active').addClass('hide');
		$('#tab4').removeClass('active').addClass('hide');
		$('#'+tab).removeClass('hide').addClass('active');
		$('#'+tab+'button').addClass('tabactive');
	}
</script>
