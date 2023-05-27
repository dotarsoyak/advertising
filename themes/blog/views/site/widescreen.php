<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>

<div class="fluid-row fontsegoe">
	<!-- <div style="margin: 0 8.5%; height:90%; vertical-align:middle;"> -->
		<?php 
		$this->widget('bootstrap.widgets.TbCarousel', array(
		    'htmlOptions'=>array('id'=>'yuicarusel', 'class'=>'row-fluid'),
		    'items'=>array(
		        array('image'=>Yii::app()->baseUrl.'/images/banner/senz-culiacan.jpg', 'label'=>'First Thumbnail label', 'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
		        	,'imageOptions'=>array('width'=>'100%')),
		        array('image'=>Yii::app()->baseUrl.'/images/banner/senz-culiacan-2.jpg', 'label'=>'Second Thumbnail label', 'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
		        	,'imageOptions'=>array('width'=>'100%')),
		        array('image'=>Yii::app()->baseUrl.'/images/banner/senz-culiacan-3.jpg', 'label'=>'Third Thumbnail label', 'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
		        	,'imageOptions'=>array('width'=>'100%')),
		    ),
		)); 

		?>
	<!-- </div> -->
</div>
<style type="text/css">
	.div{
		font-family: wf_segoe-ui_light,"Segoe UI Light","Segoe WP Light","Segoe UI","Segoe WP",Tahoma,Arial,sans-serif !important;
		font-weight: 400;
		font-size: 24px;
		line-height: 1.2em;	
	}
	.indent{text-indent:2em;}
</style>	
<div class="row-fluid" id="div-main-content">
	<div class="row-fluid div" >
		<!-- franja sucursales -->
		<div class="row-fluid div" style='background-color:#4C8F2D;'>
			<div style="margin: 0 8.5%; margin-top:1%; margin-bottom:30%; height:90%; vertical-align:middle;">
		 		<?php 
					$ruta=Yii::app()->baseUrl."/images/product/";
					$image = "modelos-de-cortinas-para-sala.jpg";
			 	?>
				<div class="span5" style="margin-top:17px;">
					<img border='0' style='height:300px;' src="<?php echo $ruta.$image ?>" title='<?php echo $image ?>' alt='<?php echo $image ?>'>
				</div>
				<div class="span7" style='height:100%; color:#ffffff'>
					<h3>Tenemos gran variedad de modelos</h3>
					<p class='indent'>
						Para elegir la mejor cortina que mejor se ajuste a la decoración de su hogar, 
						existen una gran variedad de modelos, diseños y colores muy modernos que nos 
						permiten crear un estilo diferente y moderno con una perfecta armonía.
						Son infinitos los modelos que en la actualidad son confeccionados 
						con diferentes tamaños, estilo de diseños, clases de telas, grosor, etc.
					</p>
				</div>
			</div>
		</div>

		<div class="row-fluid div" style='background-color:#ffffff;'>
			<div style="color:#000000; margin: 0 8.5%; margin-top:1%; margin-bottom:27%; height:90%; vertical-align:middle;">
				<?php 
					$ruta=Yii::app()->baseUrl."/images/product/";
			 	?>
				
				<div class="fluid-row">
					Escoge el modelo que mas te guste
				</div><br/>
				<div class="fluid-row">
				 	<div class="span4">
				 	  Sheer básica
				 		<img border='0' style='height:300px;' src="<?php echo $ruta.'sheer.jpg' ?>" title='sheer' alt='sheer'>
				 	</div>
				 	<div class="span4">
				 		Sheer luxury
				 		<img border='0' style='height:300px;' src="<?php echo $ruta.'sheer-luxury.jpg' ?>" title='sheer-luxury' alt='sheer-luxury'>
				 	</div>
				 	<div class="span4">
				 		Cortinas enrollables
				 		<img border='0' style='height:300px;' src="<?php echo $ruta.'enrollable.jpg' ?>" title='enrollable' alt='enrollable'>
				 	</div>
				</div>

			</div>
		</div>

		<!-- franja cortinas -->
		<div class="row-fluid div" style='background-color:#68217a;'>
			<div style="color:#000000; margin: 0 8.5%; margin-top:1%; margin-bottom:30%; height:90%; 
			vertical-align:middle; color:#ffffff">
				<?php 
					$ruta=Yii::app()->baseUrl."/images/product/";
					$image = "cortina_p1.jpg";
			 	?>
				<div class="span5" style="margin-top:17px;">
					<img border='0' style='height:300px;' src="<?php echo $ruta.$image ?>" title='<?php echo $image ?>' alt='<?php echo $image ?>'>
				</div>
				<div class="span7" style='height:100%;'>
					<h3>Te asesoramos para que decores tu hogar</h3>
					<p class='indent'>
						Inspirate! con consejos, tendencias e ideas para decoración de interiores.
					</p>
				</div>
			</div>
		</div>

		<!-- franja cortinas -->
		<div class="row-fluid div" >
			<div style="margin: 0 8.5%; margin-top:1%; color:#000000; margin-bottom:5%; height:90%; vertical-align:middle;">
		 		<div class="span12">
		 			Ubicanos en nuestras sucursales
		 		</div><br/><br/>
			 	<div class="row-fluid">
			 	<?php $this->widget('application.extensions.widgets.CStores', 
			 				array('total'=>3, 'orientation'=>'horizontal',));?>
			 	</div>
			</div>
		</div>

	</div>

</div>
<!-- para cuando es un ipad utilizar el span 12 -->
<!-- <div id="divSpan12" style="display:none;">
	<?php //$this->widget('application.extensions.widgets.CategoriesIpad', array('total'=>3));?>
</div> -->
