<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>

<div class="row-fluid" id="div-main-content">
	<div class="fluid-row" style="margin: 10px 10px;">

			<?php $this->widget('application.extensions.widgets.Posts'); ?>

			<div class="fluid-row">
				<div class="span12"><br/>
				<br/>
				watchers news here!;
				<br/>
				<br/>
				</div>
			</div>

	</div>
</div>
	<!-- para cuando es un ipad utilizar el span 12 -->
	<div id="divSpan12" style="display:none;">
		<?php $this->widget('application.extensions.widgets.CategoriesIpad', array('total'=>3));?>
	</div>
