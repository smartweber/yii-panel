<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/** @var TbActiveForm $form */
$this->pageTitle=Yii::app()->name . ' - Login';

?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<?php

    $form = $this->beginWidget(
        'booster.widgets.TbActiveForm',
        array(
            'id' => 'verticalForm',
            'htmlOptions' => array('class' => 'well'), // for inset effect
        )
    );

    echo $form->textFieldGroup($model, 'username');
    echo $form->passwordFieldGroup($model, 'password');
    echo $form->checkboxGroup($model, 'rememberMe');
    $this->widget(
        'booster.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => 'Login')
    );

    $this->endWidget();
    unset($form);

?>