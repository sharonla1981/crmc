<?php

/**
 * This is the model class for table "tbl_request".
 *
 * The followings are the available columns in table 'tbl_request':
 * @property integer $id
 * @property string $open_time
 * @property string $close_time
 * @property integer $dpt_id
 * @property integer $src_id
 * @property integer $type_id
 *
 * The followings are the available model relations:
 * @property Department $dpt
 * @property Source $src
 * @property ReqType $type
 */
class Request extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, open_time', 'required'),
			array('id, dpt_id, src_id, type_id', 'numerical', 'integerOnly'=>true),
			array('close_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, open_time, close_time, dpt_id, src_id, type_id', 'safe', 'on'=>'search'),
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
			'dpt' => array(self::BELONGS_TO, 'Department', 'dpt_id'),
			'src' => array(self::BELONGS_TO, 'Source', 'src_id'),
			'type' => array(self::BELONGS_TO, 'ReqType', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'open_time' => 'Open Time',
			'close_time' => 'Close Time',
			'dpt_id' => 'Dpt',
			'src_id' => 'Src',
			'type_id' => 'Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('open_time',$this->open_time,true);
		$criteria->compare('close_time',$this->close_time,true);
		$criteria->compare('dpt_id',$this->dpt_id);
		$criteria->compare('src_id',$this->src_id);
		$criteria->compare('type_id',$this->type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}