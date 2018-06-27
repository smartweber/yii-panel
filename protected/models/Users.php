<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $login
 * @property string $password
 * @property string $guid
 * @property string $email
 * @property integer $isAdmin
 * @property integer $enabled
 *
 * The followings are the available model relations:
 * @property BlockedUrls[] $blockedUrls
 * @property Proxies[] $proxies
 * @property Webaccounts[] $webaccounts
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isAdmin, enabled', 'numerical', 'integerOnly'=>true),
			array('login, password', 'length', 'max'=>20),
			array('guid', 'length', 'max'=>50),
			array('email', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, password, guid, email, isAdmin, enabled', 'safe', 'on'=>'search'),
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
			'blockedUrls' => array(self::MANY_MANY, 'BlockedUrls', 'blocked_urls_for_users(userID, blockedUrlID)'),
			'proxies' => array(self::MANY_MANY, 'Proxies', 'proxies_for_users(userID, proxyID)'),
			'webaccounts' => array(self::MANY_MANY, 'Webaccounts', 'webaccounts_for_users(userID, webaccountID)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'password' => 'Password',
			'guid' => 'Guid',
			'email' => 'Email',
			'isAdmin' => 'Is Admin',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('guid',$this->guid,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('isAdmin',$this->isAdmin);
		$criteria->compare('enabled',$this->enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
