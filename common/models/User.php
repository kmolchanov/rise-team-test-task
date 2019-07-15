<?php

namespace common\models;

use Yii;
use mongosoft\mongodb\MongoDateBehavior;

/**
 * This is the model class for collection "user".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $email
 * @property mixed $firstName
 * @property mixed $lastName
 * @property mixed $createdAt
 * @property mixed $updatedAt
 */
class User extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['rise-team-test-task', 'user'];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => MongoDateBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'email',
            'firstName',
            'lastName',
            'createdAt',
            'updatedAt',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'firstName', 'lastName'], 'required'],
            ['email', 'email'],
            [['firstName', 'lastName'], 'string', 'max' => 255],
            [['createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'email' => 'Email',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
