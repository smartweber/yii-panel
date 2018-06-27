<?php

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Manage Proxies','url'=>array('index')),
        )
    )
);
?>

<h1>Create Proxy</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>