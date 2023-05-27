<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	Yii::t('app','Search')=>array('index'),
);
?>

<h1>Resultados de la búsqueda</h1>

<?php 

	if($pages !== null)
	{
		$this->widget('CLinkPager', array(
	          'currentPage'=>$pages->getCurrentPage(),
	          'pages'=>$pages
	  ));
	  echo "<br/><br/>";
	}

	Yii::app()->filtro->renderProducts($products);
	
	if($pages !== null)
	{
		$this->widget('CLinkPager', array(
	          'currentPage'=>$pages->getCurrentPage(),
	          'pages'=>$pages
	  ));
	  echo "<br/><br/>";
	}

?>

<script type="text/javascript">
	$('#search-box').val('<?php echo $token; ?>');
</script>


	