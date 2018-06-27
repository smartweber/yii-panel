<?php
$this->breadcrumbs = array(
    'Web Accounts' => array('index'),
    'Manage',
);

$this->widget('booster.widgets.TbMenu', array(
   'type'   =>  'pills',
    'items' =>  array(
        array('label' => 'Create WebAccount', 'url' => array('create')),
    )
));
?>

<h1>Manage Web Accounts</h1>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'web-account-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'title',
        /*
        'url',
        'password',
        'value1',
        'value2',
        */
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
)); ?>
