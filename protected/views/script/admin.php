<?php
$this->breadcrumbs=array(
	'Scripts'=>array('index'),
	'Manage',
);
$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Create Script','url'=>array('create')),
        )
    )
);


//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//$('.search-form').toggle();
//return false;
//});
//$('.search-form form').submit(function(){
//$.fn.yiiGridView.update('script-grid', {
//data: $(this).serialize()
//});
//return false;
//});
//");
//?>

<h1>Manage Scripts</h1>


<?php $this->widget('booster.widgets.TbGridView',array(
    'id'=>'script-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
		'title',
        array(
            'class'=>'booster.widgets.TbButtonColumn',
        ),
    ),
)); ?>
