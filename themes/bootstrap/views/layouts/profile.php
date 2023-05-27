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
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href="<?php echo Yii::app()->theme->baseUrl.'/css/styles.css' ?>" rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl."/assets/asdf80sfd/utils/utils.js" ?>"></script>

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
	#menulateral{margin-top:15px;height:210px;background: black}
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
							'url'=>Yii::app()->createUrl('/site/logout')),
						array('label'=>'Dashboard', 
							'url'=>Yii::app()->createUrl('/user/profile')),
						array('label'=>Yii::t('app', 'Mi usuario'), 'url'=>'#', 
							'items'=>array(
									array('label'=>'Cambiar password','url'=>Yii::app()->createUrl('/user/updatePass')),
									array('label'=>'-','itemOptions'=>array('class'=>'divider')),
									array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 
									'url'=>Yii::app()->createUrl('/site/logout')),
								)
						),
          ),
        ),
    ),
)); ?>
<div class="row-fluid">
	<!-- <div class="span12" style='margin-top:15px;background:black;'> -->
			<div class="span2" id="menulateral">
				<ul class='admin-menu'>
					<li style="padding-top: 5px;background: rgb(108, 108, 110);">
						<ul>
							<li>
								<a href="index.php/site/index" style="color:white;" target="_blank">VER SITIO WEB</a>
							</li>
						</ul>
					</li>
					<li id='title'>
						Publicidad
					</li>
					<li>
						<ul>
							<li>
								<a href="<?php echo Yii::app()->baseUrl; ?>/index.php/product/admin">Ver mis anuncios</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->baseUrl; ?>/index.php/product/create">Crear anuncio</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="span10" style="background:white;min-height: 570px;margin-left:5px !important">
				<br/>
				<?php echo $content; ?>
			</div>
	<!-- </div> -->
	
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
				Copyright &copy; <?php echo date('Y'); ?> by publicidadculiacan.com<br/>
				All Rights Reserved.<br/>
				<?php //echo Yii::powered(); ?>
			</div>
			<div class="span1"></div>
		</div>
	</div><!-- footer -->
</body>
</html>
