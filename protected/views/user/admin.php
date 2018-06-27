<?php

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Create User','url'=>array('create')),
        )
    )
);
//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//$('.search-form').toggle();
//return false;
//});
//$('.search-form form').submit(function(){
//$.fn.yiiGridView.update('user-grid', {
//data: $(this).serialize()
//});
//return false;
//});
//");
?>
<h1>Manage Users</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'web-account-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'login',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
)); ?>
