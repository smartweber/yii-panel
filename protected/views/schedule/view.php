<?php

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Manage Scheduling','url'=>array('index')),
            array('label'=>'Create Scheduling','url'=>array('create')),
            array('label'=>'Update Scheduling','url'=>array('update','id'=>$model->id)),
            array('label'=>'Delete Scheduling','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        )
    )
);
?>

<h1>View Schedule '<?php echo $model->title; ?>'</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		array(
            'name'  =>  'title',
            'label' =>  'Title',
           
        ),

		array(
            'name'  =>  'montime',
            'label' =>  'Monday Time',
            'value' =>  isset($model->montime) ? $model->montime : 'None'
        ),

        array(
            'name'  =>  'tuestime',
            'label' =>  'Tuesday Time',
            'value' =>  isset($model->tuestime) ? $model->tuestime : 'None'
        ),

        array(
            'name'  =>  'wedtime',
            'label' =>  'Wednesday Time',
            'value' =>  isset($model->wedtime) ? $model->wedtime : 'None'
        ),

       array(
            'name'  =>  'thurstime',
            'label' =>  'Thursday Time',
            'value' =>  isset($model->thurstime) ? $model->thurstime : 'None'
        ),

       array(
            'name'  =>  'fritime',
            'label' =>  'Friday Time',
            'value' =>  isset($model->fritime) ? $model->fritime : 'None'
        ),

       array(
            'name'  =>  'sattime',
            'label' =>  'Saturday Time',
            'value' =>  isset($model->sattime) ? $model->sattime : 'None'
        ),          
        
       array(
            'name'  =>  'sutime',
            'label' =>  'Sunday Time',
            'value' =>  isset($model->sutime) ? $model->sutime : 'None'
        ),              
),
)); ?>
