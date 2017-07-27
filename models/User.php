<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id_user
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property int $id_role
 * @property string $photo_user
 *
 * @property Administratif[] $administratifs
 * @property Dokumenmasuk[] $dokumenmasuks
 * @property Kendaraan[] $kendaraans
 * @property Notadebet[] $notadebets
 * @property PinjRuangrapat[] $pinjRuangrapats
 * @property Projectmanagement[] $projectmanagements
 * @property SkKepwakilGubSjalan[] $skKepwakilGubSjalans
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'id_role', 'photo_user'], 'required'],
            [['id_role'], 'integer'],
            [['username', 'authKey', 'accessToken', 'photo_user'], 'string', 'max' => 50],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_role' => 'id_role']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'id_role' => 'Id Role',
            'photo_user' => 'Photo User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministratifs()
    {
        return $this->hasMany(Administratif::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenmasuks()
    {
        return $this->hasMany(Dokumenmasuk::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKendaraans()
    {
        return $this->hasMany(Kendaraan::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotadebets()
    {
        return $this->hasMany(Notadebet::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPinjRuangrapats()
    {
        return $this->hasMany(PinjRuangrapat::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectmanagements()
    {
        return $this->hasMany(Projectmanagement::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkKepwakilGubSjalans()
    {
        return $this->hasMany(SkKepwakilGubSjalan::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id_role' => 'id_role']);
    }
    
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
        $user = $this->find()->where(['accessToken'=>$token])->one();
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
        $user = $this->find()->where(['username'=>$username])->one();
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
        return Yii::$app->security->validatePassword($password, $this->password);
    }



}
