<?php
$this->breadcrumbs=array(
	'Web Accounts',
);

$this->menu=array(
array('label'=>'Create WebAccount','url'=>array('create')),
array('label'=>'Manage WebAccount','url'=>array('admin')),
);
?>

<h1>Web Accounts</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
