<?php

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Manage Proxies','url'=>array('index')),
            array('label'=>'Create Proxy','url'=>array('create')),
            array('label'=>'View Proxy','url'=>array('view','id'=>$model->id)),
        )
    )
);

?>

<h1>Update Proxy </h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>