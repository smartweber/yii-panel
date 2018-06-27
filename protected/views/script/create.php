<?php

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Manage Scripts','url'=>array('admin'))
        ),
    )
);
?>

<h1>Create Script</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>