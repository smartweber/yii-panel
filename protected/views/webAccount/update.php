<?php
$this->breadcrumbs=array(
	'Web Accounts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->widget('booster.widgets.TbMenu', array(
    'type'  =>  'pills',
    'items' =>  array(
        array('label'=>'Manage Web Accounts','url'=>array('index')),
        array('label'=>'Create WebAccount','url'=>array('create')),
        array('label'=>'View WebAccount','url'=>array('view','id'=>$model->id)),
    )
));

?>

<h1>Update WebAccount </h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>