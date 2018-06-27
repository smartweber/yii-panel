<?php
$this->breadcrumbs=array(
	'Scripts',
);

$this->menu=array(
array('label'=>'Create Script','url'=>array('create')),
array('label'=>'Manage Script','url'=>array('admin')),
);
?>

<h1>Scripts</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
