<?php
/* @var $this ReqTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Req Types',
);

$this->menu=array(
	array('label'=>'Create ReqType', 'url'=>array('create')),
	array('label'=>'Manage ReqType', 'url'=>array('admin')),
);
?>

<h1>Req Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
