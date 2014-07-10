<?php

/**
 * This is the model class for table "video".
 *
 * The followings are the available columns in table 'video':
 * @property integer $id
 * @property integer $categoria_video_id
 * @property string $nome
 * @property string $descricao
 * @property integer $ordem
 * @property integer $obrigatorio
 * @property string $caminho
 * @property string $data_criacao
 * @property string $data_modificacao
 * @property string $arquivo
 * @property string $arquivo_nome
 * @property string $arquivo_tipo
 * @property string $codigo_gerado
 * @property string $qtd_execucoes
 * @property integer $ativo
 *
 * The followings are the available model relations:
 * @property CategoriaVideo $categoriaVideo
 */
class Video extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'video';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('categoria_video_id, nome, data_criacao', 'required'),
			array('categoria_video_id, ordem, obrigatorio, ativo', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>100),
			array('descricao', 'length', 'max'=>2000),
			array('caminho', 'length', 'max'=>1000),
			array('arquivo_nome', 'length', 'max'=>300),
			array('arquivo_tipo, qtd_execucoes', 'length', 'max'=>20),
			array('codigo_gerado', 'length', 'max'=>4000),
			array('data_modificacao, arquivo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, categoria_video_id, nome, descricao, ordem, obrigatorio, caminho, data_criacao, data_modificacao, arquivo, arquivo_nome, arquivo_tipo, codigo_gerado, qtd_execucoes, ativo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'categoriaVideo' => array(self::BELONGS_TO, 'CategoriaVideo', 'categoria_video_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Código',
			'categoria_video_id' => 'Categoria',
			'nome' => 'Nome',
			'descricao' => 'Descrição',
			'ordem' => 'Ordem',
			'obrigatorio' => 'Obrigatório?',
			'caminho' => 'Caminho para o arquivo',
			'data_criacao' => 'Data de Criação',
			'data_modificacao' => 'Data de Modificação',
			'arquivo' => 'Arquivo Físico',
			'arquivo_nome' => 'Nome do Arquivo',
			'arquivo_tipo' => 'Tipo do Arquivo',
			'codigo_gerado' => 'Código Gerado',
			'qtd_execucoes' => 'Quantidade de Execuções',
			'ativo' => 'Ativo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('categoria_video_id',$this->categoria_video_id);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('ordem',$this->ordem);
		$criteria->compare('obrigatorio',$this->obrigatorio);
		$criteria->compare('caminho',$this->caminho,true);
		$criteria->compare('data_criacao',$this->data_criacao,true);
		$criteria->compare('data_modificacao',$this->data_modificacao,true);
		$criteria->compare('arquivo',$this->arquivo,true);
		$criteria->compare('arquivo_nome',$this->arquivo_nome,true);
		$criteria->compare('arquivo_tipo',$this->arquivo_tipo,true);
		$criteria->compare('codigo_gerado',$this->codigo_gerado,true);
		$criteria->compare('qtd_execucoes',$this->qtd_execucoes,true);
		$criteria->compare('ativo',$this->ativo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Video the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
