<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'proxy-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'ip',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>300)))); ?>

	<?php echo $form->textFieldGroup($model,'port',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>11)))); ?>

	<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>110)))); ?>

	<?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>110)))); ?>

    <?php echo $form->checkboxGroup($model, 'enabled', array('class' => 'span5')) ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
