<?php
/**
 * Description of Brands
 *muestra las principales marcas manejadas por aplicacion
 * @author Ulises Trujillo
 * 
 */
class CBrands extends CWidget {
 	public $total;

 	public function init()
	{
		// $this->$total=3;
	}
    public function run() {
 
        $this->show();
    }
	
    /**
	 * Renders brands from given number to show.
	 * @param int $count total brand to show
	 */
	public function show()
 	{
 		$brands=Brand::model()->findAll(
 			array(
	 			'condition'=>'active = 1',
	 			'limit'=>$this->total
 			));

 		if(!$brands)
 		{
 			echo Yii::t('app','No brands to show');
 			return;
 		}
    	$ruta=Yii::app()->baseUrl."/images/brand/";
	    $brand='<div id="div-brands">';
	    $brand.='  <div class="row-fluid bigtitle">';
	    $brand.='    <div class="span12"><center><h4>'.Yii::t('app','Brands').'</h4></center></div>';
	    $brand.='  </div>';

		$path = Yii::getPathOfAlias('webroot')."/images/brand/";

 		foreach ($brands as $item) {
			if(!file_exists($path.$item->image))
			{
				$item->image = "noimage.jpg";
			}
			
			$brand.='<div class="row-fluid">';
			$brand.='<div class="span12"><center>';
			$brand.=CHtml::link('<img class="img-rounded" border="0" width="60%" title="'.$item->name.'" alt="-" src="'.$ruta.$item->image.'"/>', array('site/search', 'token'=>$item->name));
			$brand.='</center></div></div>';

 		}
		$brand.='</div>';
		echo $brand;

 	}

 	
 	

}