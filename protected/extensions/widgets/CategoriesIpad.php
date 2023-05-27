<?php
/**
 * Description of categories
 *muestra las ubicaciones de las tiendas manejadas por aplicacion
 * @author Ulises Trujillo
 * 
 */
class CategoriesIpad extends CWidget {
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
	    $cat.='  <div style="background:#cecece; class="row-fluid">';
	    // $cat.='    <div class="row-fluid bigtitle">';
	    // $cat.='      <div class="span12"><center><h4>'.Yii::t('app','Categories').'</h4></center></div>';
	    // $cat.='    </div>';
	    $cat.='    <div class="row-fluid">';

 		foreach ($categories as $item) {
 			// $cat.='  <div class="span4">';
	        $cat.=CHtml::link('<img style="width:33.33%" src="'.$ruta.$item->image.'"/>', 
				array('category/index')
			);
	    	// $cat.="  </div>";
 		}
	    $cat.='    </div>';//row-fluid
	    $cat.="  </div>";
	    $cat.="</div>";
	    echo $cat;
 	}

 	
 	

}