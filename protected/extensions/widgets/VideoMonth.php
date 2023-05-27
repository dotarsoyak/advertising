<?php

Yii::import('zii.widgets.CPortlet');

class VideoMonth extends CPortlet
{
	protected function renderContent()
	{
		$phrase='  <div class="row-fluid bigtitle">';
	    $phrase.='    <div class="span12"><center><h4>'.Yii::t('app','Video of the month').'</h4></center></div>';
	    $phrase.='  </div>';
	    $phrase.='  <iframe width="100%" height="150" src="//www.youtube.com/embed/WNvwLvl8VOA" frameborder="0" allowfullscreen></iframe>';
	    $phrase.='  <br/>';
	    echo $phrase.='  <br/>';

		
	}
}