<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('categoria_video_id')); ?>:</b>
	<?php echo CHtml::encode($data->categoriaVideo ? $data->categoriaVideo->nome : ''); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_criacao')); ?>:</b>
	<?php echo CHtml::encode(Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($data->data_criacao, 'dd/MM/yyyy'),'medium',null)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_modificacao')); ?>:</b>
	<?php echo CHtml::encode(Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($data->data_modificacao, 'dd/MM/yyyy'),'medium',null)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qtd_execucoes')); ?>:</b>
	<?php echo CHtml::encode($data->qtd_execucoes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ativo')); ?>:</b>
	<?php echo CHtml::encode($data->ativo ? 'Sim' : 'Não'); ?>
	<br />
</div>