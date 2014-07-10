<?php

class VideoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'create', 'update', 'admin', 'delete', 'uploadFile', 'getEmbedCode'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Video;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
		if(isset($_POST['Video']))
		{
			$model->attributes=$_POST['Video'];
                        $model->data_criacao = date('Y-m-d H:i:s');
                        $model->data_modificacao = date('Y-m-d H:i:s');
                        
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Video']))
		{
			$model->attributes=$_POST['Video'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
        
        public function actionGetEmbedCode() {
            if(Yii::app()->request->isPostRequest)
            {
                $id = $_POST['id'];
                $model=$this->loadModel($id);
                
                echo $model->codigo_gerado;
            }
        }
        
        public function actionUploadFile($id) {
            
            if(!empty($_FILES['Filedata']['tmp_name']))
            {
                $file = pathinfo($_FILES['Filedata']['name']);
                $fileTypes = array('avi', 'mpeg', 'mp4', 'mpg', 'mkv'); // File extensions
                $fileSize = $_FILES['Filedata']['size'];
                
                if (in_array($file['extension'],$fileTypes)) {
                    if($fileSize < Yii::app()->params['maxUploadFileSize']) {
                        $model=$this->loadModel($id);

                        // Uncomment the following line if AJAX validation is needed
                        // $this->performAjaxValidation($model);
                        $model->data_modificacao = date('Y-m-d H:i:s');
                        $fileName = "";

                        $caminhoAntigo = $model->caminho;
                        $arquivoAntigo = $model->arquivo;
                        //salva o arquivo
                        $model->arquivo = $_FILES['Filedata']['name'];
                        $model->arquivo_nome = $file['basename'];
                        $model->arquivo_tipo = $file['extension'];

                        $fileName = uniqid('', true) . '.' . $file['extension'];

                        $model->caminho = $fileName;
                        $model->codigo_gerado = Yii::app()->s3->generateEmbedCodeRMTPAWSS3($fileName, $file['extension'], Yii::app()->params['cloudFrontWeb'], Yii::app()->params['cloudFrontRTMP']);

                        if($model->save()){
                            if($fileName != "") {
                                //faz upload para pasta no servidor
                                //$model->arquivo->saveAs(Yii::app()->params['videoUploadDir'].$fileName);

                                //faz upload para S3 Bucket da AWS
                                Yii::app()->s3->uploadFile($_FILES['Filedata']['tmp_name'], Yii::app()->params['videoS3Bucket'], $fileName);

                                //remove o arquivo de video
                                if($caminhoAntigo != "") {
                                    //remove arquivos de pasta do servidor
                                    //unlink(Yii::app()->params['videoUploadDir'] . $caminhoAntigo);

                                    //remove arquivos de S3 bucket
                                    try {
                                        Yii::app()->s3->deleteObject(Yii::app()->params['videoS3Bucket'], $caminhoAntigo);
                                    } catch (Exception $e) {

                                    }
                                }
                            } 
                        }
                    } else {
                       throw new CHttpException(504,'file-size-error'); 
                    }
                } else {
                    throw new CHttpException(503,'extension-error');
                }
            }
        }

        /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Video');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Video('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Video']))
			$model->attributes=$_GET['Video'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Video::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='video-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
