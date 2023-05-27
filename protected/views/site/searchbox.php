<?php
/* @var $this SiteController */

?>
	<div class="fluid-row searchbox" >
		<div class="span6">
				<form name="form-search" onsubmit="return send();" method="post">
					<div>
						<span id="search-span"> 
							<?php //echo Yii::t('app','Search'); ?>
						</span>
						<input onkeyup="ValidaEnvio();" 
						style="width:185px; margin-bottom: 0 !important;" type="text" name="search-box"  id="search-box" />
						<input disabled="disabled" id="btnSend" type="submit" value="<?php echo Yii::t('app','Find'); ?>" 
						class="btn btn-primary" />
					</div>
				</form>
		</div>
	</div>

	<script type="text/javascript">
		function ValidaEnvio()
		{
			if($.trim($('#search-box').val()).length==0)
			{
				$('#btnSend').attr("disabled","disabled");
			}else
			{
				$('#btnSend').attr("disabled",null);
			}
		}
		function send()
		{
			window.location = '<?php echo Yii::app()->createUrl("/search"); ?>/'+$('#search-box').val();
			return false;
		}
	</script>




	