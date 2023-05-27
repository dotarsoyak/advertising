<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title><?php echo $this->pageTitle; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
	  // 'type'=>'inverse', // null or 'inverse'
	'fixed'=>'',
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
											array('label'=>Yii::t('app','Home'), 'url'=>array('/site')),
											array('label'=>Yii::t('app','About'), 'url'=>array('/site/page/view/about')),
											array('label'=>Yii::t('app','Contact'), 'url'=>array('/site/contact')),
											array('label'=>Yii::t('app','Login'), 'url'=>array('/site/login'), 
												                                    'visible'=>Yii::app()->user->isGuest),
											array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 
												'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
											array('label'=>Yii::t('app','Registrarse'), 'url'=>array('/site/adduser'), 
												                                    'visible'=>Yii::app()->user->isGuest),
											array('label'=>'Dashboard', 'url'=>array('/user/profile'), 
												                                    'visible'=>!Yii::app()->user->isGuest),
				            ),
        ),
				'<div style="margin-left:5px; font-size:11pt; " class="brand">
				Directorio publicitario gratuito, Culiacán, Sinaloa.</div>',
    ),
   'htmlOptions'=>array('style'=>'z-index:6000;'),
)); ?>


<div style="width:98%; margin: 0 auto;">
	<div class="row-fluid">
		<?php 
			$this->renderPartial('/site/searchbox');
		?>
	</div>
	<div id="divMain">
		<div style="margin-bottom: 0.5em; padding: 3px;background: #ff9900;color:white;">
			<a href="<?php echo Yii::app()->createUrl('/site/adduser'); ?>" style="color:black;">Registrate</a> es grátis, fácil y rápido.
			<a href="https://plus.google.com/111324856238764758111" rel="publisher" style="color:black;float:right;">Google+</a>
			<br/>
		</div>
			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
			<?php endif?>
			
			<?php echo $content; ?>
	</div>
	<div class="row-fluid" id="page">

	</div><!-- page -->

</div>
<div id="footer" class="row-fluid footer" style="margin-top:2%">
	<div class="fluid-row">&nbsp;</div>
	<div class="fluid-row">
		<div class="span1"></div>
		<div class="span10 headers">
			<div class="span4"><a href="<?php echo Yii::app()->createUrl('/site/contact'); ?>"><?php echo Yii::t('app','Contact us')?></a></div>
			<div class="span4"><a href="<?php echo Yii::app()->createUrl('/site/page/view/About'); ?>"><?php echo Yii::t('app','About us')?></a></div>
			<div class="span4"><?php echo Yii::t('app','Customer service')?></div>
		</div>
		<div class="span1"></div>
	</div>
	<br/><br/>
	<div class="fluid-row">
		<div class="span1"></div>
		<div class="span10">
			Copyright &copy; <?php echo date('Y'); ?> by Ulises Trujillo
			All Rights Reserved.<br/>
			<?php //echo Yii::powered(); ?>
		</div>
		<div class="span1"></div>
	</div>
</div><!-- footer -->

	<style type="text/css">
	@media only screen and (min-device-width : 851px) 
	and (orientation : landscape) and (-webkit-min-device-pixel-ratio: 2)
	{
		/*#page{width:851px !important;}*/
		/*#principal{width:240px !important;}
		.pubs{width:18.7% !important}
		body{font-size:2.5em; line-height: 1.2em}*/
		/*#btnSend{height: 48px;width: 160px !important;font-size: 21pt;}*/
		/*#containerbox{width:17% !important;}*/
	}
	
	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) 
	and (orientation : landscape) and (-webkit-min-device-pixel-ratio: 2)
	{
		/*#page{width:1024px !important;}*/
		/*#principal{width:240px !important;}
		.pubs{width:18.7% !important}
		body{font-size:2.5em; line-height: 1.2em}*/
		/*#btnSend{height: 48px;width: 160px !important;font-size: 21pt;}*/
	}

	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) 
	and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 2)
	{
		/*#page{width:768px !important;}*/
		/*#principal{width:180px !important;}
		.pubs{width:18.7% !important}*/
		/*#containerbox{width:100% !important;}*/
		/*body{font-size:2.5em;line-height: 1.2em}*/
		/*#btnSend{height: 48px;width: 160px !important;font-size: 21pt;}*/
	}
	/* Smartphones (portrait and landscape) ----------- */
	@media only screen 
	and (min-device-width : 320px) 
	and (max-device-width : 480px) {
		/*#containerbox{width:100% !important;}*/
		/*body{font-size:1.5em;line-height: 1.2em}*/
	}

	</style>

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js" data-pin-hover="true"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" media="screen, projection" />
	<?php Yii::app()->bootstrap->register(); ?>
	<link href="https://plus.google.com/104498306832010018057" rel="publisher" />
	<script type="text/javascript" async defer
	  src="https://apis.google.com/js/platform.js?publisherid=104498306832010018057">
	</script>
  <?php //include('analyticstracking.php'); ?>
</body>
</html>
