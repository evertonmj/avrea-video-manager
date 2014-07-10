<?php
$this->breadcrumbs=array(
	'Categorias de Vídeo',
);

$this->menu=array(
	array('label'=>'Criar Categoria','url'=>array('create')),
	array('label'=>'Gerenciar Categoria','url'=>array('admin')),
);
?>

<h1>Categorias de Vídeo</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
