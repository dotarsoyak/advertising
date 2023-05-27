<?php

Yii::import('zii.widgets.CPortlet');

class TagCloud extends CPortlet
{
	//public $title='Tags';
	public $maxTags=20;

	protected function renderContent()
	{
		$title='  <div class="row-fluid bigtitle">';
	    $title.='    <div class="span12"><center><h4>'.Yii::t('app','Tags').'</h4></center></div>';
	    $title.='  </div>';

		echo $title;
		$tags=TagBlog::model()->findTagWeights($this->maxTags);

		foreach($tags as $tag=>$weight)
		{
			$link=CHtml::link(CHtml::encode($tag), array('post/index','tag'=>$tag));
			echo CHtml::tag('span', array(
				'class'=>'tag',
				'style'=>"font-size:{$weight}pt",
			), $link)."\n";
		}
	}
}