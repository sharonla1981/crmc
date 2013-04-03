<?php
/* @var $this ReqTypeController */
/* @var $model ReqType */

$this->breadcrumbs=array(
	'Req Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReqType', 'url'=>array('index')),
	array('label'=>'Create ReqType', 'url'=>array('create')),
	array('label'=>'Update ReqType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReqType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReqType', 'url'=>array('admin')),
);
?>

<h1>View ReqType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
