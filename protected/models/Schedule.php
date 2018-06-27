<?php

/**
 * This is the model class for table "webaccountgroup".
 *
 * The followings are the available columns in table 'webaccountcategory':
 * @property string $id
 * @property string $title
 */
class Schedule extends CActiveRecord
{
	public $blocked = array();
	public $favourites = array();
	public $clipboard = array();


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'scheduling';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('monoption, tuesoption, wedoption, thursoption, frioption, satoption, suoption', 'numerical', 'integerOnly'=>true),
			array('title, montime, tuestime, wedtime, thurstime, fritime, sattime, sutime', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, monoption, montime, tuesoption, tuestime, wedoption, wedtime, thursoption, thurstime, frioption, fritime, satoption, sattime, suoption, sutime', 'safe', 'on'=>'search'),
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
            //'users'     => array(self::MANY_MANY, 'User', 'webaccounts_for_users(userID, webaccountID)'),
            //'proxy'     =>  array(self::BELONGS_TO, 'Proxy', 'defaultProxyID'),
            //'script'    =>  array(self::BELONGS_TO, 'Script', 'scriptID'),
            
           // todo:added block
           // 'blocked' => array(self::MANY_MANY, 'BlockedUrl', 'blocked_for_webaccounts(webaccountID, blockedUrlID)'),
           // 'favourites' => array(self::MANY_MANY, 'BlockedUrl', 'fav_for_webaccounts(webaccountID, blockedUrlID)'),
           // 'clipboard' => array(self::MANY_MANY, 'BlockedUrl', 'clipbd_for_webaccounts(webaccountID, blockedUrlID)'),
           // endof
            
           // 'blockedUrls'=> array(self::MANY_MANY, 'BlockedUrl', 'blocked_urls_for_webaccounts(webaccountID, blockedUrlID)')
		);
	}

    public function behaviors(){
        return array('ESaveRelatedBehavior' => array(
            'class' => 'application.components.ESaveRelatedBehavior')
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'monoption' => 'Status',
			'montime' => 'Time',	

			'tuesoption' => 'Status',
			'tuestime' => 'Time',

			'wedoption' => 'Status',
			'wedtime' => 'Time',	

			'thursoption' => 'Status',
			'thurstime' => 'Time',

			'frioption' => 'Status',
			'fritime' => 'Time',

			'satoption' => 'Status',
			'sattime' => 'Time',

			'suoption' => 'Status',
			'sutime' => 'Time',								
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WebAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getAllSchedules() {
        $data = [];
        $account = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;
        $sql = "SELECT * FROM scheduling WHERE account = '$account'";
        $schedules = self::model()->findAllBySql($sql);

        foreach ($schedules as $schedule) {
            $data[$schedule->id] = $schedule->title;
        }		

        return $data;
    }

   
    public function afterFind() {
    	parent::afterFind();
    }
  
}
