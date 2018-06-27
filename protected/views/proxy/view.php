<?php

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Manage Proxies','url'=>array('index')),
            array('label'=>'Create Proxy','url'=>array('create')),
            array('label'=>'Update Proxy','url'=>array('update','id'=>$model->id)),
            array('label'=>'Delete Proxy','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        )
    )
);

?>

<h1>View Proxy #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
            'id',
            'ip',
            'port',
            'username',
            'password',
            array(
                'name'  =>  'enabled',
                'label' =>  'Enabled',
                'value' =>  $model->enabled ? 'Yes' : 'No'
            ),
    ),
)); ?>
