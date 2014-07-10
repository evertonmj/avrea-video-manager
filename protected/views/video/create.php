<?php
$this->breadcrumbs=array(
	'Vídeos'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Listar Vídeos','url'=>array('index')),
	array('label'=>'Gerenciar Vídeos','url'=>array('admin')),
);
?>

<h1>Criar Vídeo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>