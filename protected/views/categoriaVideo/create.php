<?php
$this->breadcrumbs=array(
	'Categorias de Vídeo'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Listar Categorias','url'=>array('index')),
	array('label'=>'Gerenciar Categorias','url'=>array('admin')),
);
?>

<h1>Criar Categoria de Vídeo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>