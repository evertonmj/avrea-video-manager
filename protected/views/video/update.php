<?php
$this->breadcrumbs=array(
	'Vídeos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Atualizar',
);

$this->menu=array(
	array('label'=>'Listar Vídeos','url'=>array('index')),
	array('label'=>'Criar Vídeo','url'=>array('create')),
	array('label'=>'Visualizar Vídeo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Gerenciar Vídeos','url'=>array('admin')),
);
?>

<h1>Atualizar Vídeo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>