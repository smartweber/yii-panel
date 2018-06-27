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

	<h1>Update User </h1>

<?php
    if ($editable == 2) {
        echo $this->renderPartial('_form',array('model'=>$model));
    } else {
        echo "Sorry, you cannot update their account.";
    }
?>

