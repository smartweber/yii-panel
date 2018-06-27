<?php
    $this->breadcrumbs=array(
    	'Blocked Urls'=>array('index'),
    	$model->id=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->widget(
        'booster.widgets.TbMenu',
        array(
            'type'  =>  'pills',
            'items' =>  array(
                array('label'=>'Manage Blocked Urls','url'=>array('admin')),
                array('label'=>'Create Blocked Url','url'=>array('create')),
                array('label'=>'View Blocked Url','url'=>array('view','id'=>$model->id)),
            )
        )
    );
?>

<h1>Update Blocked Url <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>