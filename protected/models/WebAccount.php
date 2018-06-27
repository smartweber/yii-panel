<?php

/**
 * This is the model class for table "webaccounts".
 *
 * The followings are the available columns in table 'webaccounts':
 * @property string $id
 * @property string $title
 * @property integer $defaultProxyID
 * @property integer $scriptID
 * @property string $username
 * @property string $password
 * @property integer $value1
 * @property integer $value2
 */
class WebAccount extends CActiveRecord
{
	public $blocked = array();
	public $favourites = array();
	public $clipboard = array();


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'webaccounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, schedule, defaultProxyID, scriptID, username, password', 'required'),
			array('category, schedule, defaultProxyID, scriptID, value1, value2', 'numerical', 'integerOnly'=>true),
			//array('defaultProxyID', 'unique', 'message' => 'This proxy is used already.'),
		        array('defaultProxyID', 'ext.UniqueAttributesValidator', 'with' => 'scriptID', 'message' => 'This proxy/script pair already exists. Please change one of them.'),
			array('title', 'length', 'max'=>255),
			array('username, password', 'length', 'max'=>110),
			array('blocked, favourites, clipboard, sented_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, defaultProxyID, scriptID, username, password, value1, value2', 'safe', 'on'=>'search'),
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
            'users'     => array(self::MANY_MANY, 'User', 'webaccounts_for_users(userID, webaccountID)'),
            'proxy'     =>  array(self::BELONGS_TO, 'Proxy', 'defaultProxyID'),
            'script'    =>  array(self::BELONGS_TO, 'Script', 'scriptID'),
            
           // todo:added block
           // 'blocked' => array(self::MANY_MANY, 'BlockedUrl', 'blocked_for_webaccounts(webaccountID, blockedUrlID)'),
           // 'favourites' => array(self::MANY_MANY, 'BlockedUrl', 'fav_for_webaccounts(webaccountID, blockedUrlID)'),
           // 'clipboard' => array(self::MANY_MANY, 'BlockedUrl', 'clipbd_for_webaccounts(webaccountID, blockedUrlID)'),
           // endof
            
            'blockedUrls'=> array(self::MANY_MANY, 'BlockedUrl', 'blocked_urls_for_webaccounts(webaccountID, blockedUrlID)')
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
			'category' => 'Category',
			'schedule' => 'Schedule',
			'defaultProxyID' => 'Default Proxy',
			'scriptID' => 'Script',
			'username' => 'Username',
			'password' => 'Password',
			'value1' => 'Value1',
			'value2' => 'Value2',
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
		$criteria->compare('defaultProxyID',$this->defaultProxyID);
		$criteria->compare('scriptID',$this->scriptID);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('value1',$this->value1);
		$criteria->compare('value2',$this->value2);
		
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

    public static function getAllWebAccounts() {
        $data = [];

    	$account = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;
        $sql = "SELECT * FROM webaccounts WHERE account = '$account'";
        $webaccounts = self::model()->findAllBySql($sql);

        foreach ($webaccounts as $webAccount) {
            $data[$webAccount->id] = $webAccount->title;
        }
        return $data;
    }

   
    public function afterFind() {
    	foreach ($this->blockedUrls as $url) {
    		if ($url->type == 0) {
    			$this->blocked[] = $url;
    		} else if ($url->type == 1) {
    			$this->favourites[] = $url;
    		} else if ($url->type == 2) {
    			$this->clipboard[] = $url;
    		}
    	}
    	parent::afterFind();
    }
  
}
