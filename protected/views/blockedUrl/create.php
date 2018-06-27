<?php
$this->breadcrumbs = array(
    'Blocked Urls' => array('index'),
    'Create',
);

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label' => 'Manage Blocked Urls', 'url' => array('admin')),
        )
    )
);

?>

    <h1>Create BlockedUrl</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>