<?php
$this->breadcrumbs=array(
	'Proxies',
);

$this->menu=array(
array('label'=>'Create Proxy','url'=>array('create')),
array('label'=>'Manage Proxy','url'=>array('admin')),
);
?>

<h1>Proxies</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
