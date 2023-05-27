<?php
/**
 * Description of Stores
 *muestra las ubicaciones de las tiendas manejadas por aplicacion
 * @author Ulises Trujillo
 * 
 */
class CStores extends CWidget {
 	public $total=3;
 	public $orientation='vertical';

 	public function init()
	{
	}

    public function run() {
 
        $this->show();
    }
	
    /**
	 * Renders stores from given number to show.
	 * @param int $count total stores to show
	 */
	public function show()
 	{
 		$stores=Store::model()->findAll(
 			array(
 				'condition'=>'active = 1',
 				'limit'=>$this->total,
			));

 		if(!$stores)
 		{
 			echo Yii::t('app','No stores to show');
 			return;
 		}
    	$ruta=Yii::app()->baseUrl."/images/store/";
	    $title='<div id="div-stores">';
	    $title.='<div class="row-fluid bigtitle">';
	    $title.='<div class="span12"><center><h4>'.Yii::t('app','Our stores').'</h4></center></div>';
	    $title.='</div>';

	    if($this->orientation == 'horizontal')
	    {
		    $store="";
	 		foreach ($stores as $item) {
				// $store.='<div class="row-fluid">';
				$store.='  <div class="span3" style="float:left;">';
				$store.='    <center>';
				$store.=    CHtml::link('<img border="0" width="100%" title="'.
				  $item->name.', '.$item->address.'" alt="-" src="'.$ruta.$item->image.'"/>', array('store/view', 'id'=>$item->id));
				$store.='    </center><p>'.$item->address.'</p>';
				$store.='  </div>';
				// $store.='</div>';
	 		}
			$store.='</div>';
			echo $store;
	    }
	    else
	    {
	    	echo $title;
	    	$store="";
	 		foreach ($stores as $item) {
				$store.='<div class="row-fluid">';
				$store.='<div class="span12 stores"><center>';
				$store.=CHtml::link('<img border="0" width="100%" title="'.$item->name.'" alt="-" src="'.$ruta.$item->image.'"/>', array('store/view', 'id'=>$item->id));
				$store.='</center><br/><p>'.$item->address.'</p>';
				$store.='</div></div>';

	 		}
			$store.='</div>';
			echo $store;
	    }
 	}

 	
 	

}