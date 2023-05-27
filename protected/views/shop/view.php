<?php
/* @var $this ProductController */
/* @var $model Product */
?>

<h3>Se creó satisfactoriamente el sitio con los siguientes datos:</h3>
<br/>

<?php 
// $model = new Shop();
// $model->name = 'volante en linea';
// $model->directory_name = 'volante';
// $model->username = 'daniel';
// $model->password = 'daniel123';
// $model->email = 'daniel@gmail.com';
?>

<h4>Nombre del sitio:</h4><?php echo $model->name; ?>
<h4>Usuario administrador:</h4><?php echo $model->username; ?>
<h4>Password:</h4><?php echo $model->password; ?>
<h4>Correo:</h4><?php echo $model->email; ?>

<h5>Para administrar el sitio vaya a la siguiente dirección e ingrese su nombre de usuario y password:</h5>
<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$model->directory_name.'/index.php/site/login'; ?>" target="_blank">
<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$model->directory_name.'/index.php/site/login'; ?></a>

<h5>Para ver el sitio vaya a:</h5>
<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$model->directory_name; ?>" target="_blank">
<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$model->directory_name; ?></a>

