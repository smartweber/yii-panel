<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public $userID;
    public $guid;

    public function createGUID() {
        $connection = Yii::app()->db;

        $command = $connection->createCommand("CALL createGUID(:login, :password, @guid);");
        $command->bindParam(":login", $this->username, PDO::PARAM_STR);
        $command->bindParam(":password", $this->password, PDO::PARAM_STR);
        $command->execute();

        return $connection->createCommand("SELECT @guid as result;")->queryScalar();
    }

    public function getUser()
    {
        return $this->user;
    }
    
    public function authenticate() {
        $connection = Yii::app()->db;

        $guid = $this->createGUID();

        $command = $connection->createCommand("CALL getUserID(:login, :guid, @userID);");
        $command->bindParam(':login', $this->username, PDO::PARAM_STR);
        $command->bindParam(':guid', $guid, PDO::PARAM_STR);
        $command->execute();

        $userID = $connection->createCommand("SELECT @userID as result")->queryScalar();

        $username = $connection->createCommand("SELECT COUNT(login) FROM users WHERE login = '$this->username' and isAdmin = 1 and enabled = 1")->queryScalar();

        if ($username == 0) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if (is_null($userID)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->userID = $userID;
            $this->guid = $guid;
            $this->errorCode = self::ERROR_NONE;
        }

//        $command = Yii::app()->db->createCommand("CALL createGUID(:login, :password, @out);");
//
//        $command = Yii::

//        $command = $connection->createCommand("CALL remove_places(:user_id,:placeID,:place_type,@out)");
//        $command->bindParam(":user_id",$user_id,PDO::PARAM_INT);
//        $command->bindParam(":placeID",$placeID,PDO::PARAM_INT);
//        $command->bindParam(":place_type",$place_type,PDO::PARAM_INT);
//        $command->execute();
//        $valueOut = $connection->createCommand("select @out as result;")->queryScalar();
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		elseif($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;
    }   
}