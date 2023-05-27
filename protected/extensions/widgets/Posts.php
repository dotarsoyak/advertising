<?php
/**
 * show recents posts
 * @author Ulises Trujillo
 * 
 */
class Posts extends CWidget {
 	public $total=3;

 	public function init()
	{
	}

    public function run() {
 
        $this->renderContent();
    }
	
    /**
	 * Renders posts
	 * @param int $count total posts to render
	 */
	public function renderContent()
 	{
 		$criteria=new CDbCriteria(array(
			'condition'=>'status='.Post::STATUS_PUBLISHED,
			'order'=>'update_time DESC',
			'limit'=>Yii::app()->params['postsPerPage'],
		));

		$posts=Post::model()->findAll($criteria);

 		if(!$posts)
 		{
 			echo Yii::t('app','No posts to show');
 			return;
 		}

    	$ruta=Yii::app()->baseUrl."/images/post/";

	    $content='';

		$path = Yii::getPathOfAlias('webroot')."/images/post/";

 		foreach ($posts as $item) {
			$content.='<div class="fluid-row mainposts">';
			$content.='  <div class="span4">';
			$content.='    <div class="fluid-row image">';

			if(!file_exists($path.$item->image))
			{
				$item->image = "noimage.jpg";
			}

			$content.= CHtml::link("<img alt='".$item->title."' border='0' src='".$ruta.$item->image."'/>", $item->url);
			$content.='    </div>';
			$content.='  </div>';

			$content.='  <div class="span8">';
			$content.='    <div class="fluid-row">';
			$content.='      <div class="title">';
			$content.=         CHtml::link(CHtml::encode($item->title), $item->url);
			$content.='      </div>';
			$content.='      <div class="author"> posted by ';
			$content.=         $item->author->username . ' on ' . date('F j, Y',$item->create_time);
			$content.='      </div>';
			$content.='      <div class="content">';

					$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			$content.= substr($item->content, 0, 120);
					$this->endWidget();

			$content.='      </div>';
			$content.='      <div class="nav">';
			$content.='  <b>Tags:</b>';
			$content.= implode(', ', $item->tagLinks);
			$content.='	 <br/> ';
			$content.=  CHtml::link("Permalink", $item->url)."|";
			$content.=  CHtml::link("Comments ({$item->commentCount})",$item->url.'#comments')."|";
			$content.=' Last updated on '.date('F j, Y',$item->update_time);
			$content.='      </div>';
			$content.='    </div>';
			$content.='  </div>';
			$content.='</div>';

 		}

		echo $content;
 	}

 	
 	

}