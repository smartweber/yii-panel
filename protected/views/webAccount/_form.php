<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'web-account-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'title',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

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
                    'options'   => array(
                        'placeholder'   =>  'Please select category'
                    )
                )
            )
        );
    ?>

    <?php
        echo $form->select2Group(
            $model,
            'schedule',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'widgetOptions' =>  array(
                    'data'  =>  Schedule::getAllSchedules(),
                    'options'   => array(
                        'placeholder'   =>  'Please select schedule'
                    )
                )
            )
        );
    ?>

	<?php
        echo $form->select2Group(
            $model,
            'scriptID',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'widgetOptions' =>  array(
                    'data'  =>  Script::getAllScripts(),
                    'options'   => array(
                        'placeholder'   =>  'Please select Script'
                    )
                )
            )
        );
    ?>

    <?php
        
        if (isset($model->id)) {
            $data = Proxy::getNonScriptProxies($model->scriptID);
            $data[$model->defaultProxyID] = Proxy::getProxyByID($model->defaultProxyID);
            echo $form->select2Group(
                $model,
                'defaultProxyID',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                    'widgetOptions' =>  array(
                        'data'  =>  $data,
                    )
                )
            );
        } else {
            echo $form->select2Group(
                $model,
                'defaultProxyID',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                    'widgetOptions' =>  array(
                        'data'  =>  Proxy::getAllProxies(),
                        'options'   =>  array(
                            'placeholder'   => 'Please select Proxy'
                        )
                    )
                )
            );
        }
    ?>
	
	<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>110)))); ?>

	<?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>110)))); ?>
    <?php
		
		$accountID = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;
		$sql = "SELECT * FROM blocked_urls WHERE type='0' AND account = '$accountID'";

        echo $form->select2Group(
            $model,
            'blocked',
            array(
                'widgetOptions' =>  array(
                    'data'  =>  CHtml::listData(BlockedUrl::model()->blocked()->findAllBySql($sql), 'id','title'),
                    //'data'  => BlockedUrl::getBlocked(),
                    'htmlOptions'   =>  array('multiple'    =>  true),
                    'options'   => array(
                        'placeholder'   => 'Please select Blocked and Shortcuts'
                    )
                )
            )
        );

		$sql = "SELECT * FROM blocked_urls WHERE type='1' AND account = '$accountID'";
        echo $form->select2Group(
            $model,
            'favourites',
            array(
                'widgetOptions' =>  array(
                    'data'  =>  CHtml::listData(BlockedUrl::model()->favourites()->findAllBySql($sql), 'id','title'),
                    'htmlOptions'   =>  array('multiple'    =>  true),
                    'options'   => array(
                        'placeholder'   => 'Please select Blocked and Shortcuts'
                    )
                )
            )
        );
		$sql = "SELECT * FROM blocked_urls WHERE type='2' AND account = '$accountID'";
        echo $form->select2Group(
            $model,
            'clipboard',
            array(
                'widgetOptions' =>  array(
                    'data'  =>  CHtml::listData(BlockedUrl::model()->clipboard()->findAllBySql($sql), 'id','title'),
                    'htmlOptions'   =>  array('multiple'    =>  true),
                    'options'   => array(
                        'placeholder'   => 'Please select Blocked and Shortcuts'
                    )
                )
            )
        );


    ?>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>


