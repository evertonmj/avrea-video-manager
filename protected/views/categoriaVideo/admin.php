<?php
$this->breadcrumbs=array(
	'Categorias de Vídeo'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Categorias','url'=>array('index')),
	array('label'=>'Criar Categorias','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('categoria-video-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Categorias de Vídeo</h1>

<p>
Você pode utilizar operadores de comparação (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) no começo de cada um dos campos de busca para a especificar como a comparação será feita.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'categoria-video-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nome',
		'descricao',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
