<?php
/**
 * Description of products
 *muestra las ubicaciones de las tiendas manejadas por aplicacion
 * @author Ulises Trujillo
 * 
 */
class NewProducts extends CWidget {
 	public $total=5;

 	public function init()
	{
	}

  public function run() {

      $this->show();
  }
	
  /**
	 * Renders products from given number to show.
	 * @param int $count total new product to show
 	*/
	public function show()
 	{
 		$products=Product::model()->findAll(array(
 			'condition'=>'new = 1 and active = 1',
 			'limit'=>$this->total
		));

 		if(!$products)
 		{
 			echo Yii::t('app','No products to show');
 			return;
 		}
    	$ruta=Yii::app()->baseUrl."/images/product/";
	    $store='<div id="div-newprods">';
	    $store.='  <div class="row-fluid bigtitle">';
	    $store.='    <div class="span12"><center><h4>'.Yii::t('app','New products').'</h4></center></div>';
	    $store.='  </div>';

		$path = Yii::getPathOfAlias('webroot')."/images/product/";

		
 		foreach ($products as $item) {
			$store.='<div class="row-fluid">';

			if(!file_exists($path.$item->image))
			{
				$item->image = "noimage.jpg";
			}

			$store.='<div class="span12 products"><center>';
			$store.=$item->name.'<br/>';
			$store.=CHtml::link('<img border="0" width="60%" title="'.$item->name.'" alt="-" src="'.$ruta.$item->image.'"/>', array('product/detail', 'id'=>$item->id));
			$store.='</center><br/>';
			$store.='</div></div>';

 		}
		$store.="</div>";
		echo $store;
 	}

 	
 	

}