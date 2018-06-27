<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldGroup($model,'id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>11)))); ?>

		<?php echo $form->textFieldGroup($model,'ip',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>300)))); ?>

		<?php echo $form->textFieldGroup($model,'port',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>11)))); ?>

		<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>110)))); ?>

			<?php echo $form->textFieldGroup($model,'enabled',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
