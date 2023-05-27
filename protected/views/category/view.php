<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);

?>

<h1 id="main-title"><?php echo ucfirst($model->name); ?></h1>
<p><?php echo $model->description; ?></p>

<div class="fluid-row filters">
	<br/>
	<div class="btn-toolbar">
	    <?php
        $rawUrlPrice = "index.php?r=category/view&id=".$model->id;
        $rawUrlName = "index.php?r=category/view&id=".$model->id;

        if(strlen(strpos(strtolower(Yii::app()->request->queryString), "sort=price")) != 0)
        {
        	$rawUrlPrice.="&sort=price";
        }

        if(strlen(strpos(strtolower(Yii::app()->request->queryString), "sort=name")) != 0)
        {
      		$rawUrlName.="&sort=name";
        }

        if(strlen(strpos(strtolower(Yii::app()->request->queryString), "brand")) != 0)
        {
      		$rawUrlPrice.="&brand=".Yii::app()->request->getParam("brand");
      		$rawUrlName.="&brand=".Yii::app()->request->getParam("brand");
        }

        if(strlen(strpos(strtolower(Yii::app()->request->queryString), "new")) != 0)
        {
      		$rawUrlPrice.="&new=1";
      		$rawUrlName.="&new=1";
        }
        if(strlen(strpos(strtolower(Yii::app()->request->queryString), "color")) != 0)
        {
      		$rawUrlPrice.="&color=".Yii::app()->request->getParam("color");
      		$rawUrlName.="&color=".Yii::app()->request->getParam("color");
        }
        if(strlen(strpos(strtolower(Yii::app()->request->queryString), "type")) != 0)
        {
      		$rawUrlPrice.="&type=".Yii::app()->request->getParam("type");
      		$rawUrlName.="&type=".Yii::app()->request->getParam("type");
        }

        if(strlen(strpos(strtolower($rawUrlPrice), "sort=price")) == 0)
        {
					$rawUrlPrice.="&sort=price";
        }

        if(strlen(strpos(strtolower($rawUrlPrice), "sort=name")) == 0)
        {
					$rawUrlName.="&sort=name";
        }

	    	$this->widget('bootstrap.widgets.TbButtonGroup', array(
		        'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		        'buttons'=>array(
		            array('label'=>Yii::t('app','Sort by'), 'items'=>array(
		                array('label'=>Yii::t('app','Price'), 'url'=>$rawUrlPrice),
		                array('label'=>Yii::t('app','Name'), 'url'=>$rawUrlName),
		            )),
		        ),
	    	)); 
	    ?>
	</div>
</div>

<?php
	$this->widget('CLinkPager', array(
          'currentPage'=>$pages->getCurrentPage(),
          'pages'=>$pages
  ));
  echo "<br/><br/>";
    
	Yii::app()->filtro->renderProducts($products);

	$this->widget('CLinkPager', array(
            'currentPage'=>$pages->getCurrentPage(),
            'pages'=>$pages
    ));


	echo "<br/><br/>";

?>
