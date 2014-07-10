<?php
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
?>
<?php 
$cs->registerScriptFile(Yii::app()->params['cloudFrontWeb'].'video-js/video.js');
$cs->registerCssFile(Yii::app()->params['cloudFrontWeb'].'video-js/video-js.min.css');
?>
<?php
$this->breadcrumbs=array(
	'Vídeos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Vídeos','url'=>array('index')),
	array('label'=>'Criar Vídeo','url'=>array('create')),
	array('label'=>'Atualizar Vídeo','url'=>array('update','id'=>$model->id)),
	array('label'=>'Remover Vídeo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Tem certeza que deseja remover o registro?')),
	array('label'=>'Gerenciar Vídeos','url'=>array('admin')),
);
?>

<h1>Visualizar Vídeo #<?php echo $model->id; ?></h1> 
<div id="divButton" class="right">
    <?php 
    if($model->id != "") {
        $this->widget('bootstrap.widgets.TbButton', array(
                 'buttonType'=>'button',
                 'type'=>'primary',
                 'label'=>'Obter Código do Vídeo',
                 'htmlOptions'=>array(
                     'id'=>'modal-button',
                     'data-toggle'=>'modal',
                     'data-target'=>'#modalCodigoGerado',
                 )
         ));
    }
    ?>
</div>
<br />
<br />
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                array('label'=>'Categoria do Vídeo', 'value'=>CHtml::encode($model->categoriaVideo ? $model->categoriaVideo->nome : '')),
		'nome',
		'descricao',
		array(
                    'name'=>'data_criacao',
                    'value'=>Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($model->data_criacao, 'dd/MM/yyyy'),'medium',null)),
                array(
                    'name'=>'data_modificacao',
                    'value'=>Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($model->data_modificacao, 'dd/MM/yyyy'),'medium',null)),
		'qtd_execucoes',
                array('label'=>'Ativo', 'value'=>CHtml::encode($model->ativo ? 'Sim' : 'Não'))
	),
)); ?>

<?php if($model->caminho != "") { ?>

<video id="video_<?php echo $model->id ?>" class="video-js vjs-default-skin"
  controls preload="auto" width="720" height="480"
  data-setup='{"example_option":true}'>
 <source src="<?php echo Yii::app()->params['cloudFrontRTMP'] ?>&mp4:<?php echo $model->caminho ?>" type='rtmp/mp4' />
 <p class="vjs-no-js">Para visualizar este vídeo por favor, habilite o Javascript e considere atualizar o seu navegador. <a href="http://videojs.com/html5-video-support/" target="_blank">Verifique os navegadores que oferecen suporte ao HTML 5</a></p>
</video>
<br /><br /><br />

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

    <pre id="elementEmbedCode"><?php echo htmlspecialchars($model->codigo_gerado);?></pre>
    
    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Fechar',
            'type'=>'primary',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>
    </div>
<?php $this->endWidget(); ?>
<?php } ?>
