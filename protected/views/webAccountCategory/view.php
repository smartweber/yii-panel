<?php

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Manage WebAccounts','url'=>array('index')),
            array('label'=>'Create WebAccount','url'=>array('create')),
            array('label'=>'Update WebAccount','url'=>array('update','id'=>$model->id)),
            array('label'=>'Delete WebAccount','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        )
    )
);
?>

<h1>View WebAccount Category '<?php echo $model->title; ?>'</h1>


