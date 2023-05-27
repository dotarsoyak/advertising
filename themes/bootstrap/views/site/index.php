<meta name="robots" content="index, follow" />
<meta content='1 week' name='revisit-after' />
<meta content='global' name='distribution' />
<meta content='es' name='language' />
<meta content='General' name='rating' />
<meta content='follow, all' name='robots' />
<meta name="Pagetopic" content="Branding" />
<meta name="Pagetype" content="Images, Text" />
<meta name="Audience" content=" All" />
<meta http-equiv="Expires" content="none" />

<style type="text/css">
	#principal{width: 24%;float: left;margin-right: 5px;}
	a.detail{text-decoration: none;}
	a.web{text-decoration: none;}
</style>

<div style="float:left">
<div id="containerbox" style="height:100%;width:20%;float:left;">
<?php

	$sql = "SELECT *
					FROM ".Yii::app()->db->tablePrefix."product
					WHERE active = 1 ORDER BY id desc";

	$rows = Yii::app()->db->createCommand($sql)->queryAll();

?>
	
<?php
  $i=0;$residuo=sizeof($rows) % 5;
  $items=array();
  foreach ($rows as $row) {
  	array_push($items, $row);
  }

	for($k=0;$k<sizeof($items)-$residuo;$k++){
    $i++;
    if(!file_exists(Yii::getPathOfAlias('webroot').'/images/product/'.$items[$k]["image"]))
    	$items[$k]["image"]='noimage.jpg';
		?>
			<div class="itembox"><a href="<?php echo Yii::app()->createUrl("product")."/".$items[$k]['code']; ?>">
			<img alt="<?php echo $items[$k]['description'].' '.$items[$k]['tags']; ?>" class="itemproduct" 
			style="width:100%;vertical-align:top;cursor:pointer;" 
			value="<?php echo $items[$k]['code']; ?>" src="<?php echo Yii::app()->baseUrl."/images/product/".$items[$k]["image"]; ?>" 
			title="<?php echo $items[$k]['name']; ?>" alt="<?php echo $items[$k]['name'] ?>"/></a>
			Nombre: <?php echo $items[$k]['name']; ?><br/>
			<?php echo $items[$k]['description']; ?><br/><?php if(strlen($items[$k]['phone'])>0) echo 'Tel: '.$items[$k]['phone']; ?>
			</div>
	  <?php
		if($i%floor(sizeof($rows) / 5)==0)
		{
			$i=0;
		?>
		  </div><div id="containerbox" style="height:100%;width:20%;float:left;">
    <?php
	  }
  }
?>
</div><!-- fluid row -->
</div>

<script type="text/javascript">
	$('document').ready(function(){
		function RealocateAds()
		{
	    var anuncios='';
			<?php 
				if($residuo > 0){
					$ads=Array();
					foreach ($items as $item) {
				    if(!file_exists(Yii::getPathOfAlias('webroot').'/images/product/'.$item["image"])){
				    	$item["image"]='noimage.jpg';
				    }
			    	array_push($ads, $item);
					}
			  	?>
			  	  var residuo=<?php echo $residuo; ?>;
			  	  var totalItems=<?php echo sizeof($ads); ?>;
			      var inicio=totalItems-residuo;
						var datos;
						var minHeight;
						var phone='';
						anuncios=JSON.parse(JSON.stringify(<?php echo json_encode($ads); ?>));

						for (var k = inicio; k < anuncios.length; k++) {
							datos=$('div[id^=containerbox]').map(function(e){return $(this).height()});				
							minHeight=datos.sort()[0];
							if(minHeight==0){minHeight=datos.sort()[1];}
							$('div[id^=containerbox]').each(function(){if($(this).height()==minHeight){
								phone='';
								if(anuncios[k].phone!==null)phone='Tel: '+anuncios[k].phone;
								$(this).append(
				"<div class='itembox'><a href='<?php echo Yii::app()->createUrl('product'); ?>/"+anuncios[k].code+
				"'><img alt='"+anuncios[k].description + " " + anuncios[k].tags+ "' class='itemproduct' " +
				"style='width:100%;vertical-align:top;cursor:pointer;' " +
				"value='"+anuncios[k].code+"' src=\'<?php echo Yii::app()->baseUrl.'/images/product/'; ?>" + anuncios[k].image +
				"' title='"+anuncios[k].name+"' alt='"+anuncios[k].name +"' /></a>" +
				" Nombre: "+anuncios[k].name+"<br/>"+anuncios[k].description + 
				"<br/>"+phone +" </div>"
								); 
							}})  	
						};
			  	<?php
			  }
			?>
		  
		}

		setTimeout(RealocateAds, 2000);
	});
</script>


