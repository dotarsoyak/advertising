<div class="fluid-row mainposts">
	<div class="span4">
		<div class="fluid-row image">
			<?php 
				$file = Yii::getPathOfAlias("webroot")."/images/post/";
				$ruta = Yii::app()->baseUrl."/images/post/";
				$image = $data->image;
				if(!file_exists($file.$data->image))
				{
					$image = "noimage.jpg";
				}
			?>
			<?php echo CHtml::link("<img alt='".$data->title."' border='0' src='".$ruta.$image."'/>", $data->url); ?>
		</div>
	</div>
	<div class="span8">
		<div class="fluid-row">
			<div class="title">
				<?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
			</div>
			<div class="author">
				posted by <?php echo $data->author->username . ' on ' . date('F j, Y',$data->create_time); ?>
			</div>
			<div class="content">
				<?php

					$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
					echo substr($data->content, 0, 120);
					$this->endWidget();
				?>
			</div>
			<div class="nav">
				<b>Tags:</b>
				<?php echo implode(', ', $data->tagLinks); ?>
				<br/>
				<?php echo CHtml::link('Permalink', $data->url); ?> |
				<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
				Last updated on <?php echo date('F j, Y',$data->update_time); ?>
			</div>
		</div>
	</div>
</div>

