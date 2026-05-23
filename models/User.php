<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $fullname
 * @property string $password
 * @property string $phone
 * @property string $email
 * @property int $isadmin
 * @property string $birthday
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'fullname', 'password', 'phone', 'email', 'birthday'], 'required'],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_]+$/',
            'message' => 'Логин может содержать только латинские буквы, цифры и символ подчёркивания.'],
            
            ['username', 'unique'],

            ['username', 'string', 'min' => 6],
            ['password', 'string', 'min' => 8],

            ['fullname', 'match', 'pattern' => '/^[а-яА-ЯёЁ ]+$/u',
            'message' => 'ФИО может содержать только кириллицу.'],
            [['birthday'], 'safe'],

            [['username', 'fullname', 'password', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'fullname' => 'ФИО',
            'password' => 'Пароль',
            'phone' => 'Номер телефона',
            'email' => 'Email',
            'birthday' => 'Дата рождения',
        ];
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return null;
    }


    public function validateAuthKey($authKey)
    {
        return false;
    }


    public function validatePassword($password)
    {
        return $this->password === $password;
    }

}



