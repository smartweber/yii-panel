<?php
$this->breadcrumbs=array(
	'Web Accounts'=>array('index'),
	'Create',
);

$this->widget('booster.widgets.TbMenu', array(
    'type'  =>  'pills',
    'items' =>  array(
        array('label'=>'Manage Web Accounts','url'=>array('admin')),
    )
));
?>

<h1>Create WebAccount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>