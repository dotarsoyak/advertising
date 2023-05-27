<?php

/**
 * @var AdminController $this
 */
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');

?>

<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <meta charset="utf-8">

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
  <!-- <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow%3A400%2C700%7CPT+Sans+Caption%3A400%2C700&ver=3.9.1' rel='stylesheet' type='text/css'> -->
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl."/assets/asdf80sfd/utils/utils.js" ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/views/layouts/admin.css" media="screen, projection" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>

<style type="text/css">
  body {
      padding-top: <?php echo empty($this->module->sectionMenu) ? '40px' : '96px'?>;
      /*background-color: #9B9B9B !important;*/
  }
  ul{margin:0px 0px 10px 0px !important;}
	.admin-menu{
		list-style: none;
		height: 1em;
		font-size: 1.2em;
		/*background: black;*/
	}
	.admin-menu li#title{
		margin-bottom: 10px;
		background-color: #cecece;
		color:black;padding-left:5px;
	}
	.admin-menu li ul li{
		list-style: none;
		height: 1em;
		color:black;
		padding:0 0 5px 10px;
	}
	.admin-menu a{color:#97AFFF;text-decoration: none;}
	.admin-menu a:hover{color:#0081FF;}
	#footer{color:white;}
/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
	#menulateral{display:none;}
}
/* iPads (portrait and landscape) ----------- */
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
/* Styles */
}
</style>
</head>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
          'class'=>'bootstrap.widgets.TbMenu',
          'items'=>array(
						array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 
							'url'=>'/index.php/site/logout'),
						array('label'=>'Dashboard', 
							'url'=>'../site/admin',),
						array('label'=>Yii::t('app', 'Mi usuario'), 'url'=>'#', 
							'items'=>array(
									array('label'=>'Cambiar password','url'=>'../user/updatePass'),
									array('label'=>'-','itemOptions'=>array('class'=>'divider')),
									array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 
									'url'=>'../site/logout'),
								)
						),
          ),
        ),
    ),
)); ?>
<div class="row-fluid">
	<div class="span12" style='margin-top:15px;background:black;'>
			<div style="float:left;width:14%;" id="menulateral">
				<ul class='admin-menu'>
					<li style="padding-top: 5px;background: rgb(108, 108, 110);">
						<ul>
							<li>
								<a href="../site/index" style="color:white;" target="_blank">VER MI SITIO WEB</a>
							</li>
						</ul>
					</li>
					<li id='title'>
						Productos
					</li>
					<li>
						<ul>
							<li>
								<a href="../product/admin">Administrar</a>
							</li>
							<li>
								<a href="../product/create">Crear producto</a>
							</li>
						</ul>
					</li>
					<?php if(User::model()->getRole() == 'publish'): ?>
					<li id='title'>
						Contenidos
					</li>
					<li>
						<ul>
							<li>
								<a href="../cms/update&id=1">Acerca de</a>
							</li>
							<li>
								<a href="../cms/update&id=3">Teléfonos</a>
							</li>
							<li>
								<a href="../post/admin">Posts</a>
							</li>
						</ul>
					</li>
					<li id='title'>
						Catalogos
					</li>
					<li>
						<ul>
							<li>
								<a href="../store/admin">Sucursales</a>
							</li>
							<li>
								<a href="../category/admin">Categorias</a>
							</li>
							<li>
								<a href="../brand/admin">Marcas</a>
							</li>
							<li>
								<a href="../gallery/index">Galería</a>
							</li>
						</ul>
					</li>
					<li id='title'>
						Sliders
					</li>
					<li>
						<ul>
							<li>
								<a href="../slide/index">Main slider</a>
							</li>
						</ul>
					</li>
					<li id='title'>
						Configuración
					</li>
					<li>
						<ul>
							<li>
								<a href="../appconfiguration/admin">Configuración</a>
							</li>
							<li>
								<a href="../appconfiguration/logo">Cambiar logotipo</a>
							</li>
						</ul>
					</li>
					<?php endif; ?>
				</ul>
			</div>
			<div style="background:white;float:left;width:85%;padding-left:1%;min-height: 570px;">
				<div class="span11">
				<?php echo $content; ?>
				</div>
			</div>
	</div>
	
</div>
	<div id="footer" class="row-fluid footer" style="background:black;">
		<div class="fluid-row">&nbsp;</div>
		<div class="fluid-row">
			<div class="span1"></div>
			<div class="span10 headers">
				<div class="span4"><?php echo Yii::t('app','Contact us')?></div>
				<div class="span4"><?php echo Yii::t('app','About us')?></div>
				<div class="span4"><?php echo Yii::t('app','Customer service')?></div>
			</div>
			<div class="span1"></div>
		</div>
		<br/><br/>
		<div class="fluid-row">
			<div class="span1"></div>
			<div class="span11">
				Copyright &copy; <?php echo date('Y'); ?> by PublicidadCuliacan.com<br/>
				All Rights Reserved.<br/>
				<?php //echo Yii::powered(); ?>
			</div>
			<div class="span1"></div>
		</div>
	</div><!-- footer -->
</body>
</html>
