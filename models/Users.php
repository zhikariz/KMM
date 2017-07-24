<?php

namespace app\models;

class Users extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id_user;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $id_role;
    public $photo_user;


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
      //mencari user login berdasarkan IDnya dan hanya dicari 1.
      $user = User::findOne($id);
      if(count($user)){
          return new static($user);
      }
      return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
      //mencari user login berdasarkan accessToken dan hanya dicari 1.
        $user = User::find()->where(['accessToken'=>$token])->one();
        if(count($user)){
            return new static($user);
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
      //mencari user login berdasarkan username dan hanya dicari 1.
        $user = User::find()->where(['username'=>$username])->one();
        if(count($user)){
            return new static($user);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id_user;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
