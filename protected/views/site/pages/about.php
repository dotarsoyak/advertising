<?php
/* @var $this SiteController */
$this->layout='//layouts/main';
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<div class="fluid-row" style="margin: 0px 10px; padding: 10px;">
	<h1>About</h1>


<?php 

		$content_about=Cms::model()->findAll(
		array(
			'condition'=>'name = \'about\'',
		));

		if(!$content_about)
		{
			echo Yii::t('app','Please add content to this page');
			return;
		}
  	
 		foreach ($content_about as $item) {
		  echo "<p>".$item->content."</p>";
 		}
?>
	<p></p>
</div>
