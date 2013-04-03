<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'open_time'); ?>
		<?php echo $form->textField($model,'open_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'close_time'); ?>
		<?php echo $form->textField($model,'close_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dpt_id'); ?>
		<?php echo $form->textField($model,'dpt_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'src_id'); ?>
		<?php echo $form->textField($model,'src_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_id'); ?>
		<?php echo $form->textField($model,'type_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->