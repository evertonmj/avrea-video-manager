<?php
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/uploadify/jquery.uploadify.min.js');
$cs->registerCssFile($baseUrl.'/js/uploadify/uploadify.css');
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'video-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

        <?php echo $form->labelEx($model,'categoria_video_id'); ?>
        <?php echo $form->dropDownList($model,'categoria_video_id', CHtml::listData(
                         CategoriaVideo::model()->findAll(), 'id', 'nome'), array('class' => 'chosen-select span5', 'style' => 'width: 300px;')); ?>
        <?php echo $form->error($model,'categoria_video_id'); ?>

	<?php echo $form->textFieldRow($model,'nome',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textAreaRow($model,'descricao',array('class'=>'span5','maxlength'=>2000)); ?>

	<?php 
            if($model->id != "") {
                echo $form->checkboxRow($model,'ativo'); 
            }
        ?>
	<?php
            if($model->id != "") { ?>
            <h4>Selecione abaixo o vídeo</h4>
            <?php
                echo $form->fileFieldRow($model,'arquivo',array('class'=>'span5', 'id'=>'Video_arquivo'));
            }
        ?>
        <br />
        <div id="upload-success" class="alert in alert-block fade alert-success" style="display: none"></div>
        <div id="progress" class="alert in alert-block fade alert-success" style="display: none"></div>
        <div id="upload-error" class="alert in alert-block fade alert-error" style="display: none"></div>
        <div id="embed-code-title" class="alert in alert-block fade alert-success" style="display: none">Copie o código do quadro abaixo:</div>
        <pre id="embed-code" class="alert in alert-block fade" style="display: none"></pre>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Criar' : 'Salvar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<script>
$(function() {
    $('#Video_arquivo').uploadify({
        'buttonText' : 'SELECIONE',
        'successTimeout': 22000,
        'swf'      : '<?php echo $baseUrl ?>/js/uploadify/uploadify.swf',
        'uploader' : '<?php echo $baseUrl ?>/video/uploadFile/id/<?php echo $model->id ?>',
        'onUploadSuccess': function (file, data, response) {
            $('#upload-error').hide();
            $('#progress').hide();
            if(response) {
                $('#upload-success').show();
                $('#upload-success').html("O arquivo foi enviado e processado com sucesso!");
                
                $.ajax({
                   url: '<?php echo $baseUrl ?>/video/getEmbedCode/',
                   type: 'POST',
                   data: {'id': <?php echo $model->id ?>},
                   dataType:'html',
                   success: function(data) {
                       $('#embed-code-title').show();
                       $('#embed-code').show();
                       $('#embed-code').text(data);
                   },
                });
            } else {
                $('#upload-error').show();
                $('#upload-error').html("Ocorreu um erro ao processar o arquivo");
            }
        },
        'onUploadError': function (file, errorCode, errorMsg, errorString) {
            $('#upload-error').show();
            $('#progress').hide();
            if(errorMsg == 503) {
                $('#upload-error').html("Ocorreu um erro ao processar o arquivo. O arquivo informado é de um formato inválido.");
            } else if (errorMsg == 504) {
                $('#upload-error').html("Ocorreu um erro ao processar o arquivo. O arquivo informado é maior do que o tamanho máximo permitido.");
            } else {
                $('#upload-error').html("Ocorreu um erro ao processar o arquivo");
            }
        },
         'onUploadProgress' : function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {
            $('#upload-error').hide();
            $('#upload-success').hide();
            $('#embed-code-title').hide();
            $('#embed-code').hide();
            $('#progress').show();
            $('#progress').html('O arquivo está sendo enviado e processado. Aguarde enquanto a operação é finalizada.&nbsp;<img src="<?php echo Yii::app()->request->baseUrl ?>/images/loading.gif" />');
        }
        // Put your options here
    });
});
</script>
