<?php
/* @var $this SpecificationController */
/* @var $model Specification */

$this->breadcrumbs=array(
	'Specifications'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Specification', 'url'=>array('index')),
	array('label'=>'Create Specification', 'url'=>array('create')),
	array('label'=>'Update Specification', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Specification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Specification', 'url'=>array('admin')),
);
?>

<h1>View Specification #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
