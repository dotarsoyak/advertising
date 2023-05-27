<?php
/* @var $this StoreController */
/* @var $model Store */

// $this->breadcrumbs=array(
// 	'Stores'=>array('index'),
// 	$model->name,
// );

?>

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>

<div class="fluid-row">

	<p><strong>Tienda:</strong> <?php echo $model->name; ?></p>
	<p><strong>Estamos ubicados en:</strong> <?php echo $model->address; ?></p>

	<div class="fluid-row" >
		<div class="span6">
		<?php 
		$ruta=Yii::app()->baseUrl."/images/store/";
		echo '<img border="0" width="100%" title="'.$model->name.'" alt="-" src="'.$ruta.$model->image_hq.'"/>';
		 ?>
			
		</div>
		<div class="span6">
			<div class="span12">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3621.6829288577746!2d-107.39981095242308!3d24.80630851675921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2smx!4v1405289578369" 
			width="100%" height="408px" frameborder="0" style="border:0"></iframe>
			</div>
		</div>
	</div>
</div>
<div class="span12">

</div>

