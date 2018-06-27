<?php
$this->breadcrumbs = array(
    'Blocked Urls' => array('index'),
    'Manage',
);

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label' => 'Create Blocked Url', 'url' => array('create')),
        )
    )
);
?>

<h1>Manage Blocked Urls</h1>
<?php

?>
<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'blocked-url-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        // 'formattedTitle',
        array(
            'name'  => 'type',
            'header'    =>  'Type',
            'value' => '$data->formattedType()',
            'filter'=> CHtml::listData(BlockedUrl::typeTitles(), 'type', 'title')
        ),
        array(
            'name'  => 'title',
            'header' => 'Blocked or Shortcut',
            'value' =>  '$data->formattedTitle()'
        ),
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
)); ?>
