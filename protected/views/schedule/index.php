<?php
$this->breadcrumbs=array(
	'Scheduling',
);

$this->menu=array(
array('label'=>'Create Schedule','url'=>array('create')),
array('label'=>'Manage Schedule','url'=>array('admin')),
);
?>

<h1>Schedule</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>