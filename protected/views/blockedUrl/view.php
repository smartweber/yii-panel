<?php
$this->breadcrumbs = array(
    'Blocked Urls' => array('index'),
    $model->id,
);

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label' => 'Manage Blocked Urls', 'url' => array('admin')),

            array('label' => 'Create Blocked Url', 'url' => array('create')),
            array('label' => 'Update Blocked Url', 'url' => array('update', 'id' => $model->id)),
            array('label' => 'Delete Blocked Url', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        )
    )
);
?>

<h1>View Blocked Url <?php $model->title ?></h1>

<?php $this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'value',
        'title',
        array(
            'name'  =>  'type',
            'label' =>  'Type',
            'value' =>  $model->typeTitles[$model->type]
        )
    ),
)); ?>
