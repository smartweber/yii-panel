<?php

/**
 * This is the model class for table "scripts".
 *
 * The followings are the available columns in table 'scripts':
 * @property string $id
 * @property string $title
 * @property string $source
 * @property string $url
 */
class Script extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'scripts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, url', 'length', 'max'=>255),
			array('source', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, url, source', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' 	=> 'ID',
			'title' => 'Title',
			'source' => 'Source',
			"url"	=>	'Url'
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('account',User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('url', $this->url, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Script the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getAllScripts() {
        $data = [];
        $account = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;
        $sql = "SELECT * FROM scripts WHERE account = '$account'";
        $scripts = self::model()->findAllBySql($sql);

        foreach ($scripts as $script) {
            $data[$script->id] = $script['title'];
        }

        return $data;
    }
}
