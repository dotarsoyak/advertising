<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" media="screen, projection" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>

</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
				array('label'=>Yii::t('app','Home'), 'url'=>array('/site/index')),
				array('label'=>Yii::t('app','About'), 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>Yii::t('app','Contact'), 'url'=>array('/site/contact')),
				array('label'=>Yii::t('app','Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>

<div class="row-fluid" id="page">


<div class="row-fluid">
<?php 
	$this->renderPartial('/site/searchbox');
?>
	<div id="divMain" style="margin: 0 8.5% ">
		<div class="span12">
			<?php 
			if(isset($this->breadcrumbs)):?>
				<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
			<?php endif?>
			<div class="row-fluid" id="product-detail-content">
				<div class="fluid-row" style="margin: 10px 10px;">
					<div class="span9">
						<?php echo $content; ?>
					</div>
					<div class="span3">
						<?php $this->widget('application.extensions.widgets.NewProducts', array('total'=>3));?>
						<?php $this->widget('application.extensions.widgets.CBrands', array('total'=>3));?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<div class="clear"></div>

<br/><br/>
<br/><br/>


</div><!-- page -->
	<div id="footer" class="row-fluid footer">
		<div class="fluid-row">&nbsp;</div>
		<div class="fluid-row">
			<div class="span1"></div>
			<div class="span10">
				<div class="span4"><?php echo Yii::t('app','Contact us')?></div>
				<div class="span4"><?php echo Yii::t('app','About us')?></div>
				<div class="span4"></div>
			</div>
			<div class="span1"></div>
		</div>
		<br/><br/>
		<div class="fluid-row">
			<div class="span1"></div>
			<div class="span10">
				Copyright &copy; <?php echo date('Y'); ?> by Ulises Trujillo.<br/>
				All Rights Reserved.<br/>
				<?php //echo Yii::powered(); ?>
			</div>
			<div class="span1"></div>
		</div>
	</div><!-- footer -->

</body>
</html>
