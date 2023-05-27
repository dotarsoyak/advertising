<?php
/**
 * Description of products
 *muestra las ubicaciones de las tiendas manejadas por aplicacion
 * @author Ulises Trujillo
 * 
 */
class ProductByCategory extends CWidget {
 	public $total=5;
 	public $categoryId=1;
 	public $productId=1;

 	public function init()
	{
	}

    public function run() {
        $this->show();
    }
	
    /**
	 * Renders products from given categoryId to show.
	 * @param int $total product by categoryId to show
	 */
	public function show()
 	{
 		$products=Product::model()->findAll(
 			array(
	 			'condition'=>'active = 1 and category_id=:category_id and id != '.$this->productId,
	 			'params'=>array(':category_id'=>$this->categoryId),
	 			'limit'=>$this->total,
		));

 		if(!$products)
 		{
 			echo Yii::t('app','No shops to show');
 			return;
 		}

    	$img=Yii::app()->baseUrl."/images/product/";
		$prods='<div id="div-prod-by-cat">';
		$prods.='  <br/><div class="row-fluid">';
	    $prods.='  <div class="span12 same-category"><h4>'.Yii::t('app','Other related shops').'</h4></div>';
	    $prods.='  </div>';

		$prods.='   <div class="row-fluid">';
 		$path = Yii::getPathOfAlias('webroot')."/images/product/";
						
 		foreach ($products as $item) {
			if(!file_exists($path.$item->image))
			{
				$item->image = "noimage.jpg";
			}
			$prods.=CHtml::link('<img border="0" width="150px" style="vertical-align:top; margin-right:3px;" title="'.$item->name.'" alt="-" src="'.$img.$item->image.'"/>', 
				array($item->code));
 		}

		$prods.='  </div>';
		$prods.='</div>';
		echo $prods;
 	}

 	
 	

}