<?php
/* @var $this StoreController */
/* @var $model Store */

?>

<h2>Creando tienda</h2>

<?php echo $this->renderPartial('_form', 
		array(
			'model'=>$model,
			'errores'=>$errores,
		)); 
?>