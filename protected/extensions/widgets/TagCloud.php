<?php

class TagCloud extends CWidget
{
	public $title='tags';
	public $maxTags=20;
	public $withTitle=true;

	public function init()
	{

	}

  public function run() {

      $this->show();
  }

	protected function show()
	{
		$tags=Tag::model()->findTagWeights($this->maxTags);
		
		$head='<div id="div-tags">';
		$head.=' <div class="row-fluid bigtitle">';
	    $head.='   <div class="span12"><center><h4>'.$this->title.'</h4></center></div>';
	    $head.=' </div>';

	    if($this->withTitle==true)
	    {
		    echo $head;
	    }


		foreach($tags as $tag=>$weight)
		{
			$link=CHtml::link(CHtml::encode($tag), array('product/index','tag'=>$tag));
			echo CHtml::tag('span', array(
				'class'=>'tag',
				'style'=>"font-size:{$weight}pt",
			), $link)."\n";
		}
		$head='</div>';
	}
}