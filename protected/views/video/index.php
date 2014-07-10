<?php
$this->breadcrumbs=array(
	'Vídeos',
);

$this->menu=array(
	array('label'=>'Criar Vídeo','url'=>array('create')),
	array('label'=>'Gerenciar Vìdeo','url'=>array('admin')),
);
?>

<h1>Vídeos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
