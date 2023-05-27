<?php

Yii::import('zii.widgets.CPortlet');

class PhraseDay extends CPortlet
{
	protected function renderContent()
	{
		$phrase='  <div class="row-fluid phraseday">';
	    $phrase.='    <div class="span12"><center><h4>'.Yii::t('app','Phrase of the day').'</h4></center></div>';
	    $phrase.='  </div>';
	    $phrase.='  Cuida el medio ambiente !';
	    $phrase.='  <br/>';
	    echo $phrase.='  <br/>';

		
	}
}