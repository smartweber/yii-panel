<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('defaultProxyID')); ?>:</b>
	<?php echo CHtml::encode($data->defaultProxyID); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('scriptID')); ?>:</b>
	<?php echo CHtml::encode($data->scriptID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('value1')); ?>:</b>
	<?php echo CHtml::encode($data->value1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value2')); ?>:</b>
	<?php echo CHtml::encode($data->value2); ?>
	<br />

	*/ ?>

</div>