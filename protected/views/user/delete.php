<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Manage Users','url'=>array('index')),
            array('label'=>'Create User','url'=>array('create')),
            array('label'=>'View User','url'=>array('view','id'=>$model->id)),
        )
    )
)
?>

	<h1>Delete User </h1>

<?php
    if ($editable == 1) {
        echo "Sorry, you cannot remove their account.";
    }
?>

