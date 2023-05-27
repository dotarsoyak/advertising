<?php
/**
 * Description of categories
 *muestra las ubicaciones de las tiendas manejadas por aplicacion
 * @author Ulises Trujillo
 * 
 */
class Categories extends CWidget {
 	public $total;

 	public function init()
	{
	}

    public function run() {
 
        $this->show();
    }
	
    /**
	 * Renders categories from given number to show.
	 */
	public function show()
 	{
 		$categories=Category::model()->findAll(
 					array(
 						'condition'=>'active = 1',
 						'limit'=>$this->total,
					)
 				);

 		if(!$categories)
 		{
 			echo Yii::t('app','No categories to show');
 			return;
 		}
    	$ruta=Yii::app()->baseUrl."/images/category/";
	    $cat='<div id="div-categories">';
	    $cat.='  <div class="row-fluid bigtitle">';
	    $cat.='    <div class="span12"><center><h4>'.Yii::t('app','Categories').'</h4></center></div>';
	    $cat.='  </div>';

 		foreach ($categories as $item) {
	        $cat.=CHtml::link('<div class="row-fluid" style="width:90%">'.$item->name.'</div>', 
				array('category/view','id'=>$item->id)
			);
 		}
	    $cat.="</div>";
	    echo $cat;
 	}

 	
 	

}