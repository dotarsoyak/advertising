<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow%3A400%2C700%7CPT+Sans+Caption%3A400%2C700&ver=3.9.1' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" media="screen, projection" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
<style type="text/css">

/*@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
	#divSpan12{display:block !important;}
	div.span3{display:none !important;}
	div.span6{display:none !important;}
	div.span3{display:none !important;}
	#divMain{margin:0!important;}
	#footer{display:none !important;}
	body{background-color:black;}
}*/

</style>

</head>

<body>
	
<?php 
	$this->renderPartial('/site/searchbox');
?>
<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
				array('label'=>Yii::t('app','Home'), 'url'=>array('/site/index')),
				array('label'=>Yii::t('app','About'), 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>Yii::t('app','Contact'), 'url'=>array('/site/contact')),
				array('label'=>Yii::t('app','Galería'), 'url'=>array('/site/gallery')),
				array('label'=>Yii::t('app','Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>


<div class="row-fluid" id="page">

		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>
		
		<?php echo $content; ?>

	<div id="footer" class="row-fluid footer fontsegoe" >
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
				Copyright &copy; <?php echo date('Y'); ?> by Senz.<br/>
				All Rights Reserved.<br/>
				<?php //echo Yii::powered(); ?>
			</div>
			<div class="span1"></div>
		</div>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
