<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property int $id
 * @property int $ship_id
 * @property string $startdate
 * @property int $payment_id
 * @property int $user_id
 * @property int $status_id
 *
 * @property Payments $payment
 * @property Ships $ship
 * @property Statuses $status
 * @property User $user
 */
class Requests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ship_id', 'startdate', 'payment_id', 'user_id'], 'required'],
            [['ship_id', 'payment_id', 'user_id', 'status_id'], 'integer'],
            [['startdate'], 'safe'],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payments::className(), 'targetAttribute' => ['payment_id' => 'id']],
            [['ship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ships::className(), 'targetAttribute' => ['ship_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ship_id' => 'Тип транспорта',
            'startdate' => 'Дата начала обучения',
            'payment_id' => 'Тип оплаты',
            'user_id' => 'Пользователь',
            'status_id' => 'Статус',
        ];
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payments::className(), ['id' => 'payment_id']);
    }

    /**
     * Gets query for [[Ship]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShip()
    {
        return $this->hasOne(Ships::className(), ['id' => 'ship_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Statuses::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
