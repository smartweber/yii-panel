<?php

/**
 * This is the model class for table "blocked_urls".
 *
 * The followings are the available columns in table 'blocked_urls':
 * @property string $id
 * @property string $value
 * @property string $title
 * @property int $type
 */
class BlockedUrl extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blocked_urls';
	}
	
	public $typeTitles = array(
		'0'	=>	'Black Listed',
		'1'	=>	'Favourite',
		'2'	=>	'Copy to Clipboard'
	);

	public static function typeTitles() {
		return array(
			array(
				'type' => 0,
				'title' => 'Black Listed'
			),
			array(
				'type' => 1,
				'title' => 'Favourite'
			),
			array(
				'type'	=>	2,
				'title'	=> 'Copy to Clipboard'
			)
		);
	}

	public function formattedValue() {
		return substr($this->value, 0, 40);
	}

	public function formattedType() {
		return $this->typeTitles[$this->type];
	}
	
	public function formattedTitle() {
		return substr($this->title, 0, 40);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value, type, title', 'required'),
			array('category', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, value', 'safe', 'on'=>'search'),
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
		//'blocked'=> array(self::MANY_MANY, 'WebAccount', 'blocked_urls_for_webaccounts(webaccountID,blockedUrlID'),
		//'favourites'=> array(self::MANY_MANY, 'WebAccount', 'blocked_urls_for_webaccounts(webaccountID,blockedUrlID'),
		//'clipboard'=> array(self::MANY_MANY, 'WebAccount', 'blocked_urls_for_webaccounts(webaccountID,blockedUrlID'),
		
		'WebAccount'=> array(self::MANY_MANY, 'blocked_urls_for_webaccounts', 'blocked_urls_for_webaccounts(blockedUrlID, webaccountID')			
		);

	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value' => 'Blocked and Shortcuts',
			'title'	=>	'Title',
			'type' => 'Type',
			'category' => 'Category',
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
		$criteria->compare('title', $this->title, true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('type', $this->type, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlockedUrl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function scopes() {
		return array(
			'blocked'	=>	array(
				'condition'	=>	'type = 0'
			),
			'favourites'	=>	array(
				'condition'	=>	'type = 1'
			),
			'clipboard'	=>	array(
				'condition'	=>	'type = 2'
			)
		);
	}
	
    public static function getBlocked() {
        $data = [];
        $accountID = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;
    	$sql = "SELECT * FROM blocked_urls WHERE account = '$accountID'";
    	$blocked_urls = self::model()->findAllBySql($sql); 

        foreach ($blocked_urls as $url) {
            $data[$url->id] = $url->value;
        }
        return $data;
    }
        
    
    public static function getBlockedUrls() {
        $data = [];
        $accountID = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;
    	$sql = "SELECT * FROM blocked_urls WHERE account = '$accountID'";
    	$blocked_urls = self::model()->findAllBySql($sql); 

        foreach ($blocked_urls as $url) {
            $data[$url->id] = $url->value;
        }
        return $data;
    }
}
