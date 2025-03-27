<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $base64_image
 * @property string|null $created_at
 * @property string|null $description
 * @property string|null $type
 * @property int|null $id_services
 * @property int|null $id_plan
 *
 * @property Plans $plan
 * @property Services $services
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['base64_image', 'description'], 'string'],
            [['created_at'], 'safe'],
            [['id_services', 'id_plan'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
            [['id_plan'], 'exist', 'skipOnError' => true, 'targetClass' => Plans::class, 'targetAttribute' => ['id_plan' => 'id']],
            [['id_services'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['id_services' => 'id']],
            [['id_plan', 'type', 'base64_image'], 'required'],
            ['type', 'in', 'range' => ['gallery', 'main']],
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
            'base64_image' => 'Base64 Image',
            'created_at' => 'Created At',
            'description' => 'Description',
            'type' => 'Type',
            'id_services' => 'Id Services',
            'id_plan' => 'Id Plan',
        ];
    }

    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plans::class, ['id' => 'id_plan']);
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasOne(Services::class, ['id' => 'id_services']);
    }
}
