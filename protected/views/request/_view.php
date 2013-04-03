<?php
/* @var $this RequestController */
/* @var $data Request */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('open_time')); ?>:</b>
	<?php echo CHtml::encode($data->open_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('close_time')); ?>:</b>
	<?php echo CHtml::encode($data->close_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dpt_id')); ?>:</b>
	<?php echo CHtml::encode($data->dpt_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('src_id')); ?>:</b>
	<?php echo CHtml::encode($data->src_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_id')); ?>:</b>
	<?php echo CHtml::encode($data->type_id); ?>
	<br />


</div>