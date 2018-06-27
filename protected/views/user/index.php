<?php
$this->breadcrumbs=array(
	'Users',
);

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type' => 'pills',
        'items' => array(
            array('label'=>'Create User','url'=>array('create')),
            array('label'=>'Manage Users','url'=>array('admin')),
        )
    )
);
?>

<h1>Users</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
