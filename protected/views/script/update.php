<?php
$this->breadcrumbs=array(
	'Scripts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Manage Scripts','url'=>array('index')),
            array('label'=>'Create Script','url'=>array('create')),
            array('label'=>'View Script','url'=>array('view','id'=>$model->id)),
        )
    )
);
?>

	<h1>Update Script </h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>