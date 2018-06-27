<?php
$this->breadcrumbs = array(
    'Scripts' => array('index'),
    $model->title,
);

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type' => 'pills',
        'items' => array(
            array('label' => 'Manage Scripts', 'url' => array('index')),
            array('label' => 'Create Script', 'url' => array('create')),
            array('label' => 'Update Script', 'url' => array('update', 'id' => $model->id)),
            array('label' => 'Delete Script', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        )
    )
);

?>

<h1>View Script </h1>

<?php $this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'title',
        'url',
        'source',
    ),
)); ?>
