<?php
$baseUrl = Yii::app()->baseUrl; 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_data_criacao').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['pt'],{'dateFormat':'dd/mm/yyyy'}));
}
");

$this->breadcrumbs=array(
	'Vídeos'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Vídeos','url'=>array('index')),
	array('label'=>'Criar Video','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('video-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Vídeos</h1>

<p>
Você pode utilizar operadores de comparação (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) no começo de cada um dos campos de busca para a especificar como a comparação será feita.
</p>

<?php echo CHtml::link('Busca','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<input type="hidden" id="urlEmbedCode" value="<?php echo $baseUrl ?>/video/getEmbedCode/" />
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'video-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                    'name'=>'id', 
                    'value'=>'$data->id',
                    'htmlOptions'=>array(
                        'id'=>'record-id'
                    ),
                ),
                array(
                    'name'=>'categoria_video_id', 
                    'value'=>'CHtml::encode($data->categoriaVideo ? $data->categoriaVideo->nome : \'\')',
                    'filter' => array(CHtml::listData(CategoriaVideo::model()->findall(), 'id', 'nome', 'Categorias'))
                ),
		'nome',
                array(
                    'name'=>'data_criacao',
                    'value'=>'Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($data->data_criacao, \'dd/MM/yyyy\'),\'medium\',null)',
                ), 
		array(
                    'name'=>'data_modificacao',
                    'value'=>'Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($data->data_modificacao, \'dd/MM/yyyy\'),\'medium\',null)'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{embed-code} {view} {update} {delete}',
                        'buttons'=>array (
                            'embed-code'=>array(
                                'label'=>'<i class="icon-list-alt"></i>',
                                'imageUrl'=>false,
                                'options'=>array(
                                    'id'=>'embed-code-id'
                                ),
                            ),
                        ),
		),
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal'
        , array ('id'=>'modalCodigoGerado',
                 'htmlOptions'=>array(
                     'style'=>'width: 800px;margin-left:-400px',
                 )
                )
      ); ?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Copie o código abaixo:</h4>
    </div>

    <pre id="elementEmbedCode"></pre>
    
    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Fechar',
            'type'=>'primary',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>
    </div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $('#embed-code-id').click(function () {
        //var id = $(this).closest('td[id]').html();
        var id = $(this).parent().parent().find('#record-id').html();
        var url = $('#urlEmbedCode').val();
        
        $.ajax({
            url: url,
            type: 'POST',
            data: {'id': id},
            dataType:'html',
            success: function(data) {
                $('#elementEmbedCode').text(data);
                $('#modalCodigoGerado').modal("show");
            },
        });
    });
</script>