    <?php /** @var TbActiveForm $form */
    $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
    'id' => 'horizontalForm',
    'type' => 'horizontal',
    )); ?>    

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldGroup(
    $model,
    'title',
    array(
    'wrapperHtmlOptions' => array(
    'class' => 'col-sm-5',
    ),
    )); ?>
   

    <fieldset>     
    <legend>Monday Schedule</legend>
    <?php echo $form->switchGroup($model, 'monoption',
    array(
    'id' => 'monday',
    'widgetOptions' => array(    
    'events'=>array(    
    'switchChange'=>'js:function(event, state) {
    	
    	if (state == false) {    		
    		//jQuery("#yw2").val();
		    jQuery("#yw2").attr("disabled", "disabled"); 
    	} else {

		    //jQuery("#yw2").val();
		    jQuery("#yw2").removeAttr("disabled"); 		    
    	}
    }' )))); ?>
   

   	<?php echo $form->timePickerGroup(
		$model,
		'montime',
		array(
		'id' => 'mondaytime',
		'widgetOptions' => array(
		'htmlOptions' => array('disabled' => false),
		'wrapperHtmlOptions' => array(
		'class' => 'col-sm-3'
		),),)); ?>
    </fieldset>     

    <fieldset>     
    <legend>Tuesday Schedule</legend>
    <?php echo $form->switchGroup($model, 'tuesoption',
    array(
    'id' => 'tuesday',
    'widgetOptions' => array(
    'events'=>array(
    'switchChange'=>'js:function(event, state) {    	
    	if (state == false) {    		
    		jQuery("#yw4").val();
		    jQuery("#yw4").attr("disabled", "disabled"); 
    	} else {

		    jQuery("#yw4").val();
		    jQuery("#yw4").removeAttr("disabled"); 		    
    	}
    }' )))); ?>
   

   	<?php echo $form->timePickerGroup(
		$model,
		'tuestime',
		array(
		'widgetOptions' => array(
		'wrapperHtmlOptions' => array(
		'class' => 'col-sm-3'
		),),)); ?>
    </fieldset>

    <fieldset>     
    <legend>Wednesday Schedule</legend>
    <?php echo $form->switchGroup($model, 'wedoption',
    array(
    'id' => 'wednesday',
    'widgetOptions' => array(
    'events'=>array(
    'switchChange'=>'js:function(event, state) {
    	if (state == false) {    		
    		jQuery("#yw6").val();
		    jQuery("#yw6").attr("disabled", "disabled"); 
    	} else {

		    jQuery("#yw6").val();
		    jQuery("#yw6").removeAttr("disabled"); 		    
    	}
    }' )))); ?>
   

   	<?php echo $form->timePickerGroup(
		$model,
		'wedtime',
		array(
		'widgetOptions' => array(
		'wrapperHtmlOptions' => array(
		'class' => 'col-sm-3'
		),),)); ?>
    </fieldset>

    <fieldset>     
    <legend>Thursday Schedule</legend>
    <?php echo $form->switchGroup($model, 'thursoption',
    array(
    'id' => 'thursday',
    'widgetOptions' => array(
    'events'=>array(
    'switchChange'=>'js:function(event, state) {
    	if (state == false) {    		
    		jQuery("#yw8").val();
		    jQuery("#yw8").attr("disabled", "disabled"); 
    	} else {

		    jQuery("#yw8").val();
		    jQuery("#yw8").removeAttr("disabled"); 		    
    	}
    }' )))); ?>
   

   	<?php echo $form->timePickerGroup(
		$model,
		'thurstime',
		array(
		'widgetOptions' => array(
		'wrapperHtmlOptions' => array(
		'class' => 'col-sm-3'
		),),)); ?>
    </fieldset>

    <fieldset>     
    <legend>Friday Schedule</legend>
    <?php echo $form->switchGroup($model, 'frioption',
    array(
    'id' => 'friday',
    'widgetOptions' => array(
    'events'=>array(
    'switchChange'=>'js:function(event, state) {
    	if (state == false) {    		
    		jQuery("#yw10").val();
		    jQuery("#yw10").attr("disabled", "disabled"); 
    	} else {

		    jQuery("#yw10").val();
		    jQuery("#yw10").removeAttr("disabled"); 		    
    	}
    }' )))); ?>
   

   	<?php echo $form->timePickerGroup(
		$model,
		'fritime',
		array(
		'widgetOptions' => array(
		'wrapperHtmlOptions' => array(
		'class' => 'col-sm-3'
		),),)); ?>
    </fieldset>

    <fieldset>     
    <legend>Saturday Schedule</legend>
    <?php echo $form->switchGroup($model, 'satoption',
    array(
    'id' => 'saturday',
    'widgetOptions' => array(
    'events'=>array(
    'switchChange'=>'js:function(event, state) {
    	if (state == false) {    		
    		jQuery("#yw12").val();
		    jQuery("#yw12").attr("disabled", "disabled"); 
    	} else {

		    jQuery("#yw12").val();
		    jQuery("#yw12").removeAttr("disabled"); 		    
    	}
    }' )))); ?>
   

   	<?php echo $form->timePickerGroup(
		$model,
		'sattime',
		array(
		'widgetOptions' => array(
		'wrapperHtmlOptions' => array(
		'class' => 'col-sm-3'
		),),)); ?>
    </fieldset>

    <fieldset>     
    <legend>Sunday Schedule</legend>
    <?php echo $form->switchGroup($model, 'suoption',
    array(
    'id' => 'Sunday',
    'widgetOptions' => array(
    'events'=>array(
    'switchChange'=>'js:function(event, state) {
    	if (state == false) {    		
    		jQuery("#yw14").val();
		    jQuery("#yw14").attr("disabled", "disabled"); 
    	} else {

		    jQuery("#yw14").val();
		    jQuery("#yw14").removeAttr("disabled");
    	}
    }' )))); ?>
   

   	<?php echo $form->timePickerGroup(
		$model,
		'sutime',
		array(
		'widgetOptions' => array(
		'wrapperHtmlOptions' => array(
		'class' => 'col-sm-3'
		),),)); ?>
    </fieldset>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

    <?php
    $this->endWidget();
    unset($form);

 ?>
 <div style="padding-top:25px;"></div>
 <script>
$(function () {
	if ('<?php echo $model->monoption; ?>' == 0) {
		jQuery("#yw2").attr("disabled", "disabled"); 
	}

	if ('<?php echo $model->tuesoption; ?>' == 0) {
		jQuery("#yw4").attr("disabled", "disabled"); 
	}

	if ('<?php echo $model->wedoption; ?>' == 0) {
		jQuery("#yw6").attr("disabled", "disabled"); 
	}

	if ('<?php echo $model->thursoption; ?>' == 0) {
		jQuery("#yw8").attr("disabled", "disabled"); 
	}

	if ('<?php echo $model->frioption; ?>' == 0) {
		jQuery("#yw10").attr("disabled", "disabled"); 
	}

	if ('<?php echo $model->satoption; ?>' == 0) {
		jQuery("#yw12").attr("disabled", "disabled"); 
	}		

	if ('<?php echo $model->suoption; ?>' == 0) {
		jQuery("#yw14").attr("disabled", "disabled"); 
	}				

});

 </script>