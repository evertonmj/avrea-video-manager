<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span1')); ?>

	<?php echo $form->labelEx($model,'categoria_video_id'); ?>
        <?php echo $form->dropDownList($model,'categoria_video_id', CHtml::listData(
                         CategoriaVideo::model()->findAll(), 'id', 'nome'), array('class' => 'chosen-select span5', 'style' => 'width: 300px;')); ?>
        <?php echo $form->error($model,'categoria_video_id'); ?>

	<?php echo $form->textFieldRow($model,'nome',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->checkBoxRow($model,'ativo', array('checked'=>'checked')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Busca',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
