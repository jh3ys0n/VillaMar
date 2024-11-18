<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $facebook
 * @property string|null $address
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['phone', 'email', 'facebook', 'address'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'phone' => 'Phone',
            'email' => 'Email',
            'facebook' => 'Facebook',
            'address' => 'Address',
        ];
    }
}
