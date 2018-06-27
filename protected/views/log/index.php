<h1>View Logs</h1>

<?php $this->widget('booster.widgets.TbExtendedGridView',array(
	'type'=>'striped',
	'id'=>'log-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'responsiveTable' => true,
	'columns'=>array(
		'created',
		'message'
	),
)); ?>
