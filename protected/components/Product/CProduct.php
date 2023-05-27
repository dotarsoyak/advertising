

<?php 
class CProduct extends CApplicationComponent{
  public $total=3;
  public function init(){
  // init es llamado por Yii, debido a que es un componente.
  }

  //se van a seleccionar de un listado, los productos a mostrar aqui.
  public function ShowMainProducts()
  {
    $products = Product::model()->findAll(
        array(
          'condition'=>'active = 1',
          'limit'=>$this->total,
        )
    );

    $ruta=Yii::app()->baseUrl."/images/product/";
    $path = Yii::getPathOfAlias('webroot')."/images/product/";

    $lista='<div class="fluid-row" id="div-destacados" style="float:left;">';
    $lista.='  <div class="row-fluid bigtitle">';
    $lista.='    <div class="span6"><center><h4>'.Yii::t('app','Main products').'</h4></center></div>';
    $lista.='  </div>';

    foreach ($products as $item) {
      if(!file_exists($path.$item->image))
      {
        $item->image = "noimage.jpg";
      }
      
      $lista.='<div class="row-fluid main-products">';
      $lista.='  <div class="span6">';
      $lista.=CHtml::link('<img border="0" width="80%" title="'.$item->name.'" alt="-" src="'.$ruta.$item->image.'"/>', array('product/detail', 'id'=>$item->id));
      $lista.='  </div>';
      $lista.='  <div class="col-md-5"><p>'.$item->description.'</p></div>';
      $lista.='</div>';
    }
    $lista.='</div>';

    return $lista;
  }
  
} 