<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  => 'pills',
        'items' =>  array(
            array('label'=>'Manage Users','url'=>array('index')),
        )
    )
);

?>

<h1>Create User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>