<?php
$this->breadcrumbs=array(
	'Scheduling'=>array('index'),
	'Create',
);

$this->widget('booster.widgets.TbMenu', array(
    'type'  =>  'pills',
    'items' =>  array(
        array('label'=>'Manage Scheduling','url'=>array('admin')),
    )
));
?>

<h1>Create Scheduling</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>