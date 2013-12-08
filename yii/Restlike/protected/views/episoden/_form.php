<?php
/* @var $this EpisodenController */
/* @var $model Episoden */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'episoden-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NR_TOTAL'); ?>
		<?php echo $form->textField($model,'NR_TOTAL'); ?>
		<?php echo $form->error($model,'NR_TOTAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NR_STAFFEL'); ?>
		<?php echo $form->textField($model,'NR_STAFFEL'); ?>
		<?php echo $form->error($model,'NR_STAFFEL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DEUTSCHER_TITEL'); ?>
		<?php echo $form->textField($model,'DEUTSCHER_TITEL',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'DEUTSCHER_TITEL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ORIGINAL­TITEL'); ?>
		<?php echo $form->textField($model,'ORIGINAL­TITEL',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ORIGINAL­TITEL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ERSTAUS­STRAHLUNG_USA'); ?>
		<?php echo $form->textField($model,'ERSTAUS­STRAHLUNG_USA',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ERSTAUS­STRAHLUNG_USA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DEUTSCH­SPRACHIGEAUSSPRACHE'); ?>
		<?php echo $form->textField($model,'DEUTSCH­SPRACHIGEAUSSPRACHE',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'DEUTSCH­SPRACHIGEAUSSPRACHE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'REGIE'); ?>
		<?php echo $form->textField($model,'REGIE',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'REGIE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DREHBUCH'); ?>
		<?php echo $form->textField($model,'DREHBUCH',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'DREHBUCH'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'USQUOTEN'); ?>
		<?php echo $form->textField($model,'USQUOTEN',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'USQUOTEN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'INHALT'); ?>
		<?php echo $form->textArea($model,'INHALT',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'INHALT'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->