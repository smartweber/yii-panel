<?php
$this->breadcrumbs=array(
	'Blocked Urls',
);

$this->menu=array(
array('label'=>'Create BlockedUrl','url'=>array('create')),
array('label'=>'Manage BlockedUrl','url'=>array('admin')),
);
?>

<h1>Blocked Urls</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
