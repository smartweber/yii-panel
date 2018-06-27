<?php

/**
 * This is the model class for table "proxies".
 *
 * The followings are the available columns in table 'proxies':
 * @property string $id
 * @property string $ip
 * @property string $port
 * @property string $username
 * @property string $password
 * @property integer $enabled
 */
class Proxy extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proxies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip', 'required'),
			array('enabled', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>300),
			array('port', 'length', 'max'=>11),
			array('username, password', 'length', 'max'=>110),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ip, port, username, password, enabled', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'ip' => 'Ip',
			'port' => 'Port',
			'username' => 'Username',
			'password' => 'Password',
			'enabled' => 'Enabled',
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
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('port',$this->port,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('enabled',$this->enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proxy the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getAllProxies() {
        $data = [];
        $accountID = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;
    	$sql = "SELECT * FROM proxies WHERE account = '$accountID'";
    	$proxies = self::model()->findAllBySql($sql); 

        foreach ($proxies as $proxy) {
            $data[$proxy->id] = $proxy->ip;
        }

        return $data;
    }
    
    public static function getNonScriptProxies($id) {
    	$data = [];
    	$accountID = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;
    	
    	if (isset($id)) {
        	//$all_accounts = WebAccount::model()->findAll();
        	$sql = "SELECT * FROM webaccounts WHERE account = '$accountID'";
        	$all_accounts = WebAccount::model()->findAllBySql($sql);

        	foreach ($all_accounts as $account) {
        		$arr[$account->scriptID][] = $account->defaultProxyID;
        	}
        	if (count($arr[$id]) >0) {
	        	$sql = "SELECT * FROM proxies WHERE account = '$accountID'";
	        	$proxies = self::model()->findAllBySql($sql);  
	        	      		
        		foreach ($proxies as $proxy) {
        			if (!in_array($proxy->id, $arr[$id])) {
            			$data[$proxy->id] = $proxy->ip;
            		}
        		} 
        	} else {
        		$data = Proxy::model()->getAllProxies();
        	}
        } else {
            $data = Proxy::model()->getAllProxies();
        }
        
		return $data;
    }	

    public static function getProxyByID($id) {
    	
    	$data = [];

    	$accountID = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;

    	$sql = "SELECT * FROM proxies WHERE account = '$accountID'";
    	$proxies = self::model()->findAllBySql($sql);

    	//$all = self::model()->findAll();
    	foreach ($proxies as $proxy) {
	    		if ($proxy->id == $id) {
	    			$data = $proxy->ip;
	    		}
    	}

    	return $data;
    }

}
