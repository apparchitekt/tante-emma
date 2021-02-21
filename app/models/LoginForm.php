<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model {
    public $username;
    public $password;
    private $_user = false;

    /**
     * @return array validation rules
     */

    public function rules() {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return array input labels
     */

    public function attributeLabels() {
        return [
            'username' => 'Benutzername',
            'password' => 'Passwort',
        ];
    }  

    /**
     * Password validation
     *
     * @param string $attribute attribute currently being validated
     * @param array $params additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if(!$this->hasErrors()) {
            $user = $this->getUser();

            if(!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Benutzername oder Passwort falsch.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password
     * 
     * @return bool whether the user is logged in successfully
     */

    public function login() {
        if($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 0);
        }

        return false;
    }

    /**
     * Find user by username
     *
     * @return User|null
     */

    public function getUser() {
        if($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
