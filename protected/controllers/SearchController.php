<?php

class SearchController extends Controller
{
	public $model;
	public $condition='';
	public $filter='';

		// Uncomment the following methods and override them if needed

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl',  // perform access control for CRUD operations
		);
	}

	// busqueda desde search box
	public function actionIndex($token)
	{
		$this->layout = "search";

		if(strlen(trim($token)) > 0 )
		{
			$keyword = $token;
		}

		$this->condition = "(name like '%".$keyword."%' OR description like '%";
		$this->condition .= $keyword."%' OR code like '%".$keyword."%' OR tags like '%";
		$this->condition .= $keyword."%')";

		$this->filter = "(name like '%".$keyword."%' OR description like '%";
		$this->filter .= $keyword."%' OR code like '%".$keyword."%' OR tags like '%";
		$this->filter .= $keyword."%')";

		if(isset($keyword) && strlen($keyword) > 0)
		{
			// $this->condition .= $keyword."%') and active = 1";

			if(strlen(strpos(strtolower(Yii::app()->request->queryString),  "new")) != 0)
    	{
    		$this->condition .= " AND new = 1";
    	}

			if(strlen(strpos(strtolower(Yii::app()->request->queryString),  "color")) != 0)
    	{
    		$this->condition .= " AND color='".Yii::app()->request->getParam("color")."'";
    	}

    	if(strlen(strpos(strtolower(Yii::app()->request->queryString),  "brand")) != 0)
    	{
    		$this->condition .= " AND brand_id='".Yii::app()->request->getParam("brand")."'";
    	}

    	if(strlen(strpos(strtolower(Yii::app()->request->queryString),  "type")) != 0)
    	{
    		$this->condition .= " AND type='".Yii::app()->request->getParam("type")."'";
    	}

			$this->condition .= " AND active = 1";

			$count = Product::model()->count(
				array(
					'condition'=>$this->condition, 
					// 'limit'=>$this->total
				)
			);

			$criteria = new CDbCriteria();
			$criteria->condition = $this->condition;

			$pages=new CPagination($count);
	    $pages->pageSize=Yii::app()->params["pageSize"];
	    $pages->itemCount=$count;
	    $pages->applyLimit($criteria);

	    $products=Product::model()->findAll(
				array(
					'condition'=>$this->condition, 
					// 'limit'=>$this->total
				)
			);

			$products=Product::model()->findAll($criteria);

			$this->render('index', array(
					'products'=>$products, 
					'model'=>$this->model, 
					'count'=>$count, 
					'pages' => $pages, 
					'token' => $keyword, 
					'fiter' => $this->filter
				));
		}
		else
		{
			$this->render('index', array(
					'products'=>null, 
					'model'=>null, 
					'count'=>0, 
					'pages' => null, 
					'token' => null, 
					'fiter' => $this->filter
				));
		}
	}

}