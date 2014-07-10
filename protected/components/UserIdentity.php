<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        /**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
        private $_id;
    
	public function authenticate()
	{
                $user = User::model()->findByAttributes(array('username'=>$this->username, 'active'=>1));
                
		if($user == null) {
                    $this->errorCode=self::ERROR_USERNAME_INVALID;
                //} elseif($user->password !== SHA1($this->password)) {
                } elseif($user->password !== $this->password) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
                } else {
			$this->errorCode=self::ERROR_NONE;
                        $this->_id = $user->id;
                }
		return !$this->errorCode;
	}
        
        public function getId() {
            return $this->_id;
        }
}