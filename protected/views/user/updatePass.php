<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'User'=>array('/user'),
	'Update',
);
?>
<h1>Cambiar mi password</h1>

<div class="search-form">
<?php 
$this->renderPartial('_form',array(
	'model'=>$model,
)); 
?>
</div><!-- search-form -->
