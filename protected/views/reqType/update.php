<?php
/* @var $this ReqTypeController */
/* @var $model ReqType */

$this->breadcrumbs=array(
	'Req Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReqType', 'url'=>array('index')),
	array('label'=>'Create ReqType', 'url'=>array('create')),
	array('label'=>'View ReqType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReqType', 'url'=>array('admin')),
);
?>

<h1>Update ReqType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>