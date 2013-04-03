<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'open_time'); ?>
		<?php echo $form->textField($model,'open_time'); ?>
		<?php echo $form->error($model,'open_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'close_time'); ?>
		<?php echo $form->textField($model,'close_time'); ?>
		<?php echo $form->error($model,'close_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dpt_id'); ?>
		<?php echo $form->textField($model,'dpt_id'); ?>
		<?php echo $form->error($model,'dpt_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'src_id'); ?>
		<?php echo $form->textField($model,'src_id'); ?>
		<?php echo $form->error($model,'src_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_id'); ?>
		<?php echo $form->textField($model,'type_id'); ?>
		<?php echo $form->error($model,'type_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->