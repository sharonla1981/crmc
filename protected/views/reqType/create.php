<?php
/* @var $this ReqTypeController */
/* @var $model ReqType */

$this->breadcrumbs=array(
	'Req Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReqType', 'url'=>array('index')),
	array('label'=>'Manage ReqType', 'url'=>array('admin')),
);
?>

<h1>Create ReqType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>