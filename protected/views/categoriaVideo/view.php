<?php
$this->breadcrumbs=array(
	'Categorias de Vídeo'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Categorias','url'=>array('index')),
	array('label'=>'Criar Categoria','url'=>array('create')),
	array('label'=>'Atualizar Categoria','url'=>array('update','id'=>$model->id)),
	array('label'=>'Remover Categoria','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gerenciar Categoria','url'=>array('admin')),
);
?>

<h1>Visulizar Categorias</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'descricao',
	),
)); ?>
