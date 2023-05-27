<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="caption">Manage Products</div>
<br/><br/>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$records = $model->search();
$recordCount=Product::model()->findAll($model->search()->criteria);

if(sizeof($recordCount)==0)
{
	?><br/><br/>
	<div class="caption">Aún no tienes anuncios, que esperas para agregar uno: 
	<a href='<?php echo Yii::app()->baseUrl.'/index.php/product/create' ?>'>crear un anuncio</a></div>
	<?php
}
else
{
	$this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$records,
		'filter'=>$model,
		'columns'=>array(
			'id',
			'code',
			'name',
			'description',
			'price',
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
			),
		),
	));
}

?>

