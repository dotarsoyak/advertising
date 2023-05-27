<?php 
class CFiltro extends CApplicationComponent{

  public function init(){
  // init es llamado por Yii, debido a que es un componente.
  }

  //se van a seleccionar de un listado, los productos a mostrar aqui.
  public function renderProducts($products)
  {
    if(!$products)
    {
      echo Yii::t('app','No products to show');
      return;
    }

    $img=Yii::app()->baseUrl."/images/product/";
    $prods=' <div class="row-fluid">';
    $prods.='   <div class="span12">';
    $cont=0;

    foreach ($products as $item) {
      $cont++;
      $disponible=$item->in_stock;

      if($disponible==1)
        $disponible=Yii::t('app','In stock');
      else
        $disponible=Yii::t('app','Not In stock');

      if($cont % 4 == 0)
        $prods.='<div class="item-category" >';
      else
        $prods.='<div class="item-category" style="margin-right:10px;">';
      $prods.='  <div id="img-wrapper">';
      $prods.=CHtml::link('<img border="0" width="146px" title="'.$item->name.'" alt="-" src="'.$img.$item->image.'"/>', array('product/'.$item->code, ));
      $prods.='  </div>';
      $prods.='  <span id="name">';
      $prods.=     CHtml::link($item->name, array('product/'.$item->code,));
      $prods.='  </span>';
      // $prods.='  <br/>';
      // $prods.='  <span id="price">'.Yii::t('app','Our price').'  '.$item->price;
      // $prods.='  </span>';
      $prods.='  <br/>';
      $prods.='  <span id="instock">'.$disponible;
      $prods.='  </span>';
      if($item->new==1)
      {
        $prods.='  <br/>';
        $prods.='  <span id="new">'.Yii::t('app','New');
        $prods.='  </span>';
      }
      $prods.='</div>';
    }

    $prods.='  </div>';
    $prods.='</div>';
    
    echo $prods;

  }

  public function renderBrandFilter($param_name, $param_value, $rawUrl, $condition)
  {
    $params = null;
    if($condition == null)
    {
      $condition = $param_name.'='.$param_value;
    }

    $products=Product::model()->findAll(
      array(
        'select'=>'distinct brand_id',
        'condition'=>$condition,
        'order'=>'brand_id',
    ));

    if($products)
    {
      $prm_brand=Yii::app()->request->getParam('brand');
      $rawUrl = str_replace("&brand=".Yii::app()->request->getParam("brand"), "", $rawUrl);
      $brands='<div class="">';
      $brands.='   <span id="title">'.Yii::t('app','Brands').'</span>&nbsp;&nbsp;&nbsp;'; 
      $brands.='   <a href="'.$rawUrl.'">'.Yii::t('app','Reset').'</a>';
      $brands.='   <br/>';
      $brands.='</div>';
      $brands.="<div class='fluid-row filter-element'>";

      foreach ($products as $item) {
        if($item->brand!=null){
          $class='';
          $brands.='<br/>';
          $brands.='<div class="span11" id="filter-item">';
          $brands.='   <span>';
          if(strlen($prm_brand) > 0 and $prm_brand == $item->brand->id)
            $class='link-pressed';
          
          $brands.='    <a class="'.$class.'" href="'.$rawUrl.'&brand='.$item->brand->id.'">'.$item->brand->name.'</a>';
          $brands.='  </span>';
          $brands.='</div>';//filter-item
        }
      }
      $brands.='</div>';//filter-element

      echo $brands;
    }
  }

  public function renderNewFilter($param_name, $param_value, $rawUrl, $condition)
  {
    $params = null;
    if($condition == null)
    {
      $condition = $param_name.'='.$param_value.' and new=1';
    }

    //filter to new product
    $products=Product::model()->findAll(
      array(
        'condition'=>$condition,
    ));

    if($products)
    {
      $rawUrl = str_replace("&new=1", "", $rawUrl);

      $newProd=" <div class=''>";
      $newProd.='  <span id="title">'.Yii::t('app','Filter New').'</span>&nbsp;&nbsp;&nbsp;';
      $newProd.='  <a href="'.$rawUrl.'">'.Yii::t('app','Reset').'</a>';
      $newProd.='  <br/>';
      $newProd.='</div>';//div span11
      $newProd.="<div class='fluid-row filter-element'>";

      $prm_new=Yii::app()->request->getParam('new');
      $class='';
      $newProd.='  <br/>';
      $newProd.='  <div class="span11" id="filter-item">';
      $newProd.='     <span>';
      if(strlen($prm_new) > 0 and $prm_new == 1)
        $class='link-pressed';
      
      $newProd.='       <a class="'.$class.'" href="'.$rawUrl.'&new=1">'.Yii::t('app','New').'</a>';
      $newProd.='     </span>';
      $newProd.='  </div>';
      $newProd.='</div>';//filter-element

      echo $newProd;
    }
  }

  public function renderColorFilter($param_name, $param_value, $rawUrl, $condition)
  {
    //filter by color
    $params = null;
    if($condition == null)
    {
      $condition = $param_name.'='.$param_value;
    }

    $products=Product::model()->findAll(
      array(
        'select'=>'distinct color',
        'condition'=>$condition,
        'order'=>'color',
    ));

    if($products)
    {
      $rawUrl = str_replace("&color=".Yii::app()->request->getParam("color"), "", $rawUrl);
      
      $color=" <div class=''>";
      $color.='  <span id="title">'.Yii::t('app','Color').'</span>&nbsp;&nbsp;&nbsp;';
      $color.='  <a href="'.$rawUrl.'">'.Yii::t('app','Reset').'</a>';
      $color.='  <br/>';
      $color.='</div>';//div span11
      $color.="<div class='fluid-row filter-element'>";

      $prm_color=Yii::app()->request->getParam('color');
      $class='';
      foreach ($products as $item) {
        $class='';
        $color.='<br/>';
        $color.='<div class="span11" id="filter-item">';
        $color.='   <span>';
        if(strlen($prm_color) > 0 and $prm_color == $item->color)
          $class='link-color-pressed';
        
        $color.='    <a style="background-color:'.$item->color.'" class="'.$class.'" href="'.$rawUrl.
        '&color='.$item->color.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
        $color.='  </span>';
        $color.='</div>';//filter-item
      }
      
      $color.='</div>';//filter-element
      echo $color;
    }
  }

  public function renderTypeFilter($param_name, $param_value, $rawUrl, $condition)
  {
    //filter by color
    $params = null;
    if($condition == null)
    {
      $condition = $param_name.'='.$param_value." and type!=''";
    }

    $products=Product::model()->findAll(
      array(
        "select"=>"distinct type",
        "condition"=>$condition,
        "order"=>"type",
    ));

    if($products)
    {
      $rawUrl = str_replace("&type=".Yii::app()->request->getParam("type"), "", $rawUrl);
      $type=" <div class=''>";
      $type.='  <span id="title">'.Yii::t('app','Type').'</span>&nbsp;&nbsp;&nbsp;';
      $type.='  <a href="'.$rawUrl.'">'.Yii::t('app','Reset').'</a>';
      $type.='  <br/>';
      $type.='</div>';//div span11
      $type.="<div class='fluid-row filter-element'>";

      $prm_type=Yii::app()->request->getParam('type');
      $class='';
      foreach ($products as $item) {
        $class='';
        $type.='<div class="span11" id="filter-item">';
        $type.='   <span>';
        if(strlen($prm_type) > 0 and $prm_type == $item->type)
          $class='link-pressed';
        
        $type.='    <a class="'.$class.'" href="'.$rawUrl.'&type='.$item->type.'">'.$item->type.'</a>';
        $type.='  </span>';
        $type.='</div>';//filter-item
      }
      
      $type.='</div>';//filter-element

      echo $type;
    }
  }

  /**
  *@param $model: es el modelo puede ser producto o category
  *@param $id: es el id del model a buscar
  *@param $param_name: nombre del parametro
  *ejemplo: index.php?r=category/view&id=1
  *renderFilter('category', 1);
  */
  public function renderFilter($view, $action, $param_name, $param_value, $condition)
  {
    // se invoca desde el layout
    $url_param = $param_name;
    if($condition == null)
    {
      $url_param = 'id';
    }
    $rawUrl = Yii::app()->baseUrl;
    // $rawUrl.= "/index.php/".$view."/".$action."/".$url_param."/".$param_value;
    // $rawUrl.= "/index.php?r=".$view."/".$action."&".$url_param."=".$param_value;
    $rawUrl.= "/index.php/".$view."/".$action."/".$url_param."/".$param_value."?1";

    if(strlen(strpos(strtolower(Yii::app()->request->queryString), "sort=price")) != 0)
    {
      $rawUrl.="&sort=price";
    }

    if(strlen(strpos(strtolower(Yii::app()->request->queryString), "sort=name")) != 0)
    {
      $rawUrl.="&sort=name";
    }

    if(strlen(strpos(strtolower(Yii::app()->request->queryString), "new")) != 0)
    {
      $rawUrl.="&new=1";
    }

    if(strlen(strpos(strtolower(Yii::app()->request->queryString), "color")) != 0)
    {
      $rawUrl.="&color=".Yii::app()->request->getParam("color");
    }

    if(strlen(strpos(strtolower(Yii::app()->request->queryString), "brand")) != 0)
    {
      $rawUrl.="&brand=".Yii::app()->request->getParam("brand");
    }

    if(strlen(strpos(strtolower(Yii::app()->request->queryString), "type")) != 0)
    {
      $rawUrl.="&type=".Yii::app()->request->getParam("type");
    }
    
    echo "<div class='fluid-row filter-bar'>";

    // $this->renderBrandFilter($param_name, $param_value, $rawUrl, $condition);
    // $this->renderNewFilter($param_name, $param_value, $rawUrl, $condition);
    // $this->renderColorFilter($param_name, $param_value, $rawUrl, $condition);
    // $this->renderTypeFilter($param_name, $param_value, $rawUrl, $condition);

    echo "</div>"; // fin de filter-bar

  }

}