<?php
$this->breadcrumbs=array(
	'Web Account Categories'=>array('index'),
	'Create',
);

$this->widget('booster.widgets.TbMenu', array(
    'type'  =>  'pills',
    'items' =>  array(
        array('label'=>'Manage Web Account Categories','url'=>array('admin')),
    )
));
?>

<h1>Create WebAccountCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>