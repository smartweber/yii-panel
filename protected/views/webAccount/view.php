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

<h1>View WebAccount '<?php echo $model->title; ?>'</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		array(
            'name'  =>  'defaultProxyID',
            'label' =>  'Proxy',
            'value' =>  ($model->proxy)? ($model->proxy->ip.':'.$model->proxy->port) : ''
        ),
		array(
            'name'  =>  'scriptID',
            'label' =>  'Login script',
            'value' =>  isset($model->script) ? $model->script->title : ''
        ),
		'username',
		'password',
),
)); ?>
