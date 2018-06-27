<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'login',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20, 'readonly' => $model->isNewRecord ? false : true)))); ?>

    <?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>


    <?php echo $form->textFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>


    <?php echo $form->checkboxGroup($model, 'isAdmin', array('class' => 'span5')); ?>

    <?php echo $form->checkboxGroup($model, 'enabled', array('class' => 'span5')); ?>

    <?php
        echo $form->select2Group(
            $model,
            'webAccounts',
            array(
                'widgetOptions' =>  array(
                    'data'  =>  WebAccount::getAllWebAccounts(),
                    'htmlOptions'   =>  array('multiple'    =>  true),
                    'options'   =>  array(
                        'placeholder'   =>  'Please select WebAccounts'
                    )
                )
            )
        )
    ?>
    <?php
        echo $form->select2Group(
            $model,
            'proxies',
            array(
                'widgetOptions' =>  array(
                    'data'  =>  Proxy::getAllProxies(),
                    'htmlOptions'   =>  array('multiple'    =>  true),
                    'options'   =>  array(
                        'placeholder'   =>  'Please select Proxies'
                    )
                )
            )
        )
    ?>


<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
