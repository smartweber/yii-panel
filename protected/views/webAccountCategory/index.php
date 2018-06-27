<?php
$this->breadcrumbs=array(
	'Web Account Categories',
);

$this->menu=array(
array('label'=>'Create Web Account Category','url'=>array('create')),
array('label'=>'Manage Web Account Category','url'=>array('admin')),
);
?>

<h1>Web Account Categories</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>