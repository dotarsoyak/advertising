<?php
/* @var $this ProductController */
/* @var $model Product */
$this->breadcrumbs=array(
	$model->name,
);
	
?>

<?php 
$this->widget('application.extensions.widgets.SocialShareButton.SocialShareButton', array(
        'style'=>'horizontal',
        'networks' => array('facebook','googleplus','linkedin','twitter'),
        'data_via'=>'', //twitter username (for twitter only, if exists else leave empty)
));
?>

<h1><?php echo $model->name; ?></h1>
<style type="text/css"></style>
<div class="row-fluid">
	<div class="span7">
		<center>
			<?php 
		    $images=$model->getImages($model->id, true);
		    $img=Yii::app()->baseUrl."/images/product/";
	  		$openModal="$('#modal_".$model->id."').modal();";
				
				$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal_'.$model->id));
			?>		 
				<div class="modal-header">
				    <a class="close" data-dismiss="modal">&times;</a>
				    <h4><?php echo $model->name?></h4>
				</div>
				 
				<div class="modal-body">
					<?php
						$ruta=Yii::app()->baseUrl."/images/product/";
						$path = Yii::getPathOfAlias('webroot')."/images/product/";

						if(!file_exists($path.$model->image))
						{
							$model->image = "noimage.jpg";
						}

						echo CHtml::link('<img id="main-img" border="0" width="70%" title="'.$model->name.'" alt="-" src="'.$ruta.$model->image.'"/>', '#');
					?>
				</div>
				<div class="modal-footer">
					<?php
						    $this->widget('bootstrap.widgets.TbButton', array(
						        'label'=>Yii::t('app','Close'),
						        'url'=>'#',
						        'htmlOptions'=>array('data-dismiss'=>'modal'),
						    ));
					?>		    
				</div>
			<?php		
				$this->endWidget();

				$ruta=Yii::app()->baseUrl."/images/product/";
				echo CHtml::link('<img onclick="'.$openModal.'" id="main-img" border="0" width="70%" title="'.$model->name.'" alt="-" src="'.$ruta.$model->image.'"/>', '#');
			?>
		</center>
	</div>
	<div class="span5 description">
		<div class="fluid-row">
			<strong>
				<span><?php 
				echo Yii::t('app','Information')?></span>
			</strong>
			<p><?php echo $model->description; ?></p>
		</div>
		<div class="fluid-row price">
			<strong>
				<span><?php echo Yii::t('app','Price')?></span>
			</strong>
			<p><?php echo $model->price; ?></p>
		</div>
		<div class="fluid-row price">
			<strong>
				<span><?php echo Yii::t('app','Tags')?></span>
			</strong>
			<p><?php 
					// $this->widget('application.extensions.widgets.TagCloud', array(
					// 		'title'=> Yii::t('zii', 'Tags'),
					// 		'withTitle'=>false,
					// 		)
					// ); 
			?>
			</p>
		</div>
		<div class="fluid-row price">
		    <?php
		    	echo $model->getColor($model->id);
		    ?>
		    <br/><br/>
		</div>
		<div class="fluid-row price">
		    <?php
		    	echo $model->getColors($model->id);
		    ?>
		</div>
	</div>
</div>
<br/>
<div class="row-fluid">
	<div class="span12">
		<?php 
		    $images=$model->getImages($model->id);
		    $img=Yii::app()->baseUrl."/images/product/angles/";
		    $path=Yii::getPathOfAlias('webroot')."/images/product/angles/";

			foreach ($images as $item) {
    		$openModal="$('#modal_".$item->id."').modal();";
				$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal_'.$item->id));
		?>		 
				<div class="modal-header">
				    <a class="close" data-dismiss="modal">&times;</a>
				    <h4><?php echo $item->title?></h4>
				</div>
				 
				<div class="modal-body">
				    <p><?php
				      $image = $item->image;
				    	if(!file_exists($path.$item->image))
				    		$image = "noimage.jpg";
						echo '<center><img border="0" width="70%" alt="Image" title="'.$item->title.'" alt="ultracommerce" src="'.$img.$image.'"/></center>';
				    ?></p>
				</div>
				 
				<div class="modal-footer">
		<?php
				    $this->widget('bootstrap.widgets.TbButton', array(
				        'label'=>Yii::t('app','Close'),
				        'url'=>'#',
				        'htmlOptions'=>array('data-dismiss'=>'modal'),
				    ));
		?>		    
				</div>

		<?php		

				$this->endWidget();
				$image = $item->image;
				if(!file_exists($path.$item->image))
    			$image = "noimage.jpg";
				echo '<a href="#"><img onclick="'.$openModal.'" width="120px" alt="'.$item->alt.'" 
				title="'.$item->title.'" alt="ultracommerce" src="'.$img.$image.'"/></a>';
			}
		?>
	</div>
</div>
<br/>
<div class="row-fluid">
	<div class="span12">
		<?php 
			// $this->widget('bootstrap.widgets.TbTabs', array(
			//     'type'=>'tabs', // 'tabs' or 'pills'
			//     'tabs'=>$model->productInfo($model->id),
			// )); 
		?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php 
			$this->widget('application.extensions.widgets.ProductByCategory', array(
							'total'=>5,
							'categoryId'=>$model->category_id,
							'productId'=>$model->id,
							)
					);
		?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php if(strlen($model->video)!=0)
			{
				echo '<div class="span12 same-category">';
				echo '	<h4>Video</h4>';
				echo '</div>';
			}
		?>
		<?php echo $model->video;?>
	</div>
</div>


