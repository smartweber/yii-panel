<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'blocked-url-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldGroup($model, 'title', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxLength'=>255)))); ?>

	<?php echo $form->textAreaGroup(
			$model,
			'value',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'htmlOptions' => array('rows' => 5),
				)
			)
		);
	?>

	<?php
		echo $form->select2Group(
			$model,
			'type',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'data'  =>  $model->typeTitles,
					'asDropDownList' => true,
				)
			)
		);
	?>
	<div id="divCategory"">
		<?php
			echo $form->select2Group(
				$model,
				'category',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					'widgetOptions' =>  array(
						'data'  =>  WebAccountCategory::getAllWebAccountCategories(),
						'asDropDownList' => true,
					)
				)
			);
		?>
	</div>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>


<script>
$(function () {
	$('#divCategory').css('display', 'none');
	var types = $("#BlockedUrl_type option:selected").text();

	if (types == "Copy to Clipboard") {
		$('#divCategory').css('display', 'block');
	} else {
		$('#divCategory').css('display', 'none');
	}
});

$("#BlockedUrl_type").change(function() {
	var type = $("#BlockedUrl_type option:selected").text();
	if (type == "Copy to Clipboard") {
		$('#divCategory').css('display', 'block');
	} else {
		$('#divCategory').css('display', 'none');
	}
});
</script>
