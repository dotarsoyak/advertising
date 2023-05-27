<?php
/**
 * Description of products
 *muestra las ubicaciones de las tiendas manejadas por aplicacion
 * @author Ulises Trujillo
 * 
 */
class YiiNewsletter extends CWidget {
 	public function init()
	{
	}

  public function run() {
      $this->show();
  }
	
  /**
	 * Renders newsletter form
 	*/
	public function show()
 	{
 		$newsletter = new Newsletter();

		$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'newsletter-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'well'),
			'type'=>'vertical', //horizontal
			// 'action'=>Yii::app()->createUrl('Site/Suscribe'),
		));

		echo CHtml::errorSummary($newsletter);
		echo $form->textFieldRow($newsletter,'name',array('size'=>10,'maxlength'=>58));
		echo $form->textFieldRow($newsletter,'email',array('size'=>10,'maxlength'=>58));

		echo "<br/><br/>";
		$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit', 
			'label'=>Yii::t('app', 'Suscribe me'),
		    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'normal', // null, 'large', 'small' or 'mini'
		  'htmlOptions'=>array('name'=>'btnSend',
				 'id'=>'btnSend', 'onclick'=>'return SaveSuscription();',
			),  
		));

		$this->endWidget();
 	}

}
?>

<script type="text/javascript">
    /*<![CDATA[*/
    function SaveSuscription()
    {
      var name = $('#Newsletter_name').val();
      var email = $('#Newsletter_email').val();
      var dateObject = new Date();
      var nocache = dateObject.getTime();
      var objeto = {
					name: name,
					email: email
				};

      $.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: "index.php?r=newsletter/suscribe",
        dataType: "json",
        data: objeto,
        async: true,
        success: function (email) {
          console.log('echole');
        },
        error: function (response) {
          // console.log(response.responseText);
          return false;
        },
      });

      return false;
    }
    /*]]>*/
</script>
