<?php
$this->breadcrumbs=array(
	'Categorias de Vídeo'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Categorias','url'=>array('index')),
	array('label'=>'Criar Categoria','url'=>array('create')),
	array('label'=>'Visualizar Categoria','url'=>array('view','id'=>$model->id)),
	array('label'=>'Gerenciar Categorias','url'=>array('admin')),
);
?>

<h1>Atualizar Categoria <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>