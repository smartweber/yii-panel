<?php

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Create Proxy','url'=>array('create')),
        )
    )
);

$this->menu=array(
);

//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//$('.search-form').toggle();
//return false;
//});
//$('.search-form form').submit(function(){
//$.fn.yiiGridView.update('proxy-grid', {
//data: $(this).serialize()
//});
//return false;
//});
//");
//?>

<h1>Manage Proxies</h1>

<!--<p>-->
<!--	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>-->
<!--		&lt;&gt;</b>-->
<!--	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.-->
<!--</p>-->

<?php $this->widget('booster.widgets.TbGridView',array(
    'id'=>'proxy-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'ip',
        'port',
        'enabled',
        array(
        'class'=>'booster.widgets.TbButtonColumn',
        ),
    ),
)); ?>
