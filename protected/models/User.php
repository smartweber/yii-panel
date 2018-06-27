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
 * @property array $proxies
 * @property array $webAccounts
 */
class User extends CActiveRecord
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
			array('login, password', 'required', 'on' => 'createUser'),
			array('login, password', 'length', 'max'=>20),
			array('guid', 'length', 'max'=>50),
			array('email', 'length', 'max'=>255),
			array('email', 'email'),
            array('proxies', 'safe'),
            array('webAccounts', 'safe'),
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
            'webAccounts'   =>  array(self::MANY_MANY, 'WebAccount', 'webaccounts_for_users(userID, webaccountID)'),
            'proxies'       =>  array(self::MANY_MANY, 'Proxy', 'proxies_for_users(userID, proxyID)')
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
    public function behaviors(){
        return array('ESaveRelatedBehavior' => array(
            'class' => 'application.components.ESaveRelatedBehavior')
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
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function createGUID() {
	 	$connection = Yii::app()->db;
	 	$login = $this->login;
	 	$password = $this->password;
        $command = $connection->createCommand("CALL createGUID(:login, :password, @guid);");
        $command->bindParam(":login", $login, PDO::PARAM_STR);
        $command->bindParam(":password", $password, PDO::PARAM_STR);
        $command->execute();

        $this->guid = $connection->createCommand("SELECT @guid as result;")->queryScalar();
	}


    public function getUserID() {
        $username = Yii::app()->user->id;
        $connection = Yii::app()->db;
        $id = $connection->createCommand("SELECT id FROM users
            WHERE login = '$username' and isAdmin = 1 and enabled = 1")->queryScalar();  
        return $id;        
    }	
}
